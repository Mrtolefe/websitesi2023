<?php

$mysqlServer = "localhost"; // MySQL Server (sunucu)
$mysqlServerPort = "3306"; // MySQL Port (örn: 3306)
$mysqlUsername = "marthex_abime_selam"; // MySQL Kullanıcı Adı
$mysqlPassword = "dolandirici_duragi"; // MySQL Şifre
$mysqlDatabase = "otobüs";// MySQL Veritabanı

try {
    $db = new PDO("mysql:host=" . $mysqlServer . "; port=" . $mysqlServerPort . "; dbname=" . $mysqlDatabase . "; charset=utf8", $mysqlUsername, $mysqlPassword);
} catch (PDOException $e) {
    die("<strong>MySQL Bağlantı Hatası:</strong> " . utf8_encode($e->getMessage()));
}
?>