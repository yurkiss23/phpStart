<?php
$errors = array();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email='';
    if(isset($_POST['email']) and !empty($_POST['email']))
        $email=$_POST['email'];
    else
        $errors['email']="Поле є обов'язковим";

    $password='';
    if(isset($_POST['password']) and !empty($_POST['password']))
        $password=$_POST['password'];
    else
        $errors['password']="Поле є обов'язковим";

    $phone='';
    if(isset($_POST['phone']) and !empty($_POST['phone']))
        $phone=$_POST['phone'];
    else
        $errors['phone']="Поле є обов'язковим";

    $confirm_password='';
    if(isset($_POST['confirm_password']) and !empty($_POST['confirm_password']))
        $confirm_password=$_POST['confirm_password'];
    else
        $errors['confirm_password']="Поле є обов'язковим";

    if ($password!=$confirm_password){
        $errors['confirm_password']="Паролі не співпадають";
    }

    if(count($errors)==0){
        include_once "lib/image_compress.php";
        include_once "con_db.php";
        $uploaddir=$_SERVER['DOCUMENT_ROOT'].'/uploads/';
        $file_name=uniqid('300_').'.jpg';
        $file_save_path=$uploaddir.$file_name;
        my_image_resize(600,400,$file_save_path,'image');
//        if (move_uploaded_file($_FILES['image']['tmp_name'],$file_save_path)){
//            echo "Файл успішно завантажено.\n";
//        }else{
//            echo "Ймовірна атака за допомогою файлового завантаження.\n";
//        }

        $urlPath='/uploads/'.$file_name;
        $sql="INSERT INTO tbl_users(Email,Password,Image,Phone)VALUES(?,?,?,?)";
        $stmt=$dbh->prepare($sql);
        $stmt->execute([$email,$password,$urlPath,$phone]);
        header("location:/");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include "_styles.php"; ?>
    <title>Register</title>
</head>
<body>
<?php include "_navbar.php";
include "helpers/input-helper.php";
?>
<div class="container">
    <div class="row mt-3">
        <div class="offset-md-3 col-md-6">
            <h3 class="text-center">Реєстрація</h3>
            <?php
                if(count($errors)!=0){
                    echo '
                    <div class="alert alert-danger" role="alert">
                        Дані вказано некоректно!
                    </div>
                    ';
                }
            ?>
            <form method="post" id="form_register" enctype="multipart/form-data">
                <?php create_input("email", "Email", "email", $errors); ?>
                <?php create_input("phone", "Телефон", "text", $errors); ?>
                <?php create_input("password", "Пароль", "password", $errors); ?>
                <?php create_input("confirm_password", "Підвердження пароля", "password", $errors); ?>
                <?php create_input("image", "Фото", "file", $errors); ?>

                <img id="prev" width="300"/>

                <div class="form-group">
                    <input type="submit" class="btn btn-outline-info" value="Register"/>
                </div>
                <div class="form-group">
                    <a href="login.php" class="ForgetPwd">Вже зареєстровані?</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include "_scripts.php";?>
<script>
    $(function(){
        $('#form_register #image').on('input',function () {
            readURL(this);
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    //$(this).parent().append("<img src='"+e.target.result+"'/>");
                    $('#prev').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    });
</script>
</body>
</html>