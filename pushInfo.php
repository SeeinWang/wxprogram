<?php

$orderId =$_POST['orderId'];
$email =$_POST['email'];
$name =$_POST['name'];
$tel =$_POST['tel'];





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

 
$sql = "SELECT productName FROM paid_order where orderId = $orderId";

$result = mysqli_query($conn, $sql);
 
if (mysqli_num_rows($result) > 0) {
    // 
while($row = mysqli_fetch_assoc($result)) {
        $productName=$row["productName"];
echo "productName success"; 
    }
} else {
    echo "productName fail";
}


$sql = "SELECT productPice FROM paid_order where orderId = $orderId";

$result = mysqli_query($conn, $sql);
 
if (mysqli_num_rows($result) > 0) {
    // 
while($row = mysqli_fetch_assoc($result)) {
        $productPice=$row["productPice"];
echo "productPice success"; 
    }
} else {
    echo "productPice fail";
}

$sql = "SELECT confirmNumber FROM paid_order where orderId = $orderId";

$result = mysqli_query($conn, $sql);
 
if (mysqli_num_rows($result) > 0) {
    // 
while($row = mysqli_fetch_assoc($result)) {
        $confirmNumber=$row["confirmNumber"];
echo "confirmNumber success"; 
    }
} else {
    echo "confirmNumber fail";
}



$sql = "INSERT INTO customer_info(confirmNumber, productName, productPice, customerName,customerEmail,customerTel) 
VALUES ('$confirmNumber','$productName','$productPice','$name','$email','$tel')";



if(mysqli_query($conn,$sql)){
    echo 'success';

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
 
mysqli_close($conn);

?>