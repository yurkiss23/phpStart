<?php
require_once 'config.php';

try {
    $dbh = new PDO(DB_DRIVER.":host=".DB_HOST.";dbname=".DB_NAME,
        DB_USER, DB_PASSWORD,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES ".DB_CHARSET));
// echo "<h4>Connection completed</h4>";
} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
    die();
}