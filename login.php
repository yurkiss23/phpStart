<?php
session_start();
$errors=array();
if($_SERVER["REQUEST_METHOD"]=="POST"){
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

    if(count($errors)==0){
        include_once "con_db.php";
        $sql="SELECT Id, Image FROM `tbl_users` WHERE Email='$email' AND Password='$password'";
        $con=$dbh->query($sql);
        if($con->rowCount()!=0){
            $res=$con->fetch(PDO::FETCH_ASSOC);
            $_SESSION['username']=$email;
            $_SESSION['userpass']=$password;
            $_SESSION['userimg']=$res['Image'];
            header("location:/UserProfile.php");
            exit;
        }
        else{
            $errors['all']= 'Користувача не знайдено';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include "_styles.php";?>
    <link rel="stylesheet" href="/css/login.css">
    <title>Login</title>
</head>
<body>
<?php include "_navbar.php";
include "helpers/input-helper.php";
?>
<div class="container">
    <div class="login-container">
        <div class="row">
            <div class="offset-md-3 col-md-6 login-form-1">
                <h3>Вхід на сайт</h3>
                <?php
                if(count($errors)!=0){
                    echo '
                    <div class="alert alert-danger" role="alert">
                        Дані вказано некоректно!
                    </div>
                    ';
                }
                ?>
                <form method="post" enctype="multipart/form-data">
                    <?php create_input("email", "Email", "email", $errors); ?>
                    <?php create_input("password", "Пароль", "password", $errors); ?>
                    
<!--                    <div class="form-group">-->
<!--                        <input type="text"-->
<!--                               class="form-control"-->
<!--                               name="email"-->
<!--                               placeholder="Your Email *"-->
<!--                               value="" />-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <input type="password" class="form-control" placeholder="Your Password *" value="" />-->
<!--                    </div>-->
                    <div class="form-group">
                        <input type="submit" class="btnSubmit" value="Login" name="submit"/>
                    </div>
                    <div class="form-group">
                        <a href="register.php" class="ForgetPwd">Реєстрація</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "_scripts.php";?>
</body>
</html>