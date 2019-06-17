<?php
header("content-type:text/html;charset=utf-8");  

echo  "<meta charset='utf-8'> 
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";

echo "<p> Guangson Wechat Program Order Information Data Collection</p>";

echo "<table style='border: solid 1px black;'>";



$name = $_GET['user'];




echo "<tr><th>Username</th><th>Useremail</th><th>Usertel</th><th>productName</th><th>Price(rmb)</th><th>confirmNumber</th>
<th>orderDate</th><th>Order status</th></tr>";
 
$servername = "localhost";
$username = "root"; 
$password = "@Guangson#2019";
$dbname = "order";



if(isset($_GET['status']) &&isset($_GET['id'])){
   $team = $_GET['status'];
   $confirmNumber =$_GET['id'];
   $conn = new mysqli($servername, $username, $password, $dbname);
      $conn->set_charset("utf8");      
   $sql = "UPDATE customer_info SET status='$team' where confirmNumber = '$confirmNumber'";


if ($conn->query($sql) === TRUE) {
  header('location: '.$_SERVER['HTTP_REFERER']);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
  
}




$dbc = mysqli_connect($servername,$username,$password,$dbname);

$query = "SELECT part FROM member_user where username = '$name'  ";

$result = mysqli_query($dbc,$query); 

if (mysqli_num_rows($result) > 0) {
     
while($row = mysqli_fetch_assoc($result)) {
        $group=$row["part"];

    }
} else {
   
}







$dbc = mysqli_connect($servername,$username,$password,$dbname);

$query = "SELECT * FROM customer_info where assign = '$group'";

mysqli_set_charset($dbc,"utf8");

$data = mysqli_query($dbc,$query); 


if (mysqli_num_rows($data) > 0) {
while($row = mysqli_fetch_array($data)){ 
    echo '<tr>'; 
      echo '<td style="width:150px;border:1px solid black; text-align:center">'.$row['customerName'].'</td>'; 
    echo '<td style="width:150px;border:1px solid black; text-align:center">'.$row['customerEmail'].'</td>'; 
    echo '<td style="width:150px;border:1px solid black; text-align:center">'.$row['customerTel'].'</td>'; 
    echo '<td style="width:150px;border:1px solid black; text-align:center">'.$row['productName'].'</td>'; 
    echo '<td style="width:150px;border:1px solid black; text-align:center">'.$row['productPice'].'</td>'; 
        echo '<td style="width:150px;border:1px solid black; text-align:center">'.$row['confirmNumber'].'</td>'; 
 echo '<td style="width:150px;border:1px solid black; text-align:center">'.$row['orderDate'].'</td>'; 
  




 echo '<td style="width:150px;border:1px solid black; padding-top:10px; text-align:center">Status:'.$row['status'].'</br>
   <form style="margin-top:10px; margin-left:5px" action="visaMemberOrderData.php"
method="GET">
    <input style="margin-top:10px; margin-left:5px; width:50%" type= "hidden" value="'.$row['confirmNumber'].'"  
    name ="id">
    <select style="margin-top:10px; margin-left:5px" name="status">
    
    
    <option>Processing</option>
    <option>Done</option>
    </select> 
<input style="margin-top:10px;" type="submit" value="Change">
</form></td>'; 
       
echo '</tr>'; 
  
}
}
else {

} 



$conn = null;

function go(){
header('location: '.$_SERVER['HTTP_REFERER']);
}



echo "</table>";
echo "<a href='http://192.234.204.46/wxprogram/visaTeamData.php?user=".$name."'><button style='margin-top:20px'>Refresh</button></a>";
echo "<a href='visaMemberUserLogin.php?action=logout'><button style='margin-top:20px;margin-left:20px' >Logout</button></a>";
?>