<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include "_styles.php";?>
    <title>StartPHP</title>
</head>
<body>
<?php include "_navbar.php";
include_once "con_db.php";
?>
<div class="container">
    <h1>Hello, PHP</h1>
    <?php
    echo "<h2>Hello beavers</h2>";
    $a = 5;
    $b = 23;
    $c = $a + $b;
    ?>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sth = $dbh->prepare("SELECT Id, Email, Phone FROM `tbl_users`");
        $sth->execute();

        while($result = $sth->fetch(PDO::FETCH_ASSOC))
        {
            echo '
        <tr>
            <th scope="row">'.$result["Id"].'</th>
            <td>'.$result["Email"].'</td>
            <td>'.$result["Phone"].'</td>
        </tr>
        ';
        }
        ?>
        </tbody>
    </table>

</div>
<?php include "_scripts.php";?>
</body>
</html>