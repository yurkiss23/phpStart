<?php
session_start();
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
?>
<div class="container">
    <div class="row mt-3">
        <div class="offset-md-3 col-md-6">
            <h3 class="text-center">Профіль користувача</h3>
            <form method="get">
                <div class="form-group">
                    <?php
                    echo '<div class="text-center">You are welcome, '.$_SESSION['username'].'!</div>';
                    echo '<div class="text-center"><img src="';
                    echo $_SESSION['userimg'];
                    echo '" width="300"/></div>';
                    ?>
                </div>
                <div class="form-group text-center">
                    <input type="submit" class="btnSubmit" value="Logout" name="submitOut"/>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include "_scripts.php"; ?>
</body>
</html>