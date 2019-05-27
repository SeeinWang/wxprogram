<?php


$name =$_POST['name'];
$userwx = $_POST['wxnumber'];
$useremail = $_POST['email'];
$usertel = $_POST['tel'];
$type= $_POST['type'];


$servername = "localhost";
$username = "root";
$password = "@Guangson#2019";
$dbname ="questioner";
 
// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检测连接
if ($conn->connect_error) {
    die("fail: " . $conn->connect_error);
} 
 

$sql = "INSERT INTO Guests (username,wxnumber,email,tel,type)
VALUES ('$name','$userwx','$useremail','$usertel','$type')";
 
if ($conn->query($sql) === TRUE) {
    echo "success";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
 
$conn->close();
?>