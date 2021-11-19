<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE IF NOT EXISTS users";
    $conn->exec($sql);
    $sql = "use users";
    $conn->exec($sql);
    $sql = "CREATE TABLE IF NOT EXISTS user (
               PRIMARY KEY(username), 
               username VARCHAR(30) NOT NULL,
               password VARCHAR(30) NOT NULL)";
    $conn->exec($sql);
    echo "DB created successfully";
    echo "<a href='index.php'>Back To Login Page</a>";
}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}