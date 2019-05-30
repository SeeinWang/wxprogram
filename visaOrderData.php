<?php
header("content-type:text/html;charset=utf-8");  

echo  "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";

echo "<p> Guangson Wechat Program Order Information Data Collection</p>";

echo "<table style='border: solid 1px black;'>";

echo "<tr><th>Username</th><th>Useremail</th><th>Usertel</th><th>productName</th><th>Price(rmb)</th><th>confirmNumber</th><th>orderDate</th></tr>";

 
$servername = "localhost";
$username = "root"; 
$password = "@Guangson#2019";
$dbname = "order";



$dbc = mysqli_connect($servername,$username,$password,$dbname);

     

$query = "SELECT * FROM customer_info";
$data = mysqli_query($dbc,$query); 



while($row = mysqli_fetch_array($data)){ 
    echo '<tr>'; 
    echo '<td style="width:150px;border:1px solid black;">'.$row['customerName'].'</td>'; 
    echo '<td style="width:150px;border:1px solid black;">'.$row['customerEmail'].'</td>'; 
    echo '<td style="width:150px;border:1px solid black;">'.$row['customerTel'].'</td>'; 
    echo '<td style="width:150px;border:1px solid black;">'.$row['productName'].'</td>'; 
    echo '<td style="width:150px;border:1px solid black;">'.$row['productPice'].'</td>'; 
        echo '<td style="width:150px;border:1px solid black;">'.$row['confirmNumber'].'</td>'; 
 echo '<td style="width:150px;border:1px solid black;">'.$row['orderDate'].'</td>'; 


       
echo '</tr>'; 
  
} 


$conn = null;

echo "</table>";
echo "<a href='http://192.234.204.46/wxprogram/visaOrderData.php'><button style='margin-top:30px'>Refresh</button></a>";
echo "<a href='visaUserLogin.php?action=logout'><button style='margin-left:30px'>Logout</button></a>";
?>