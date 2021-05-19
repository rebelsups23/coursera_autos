<?php

try {
    //code...
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc', 'suprav', 'password');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $ex) {
    echo "Error : " . $e->getMessage() . "<br/>";
    die();
}