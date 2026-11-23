<?php
$host = '127.0.0.1';
$db   = 'caution_db';
$user = 'caution_user';
$pass = "Nai@#@!011216346";
$charset = 'utf8mb4';

$dsn = $dsn = "mysql:unix_socket=/run/mysqld/mysqld.sock;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
