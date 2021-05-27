<?php

try {
    //code...
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc', 'sups', 'password');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $ex) {
    echo "Error : " . $ex->getMessage() . "<br/>";
    die();
}