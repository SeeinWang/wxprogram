<?php


$openId =$_POST['openId'];
$orderId = $_POST['orderId'];
$productName = $_POST['productName'];
$orderNumber = $_POST['orderNumber'];
$price= $_POST['price'];
$productNumber= $_POST['productNumber'];

 
$res=array($openId,$orderId,$productNumber,$orderNumber,$price,$productNumber);


echo json_encode($res);



?>