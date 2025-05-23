<?php

$host = 'localhost';
$user = 'root';
$port = '3307';
$password = '';
$dbname = 'jankenpon';

$conn = mysqli_connect($host, $user, $password, $dbname, $port);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
