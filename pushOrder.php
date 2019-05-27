<?php


header("Content-type:text/html;charset=utf-8");  

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

mysqli_set_charset($conn,"utf8");

 
$sql = "SELECT Url FROM imgUrl where productNumber = $productNumber";
$result = mysqli_query($conn, $sql);
 
if (mysqli_num_rows($result) > 0) {
    // 
while($row = mysqli_fetch_assoc($result)) {
        $productimg=$row["Url"];
    }
} else {
    echo "fail";
}

$sql = "INSERT INTO `unpaid_order`(`openId`, `orderId`, `productName`, `productPice`, `orderNumber`, `productimg`, `productNumber`) 
VALUES ('$openId','$orderId','$productName','$price','$orderNumber','$productimg','$productNumber')";

if(mysqli_query($conn,$sql)){
    echo 'success';

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
 
mysqli_close($conn);

?>