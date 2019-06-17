<?php
header("content-type:text/html;charset=utf-8");  

echo  "<meta charset='utf-8'>
 
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>";

echo "<p> Guangson Wechat Program Order Information Data Collection</p>";

echo "<table style='border: solid 1px black;'>";

echo "<tr><th>Username</th><th>Useremail</th><th>Usertel</th><th>productName</th><th>Price(rmb)</th><th>confirmNumber</th>
<th>orderDate</th><th>Job assign</th><th>Order status</th></tr>";
 
$servername = "localhost";
$username = "root"; 
$password = "@Guangson#2019";
$dbname = "order";

echo "Search by order status:";

echo "<a href='http://192.234.204.46/wxprogram/visaOrderData.php'><button style='margin-left:30px;margin-bottom:20px'>All Orders</button></a>";


echo "<a href='http://192.234.204.46/wxprogram/PaidOrder.php'><button style='margin-left:30px;margin-bottom:20px;color:red;'>Paid Orders</button></a>";
echo "<a href='http://192.234.204.46/wxprogram/AssignedOrder.php'><button style='margin-left:20px;margin-bottom:20px; '>Assigned Orders</button></a>";
echo "<a href='http://192.234.204.46/wxprogram/ProcessingOrder.php'><button style='margin-left:20px;margin-bottom:20px'>Processing Orders</button></a>";
echo "<a href='http://192.234.204.46/wxprogram/CompletedOrder.php'><button style='margin-left:20px;margin-bottom:20px'>Completed Orders</button></a></br>";

echo "Search by job assigned to teams";
echo "<a href='visaMemberOrderData.php?user=teamOne'><button style='margin-left:30px;margin-bottom:20px'>Team One Orders</button></a>";
echo "<a href='visaMemberOrderData.php?user=teamTwo'><button style='margin-left:20px;margin-bottom:20px'>Team Two Orders</button></a> </br>";



if(isset($_GET['jobteam']) && isset($_GET['id'])){
   $team = $_GET['jobteam'];
   $confirmNumber =$_GET['id'];
   $conn = new mysqli($servername, $username, $password, $dbname);
   $sql = "UPDATE customer_info SET assign='$team' where confirmNumber = '$confirmNumber'";


if ($conn->query($sql) === TRUE) {
  
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

 $sql = "UPDATE customer_info SET status='Assigned' where confirmNumber = '$confirmNumber'";

if ($conn->query($sql) === TRUE) {
  
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


  
}


if(isset($_GET['status']) &&isset($_GET['id'])){
   $team = $_GET['status'];
   $confirmNumber =$_GET['id'];
   $conn = new mysqli($servername, $username, $password, $dbname);
   $conn->set_charset("utf8");      
   $sql = "UPDATE customer_info SET status='$team' where confirmNumber = '$confirmNumber'";


if ($conn->query($sql) === TRUE) {
  
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
  
}



$dbc = mysqli_connect($servername,$username,$password,$dbname);

$query = "SELECT * FROM customer_info where status ='Paid'";

mysqli_set_charset($dbc,"utf8");

$data = mysqli_query($dbc,$query); 


if (mysqli_num_rows($data) < 0) {
     echo "Error " ;

        
}



while($row = mysqli_fetch_array($data)){ 
    echo '<tr>'; 
      echo '<td style="width:150px;border:1px solid black; text-align:center">'.$row['customerName'].'</td>'; 
    echo '<td style="width:150px;border:1px solid black; text-align:center">'.$row['customerEmail'].'</td>'; 
    echo '<td style="width:150px;border:1px solid black; text-align:center">'.$row['customerTel'].'</td>'; 
    echo '<td style="width:150px;border:1px solid black; text-align:center">'.$row['productName'].'</td>'; 
    echo '<td style="width:150px;border:1px solid black; text-align:center">'.$row['productPice'].'</td>'; 
        echo '<td style="width:150px;border:1px solid black; text-align:center">'.$row['confirmNumber'].'</td>'; 
 echo '<td style="width:150px;border:1px solid black; text-align:center">'.$row['orderDate'].'</td>'; 
  echo '<td style="width:150px;border:1px solid black; padding-top:10px; text-align:center">Assigned to:'.$row['assign'].'</br>
   <form style="margin-top:10px; margin-left:5px" action="visaOrderData.php"
method="GET">
    <input style="margin-top:10px; margin-left:5px; width:50%" type= "hidden" value="'.$row['confirmNumber'].'"  
    name ="id">
    <select style="margin-top:10px; margin-left:5px" name="jobteam">
    <option>team1</option>
    <option>team2</option>
    </select> 
<input type="submit" value="Change">
</form></td>'; 





 echo '<td style="width:150px;border:1px solid black; padding-top:10px; text-align:center" >Status:'.$row['status'].'</br>
   <form style="margin-top:10px; margin-left:5px" action="visaOrderData.php"
method="GET">
    <input style="margin-top:10px; margin-left:5px; width:50%" type= "hidden" value="'.$row['confirmNumber'].'"  
    name ="id">
    <select style="margin-top:10px; margin-left:5px" name="status">
    <option>Paid</option>
    <option>Assigned</option>
    <option>Processing</option>
    <option>Done</option>
    </select> 
<input style="margin-top:10px;" type="submit" value="Change">
</form></td>'; 
       
echo '</tr>'; 
  
} 


$conn = null;

echo "</table>";
echo "<a href='http://192.234.204.46/wxprogram/PaidOrder.php'><button style='margin-top:30px'>Refresh</button></a>";
echo "<a href='visaUserLogin.php?action=logout'><button style='margin-left:30px'>Logout</button></a>";
?>