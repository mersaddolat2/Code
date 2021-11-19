<?php

$login_username = $_REQUEST['username'];
$login_password = $_REQUEST['password'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT username, password FROM user WHERE username='$login_username' and password='$login_password'");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $res = $stmt->fetchAll();
    $username = $res[0]["username"];
    $password = $res[0]["password"];
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

 if($login_username == "$username" && $login_password == "$password")
 {
     echo "logged in successfully";
 }
 else {
     echo "Invalid Info";
 }
?>

