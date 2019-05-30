<?php


header("Content-type:text/html;charset=utf-8");

$openId =$_POST['openId'];



$servername = "localhost";
$username = "root";
$password = "@Guangson#2019";
$dbname ="order";

// 创建连接
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection

if (!$conn) {
    die("connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn,"utf8");




$sql = "SELECT * FROM `unpaid_order` WHERE openId= '$openId' ";
$result = mysqli_query($conn, $sql);

$res  = array();
 
if (mysqli_num_rows($result) > 0) {
    // 输出数据
    while($row = mysqli_fetch_assoc($result)) {
     $res[] = $row;
   }
    echo json_encode($res);
} else {
    echo "empty";
    
}



mysqli_close($conn);

?>