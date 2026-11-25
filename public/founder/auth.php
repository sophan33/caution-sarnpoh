<?php
session_start();
require __DIR__ . '/../../src/helpers.php';

if (empty($_SESSION['founder'])) {
    header('Location: login.php');
    exit;
}
