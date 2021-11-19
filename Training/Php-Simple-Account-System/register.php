<?php
$register_username = $_REQUEST['username'];
$register_password = $_REQUEST['password'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT username FROM user WHERE username='$register_username'");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $res = $stmt->fetchAll();
    $db_username = $res[0]["username"];
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

if($register_username == "$db_username")
{
    echo "This Username Already Exist";
}
else {
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO user (username, password)
  VALUES ('$register_username', '$register_password')";
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "Register was Successful";
        echo "<br>";
        echo "<a href='index.php'>Back To Login Page</a>";
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;
}

?>