<?php


$openId =$_POST['openId'];
$orderId = $_POST['orderId'];
$productName = $_POST['productName'];
$orderNumber = $_POST['orderNumber'];
$price= $_POST['price'];
$productNumber= $_POST['productNumber'];


$servername = "localhost";
$username = "root";
$password = "@Guangson#2019";
$dbname ="order";
 
// 创建连接
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection

if (!$conn) {
    die("连接失败: " . mysqli_connect_error());
}
 
$sql = "SELECT Url FROM imgUrl where productNumber = 10";
$result = mysqli_query($conn, $sql);
 
if (mysqli_num_rows($result) > 0) {
    // 
while($row = mysqli_fetch_assoc($result)) {
        $productimg=$row["Url"];
    }
} else {
    echo "fail";
}


 
mysqli_close($conn);

?>