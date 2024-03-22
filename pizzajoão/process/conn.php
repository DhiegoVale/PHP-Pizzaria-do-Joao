<?php
session_start();
$user = "root";
$pass = "qwe123";
$host = "localhost";
$db = "pizzaria";

try{
    $conn = new PDO("mysql:host={$host};dbname={$db}", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
}catch(Exception $e){
    print "Error: " . $e->getMessage() . "\n";
    die();
}