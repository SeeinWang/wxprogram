<?php


$orderId = $_POST['orderId'];




$servername = "localhost";
$username = "root";
$password = "@Guangson#2019";
$dbname ="order";
 
// ��������
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection

if (!$conn) {
    die("����ʧ��: " . mysqli_connect_error());
}



mysqli_set_charset($conn,"utf8");


$sql = "DELETE FROM `unpaid_order` WHERE orderId = $orderId";


if(mysqli_query($conn,$sql)){
    echo 'success';

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn). json_encode($res);
}
 
mysqli_close($conn);

?>