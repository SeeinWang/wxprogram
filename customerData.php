<?php
header("content-type:text/html;charset=utf-8");  

echo  "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";

echo "<p> Guangson Wechat Program Customer Information Data Collection</p>";

echo "<table style='border: solid 1px black;'>";

echo "<tr><th>Username</th><th>Useremail</th><th>Usertel</th><th>Wxnumber</th><th>Questioned Type</th><th>Operation</th></tr>";

 
$servername = "localhost";
$username = "root"; 
$password = "@Guangson#2019";
$dbname = "questioner";



$dbc = mysqli_connect($servername,$username,$password,$dbname);

if(isset($_GET['DelUsername'])){ 
   $user = $_GET['DelUsername'];
   $conn = new mysqli($servername, $username, $password, $dbname);
   $sql = "DELETE FROM Guests WHERE username = '$user' LIMIT 1" ; 


if ($conn->query($sql) === TRUE) {
  
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
  
}
     

$query = "SELECT * FROM Guests";
$data = mysqli_query($dbc,$query); 



while($row = mysqli_fetch_array($data)){ 
    echo '<tr>'; 
    echo '<td style="width:150px;border:1px solid black;">'.$row['username'].'</td>'; 
    echo '<td style="width:150px;border:1px solid black;">'.$row['email'].'</td>'; 
    echo '<td style="width:150px;border:1px solid black;">'.$row['tel'].'</td>'; 
    echo '<td style="width:150px;border:1px solid black;">'.$row['wxnumber'].'</td>'; 
    echo '<td style="width:150px;border:1px solid black;">'.$row['type'].'</td>'; 
    //���"ɾ��"���ӣ���������ҳ�棬ͬʱ��ҳ�����������ӡ�DelID����������ֵΪ�ü�¼�����ݿ��е�username������GET��ʽ��� 
    echo '<td style="width:150px;border:1px solid black;"><a href = "'.$_SERVER['PHP_SELF'].'?DelUsername='.$row['username'].'">Delete</a></td>'; 
   echo '</tr>'; 
  
} 


$conn = null;

echo "</table>";
echo "<a href='http://192.234.204.46/customerData.php'><button style='margin-top:30px'>Refresh</button></a>";
echo "<a href='login.php?action=logout'><button style='margin-left:30px'>Logout</button></a>";
?>