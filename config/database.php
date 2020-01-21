<?php
$connection = [
    'host' => 'localhost',
    'user' => 'root',
    'password' => 'YOUR-PASSWORD',
    'database' => 'app'

];

$mysqli = new mysqli(
    $connection['host'],
    $connection['user'],
    $connection['password'],
    $connection['database']

);

if ($mysqli->connect_error){
    die("Error connecting to database" . $mysqli->connect_error);
}
