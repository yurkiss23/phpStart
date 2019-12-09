<?php
$message='';
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $to=$_POST['email'];
    if(isset($_POST['recoveryPass'])){
        if(!empty($to)){
            include_once "con_db.php";
            $sql="SELECT Id FROM `tbl_users` WHERE Email='$to'";
            $con=$dbh->query($sql);
            if($con->rowCount()!=0) {
                mail($to, "Відновлення паролю", "new password");
                $message = "На Вашу адресу надіслано пароль для відновлення доступу";
            }
            else{
                $message= 'Користувача не знайдено';
            }
        }
        else{
            $message="Введіть email";
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
    <title>PassRecovery</title>
</head>
<body>
<?php include "_navbar.php";
include_once "con_db.php";
?>
<div class="container">
    <div class="recovery-container">
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <h3 class="text-center">Відновлення паролю</h3>
                <?php
//                if(count($errors)!=0){
//                    echo '
//                    <div class="alert alert-danger" role="alert">
//                        Дані вказано некоректно!
//                    </div>
//                    ';
//                }
                ?>
                <form method="post" id="form_register">
                    <div>
                        <span>Аби відновити пароль - до поля нижче введіть адресу електроннй пошти, вказаної при реєстрації:</span>
                    </div>
                    <div class="form-group">
                        <input type="email"
                               class="form-control"
                               name="email"
                               placeholder="Your Email *"
                               value="" />
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-outline-success" value="Відновити пароль" name="recoveryPass"/>
                    </div>
                    <div class="form-group justify-content-center">
                        <span class="text-center">
                            <?php echo $message;
                            ?>
                        </span>
                    </div>
<!--                    <div class="form-group">-->
<!--                        <a href="login.php" class="ForgetPwd">Вже зареєстровані?</a>-->
<!--                    </div>-->
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "_scripts.php";?>
</body>
</html>