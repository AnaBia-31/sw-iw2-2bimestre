<?php
$host = 'localhost';
$db = 'db';
$user = 'root';
$pass = 'usbw';
$port = '3306';

$dsn = "mysql:host=$host;dbname=$db;port=$port";
$conn = new PDO($dsn, $user, $pass); 


?>