<?php
$errors = array();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email='';
    if(isset($_POST['email']) and !empty($_POST['email']))
        $email=$_POST['email'];
    else
        $errors['email']="Поле є обов'язковим";
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
            <form method="post">
                <?php create_input("email", "Email", "email", $errors); ?>
                <?php create_input("phone", "Телефон", "text", $errors); ?>
                <?php create_input("password", "Пароль", "password", $errors); ?>
                <?php create_input("confirm_password", "Підвердження пароля", "password", $errors); ?>
                <?php create_input("image", "Фото", "file", $errors); ?>
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
</body>
</html>