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
            <?php
            if (isset($_GET["submit"])) {
                echo 'You are welcome, ' . $_GET["email"] . '!';
            } else {
                echo 'No data were received!<br/>';
            }
            ?>
        </div>
    </div>
</div>
<?php include "_scripts.php"; ?>
</body>
</html>