<?php

$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "to_do_list";

try{
    $conn= new PDO("mysql:host=$servername;dbname=$dbname",
    $username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected";
}catch (PDOException $e){
    echo "Connection Failed :". $e->getMessage();
}



