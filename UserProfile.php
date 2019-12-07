<?php
session_start();
$errors = array();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['usermail'];
    if (isset($_POST['email']) and !empty($_POST['email']))
        $email = $_POST['email'];
    else
        $errors['email'] = "Поле є обов'язковим";

    $name = $_SESSION['username'];
    if (isset($_POST['name']) and !empty($_POST['name']))
        $name = $_POST['name'];
    else
        $errors['name'] = "Поле є обов'язковим";

    $password = $_SESSION['userpass'];
    if (isset($_POST['password']) and !empty($_POST['password']))
        $password = $_POST['password'];
    else
        $errors['password'] = "Поле є обов'язковим";

    $phone = $_SESSION['userphone'];
    if (isset($_POST['phone']) and !empty($_POST['phone']))
        $phone = $_POST['phone'];
    else
        $errors['phone'] = "Поле є обов'язковим";

    $confirm_password = $_SESSION['userpass'];
    if (isset($_POST['confirm_password']) and !empty($_POST['confirm_password']))
        $confirm_password = $_POST['confirm_password'];
    else
        $errors['confirm_password'] = "Поле є обов'язковим";

    if ($password != $confirm_password) {
        $errors['confirm_password'] = "Паролі не співпадають";
    }

    if(count($errors)==0 and isset($_POST['submitEdit'])){
        include_once "con_db.php";
//завантаження фото на сторінці редагування поки не працює
        $id=$_SESSION['userid'];
        $userimg=$_SESSION['userimg'];
        $sql="UPDATE `tbl_users` SET Email='$email', Password='$password', UserName='$name', Image='$userimg', Phone='$phone' WHERE Id='$id'";
        $upd=$dbh->prepare($sql);
        $upd->execute();
        $_SESSION['mess']= 'Вдало змінено'.$upd->rowCount().'запис(ів)';
        $_SESSION['username']=$name;
        $_SESSION['usermail']=$email;
        $_SESSION['userpass']=$password;
        $_SESSION['userphone']=$phone;
//        $_SESSION['userimg']=$urlPath;
        header("location:UserProfile.php");
        exit;
    }
    if(isset($_POST['cancelEdit'])){
        header("location:UserProfile.php");
        exit;
    }
    if(isset($_POST['submitOut'])){
        $_SESSION=array();
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
    <title>UserProfile</title>
</head>
<body>
<?php include "_navbar.php";
include "helpers/input-helper.php"
?>
<div class="container">
    <div class="row mt-3">
        <div class="offset-md-2 col-md-8">
            <h3 class="text-center">Профіль користувача</h3>
            <?php
            if(isset($_POST['dataEdit'])){
                echo '
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group input-group justify-content-between">';
                echo '<div class="col-md-12 text-center"><h5>Змінити дані</h5></div>';
                    create_inputedit("name", "Ім'я", "text", $_SESSION['username'], $errors);
                    create_inputedit("email", "Email", "email", $_SESSION['usermail'], $errors);
                    create_inputedit("phone", "Телефон", "text", $_SESSION['userphone'], $errors);
                echo '</div><div class="form-group input-group justify-content-around"><img src="';
                echo $_SESSION['userimg'];
                echo '" width="100"/>';
                    create_inputedit("image", "Фото", "file", $_SESSION['userimg'], $errors);
                echo '</div><div class="form-group input-group justify-content-around">';
                echo '<div class="col-md-12 text-center"><h5>Змінити пароль</h5></div>';
                    create_inputedit("password", "Пароль", "password", $_SESSION['userpass'], $errors);
                    create_inputedit("confirm_password", "Підвердження пароля", "password", $_SESSION['userpass'], $errors);
                echo '
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" class="btn btn-success" value="Погодитися" name="submitEdit"/>
                        <input type="submit" class="btn btn-secondary" value="Відхилити" name="cancelEdit"/>
                    </div>
                </form>';
            }else{
                if(isset($_SESSION['mess'])){
                    echo $_SESSION['mess'];
                    unset($_SESSION['mess']);
                }
                echo '
                <form method="post">
                    <div class="form-group">';
                echo '<div class="text-center">You are welcome, '.$_SESSION['username'].'!</div>';
                echo '<div class="text-center"><img src="';
                echo $_SESSION['userimg'];
                echo '" width="300"/></div>';
                echo '
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" class="btn btn-success" value="Редагувати дані" name="dataEdit"/>
                        <input type="submit" class="btnSubmit" value="Logout" name="submitOut"/>
                    </div>
                </form>';
            }
            ?>
        </div>
    </div>
</div>
<?php include "_scripts.php"; ?>
</body>
</html>