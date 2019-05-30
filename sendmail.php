<?php
$orderId =$_POST['orderId'];
$visitor_email =$_POST['email'];
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

//获得productName 
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

//获得productPice
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


//获得订单确认号
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

// 获得时间戳
$sql = "SELECT orderDate FROM customer_info where confirmNumber = '$confirmNumber'";

$result = mysqli_query($conn, $sql);
 
if (mysqli_num_rows($result) > 0) {
    // 
while($row = mysqli_fetch_assoc($result)) {
        $orderDate=$row["orderDate"];
echo "orderDate success"; 
    }
} else {
    echo "orderDate fail";
}






//Validate first
if(empty($visitor_email)) 
{
    echo "Email has to be filled!；必须填写邮件地址 ";
    exit;
}
if(IsInjected($visitor_email))
{
    echo "Bad email value!";
    exit;
}
//$email_from = "info@guangson.ca";//<== update the email address;
$email_subject = "=?UTF-8?B?".base64_encode("订单确认")."?=";
$htmlContent = "<html>
<head><meta name='viewport' content='width=device-width, initial-scale=1.0'></head><body>
<div style='margin: 0 auto;'>
      <div style='margin-bottom:20px'>
              <img style ='padding-bottom: 30px;padding-top: 30px'
               src = 'http://guangson.com/Content/images/logo.png'>
       </div>         
        <p>您好".$name.":</p>
        <p style='font-size:18px;'>感谢您购买的我们的服务 ".$productName." 价格是".$productPice."rmb,您的订单号是".$confirmNumber."</p>
        <p style='font-size:18px;'>请您核对下列基本信息，如果需要修改或者有问题，请联系我们。</p>
        <p style='font-size:18px;'>Order # : ".$confirmNumber."</p>
        <p style='font-size:18px;'>Order Date: ".$orderDate."</p>
                       
        <table style='border:1px solid black; font-size:18px; width:60%;min-height: 30px; 
        line-height: 30px; text-align: center; border-collapse: collapse;margin-top:5%' >
        <tr>
        <th style='border:1px solid black;'>项目</th>
        <th style='border:1px solid black;'>内容</th>
        </tr>
        <tr>
        <td style='border:1px solid black;'>姓名</td>
        <td style='border:1px solid black;'>".$name."</td>
        </tr>
         <tr>
        <td style='border:1px solid black;'>电子邮箱</td>
        <td style='border:1px solid black;'>".$visitor_email."</td>
        </tr>

        <tr>
        <td style='border:1px solid black;'>电话</td>
        <td style='border:1px solid black;'>".$tel."</td>
        </tr>

        
        </table>
      <div style='color:blue'>
                     <p>后续步骤：</p>
                     <p>我们将会尽快与您联系，补全服务所需资料。</p>
       </div>
        <div style='padding-left:5px;padding-top: 20px;padding-right:300px; width:600px'>
              <p style='font-weight:bold;'>关于我们：</p>
              <p style='line-height:2'>佳亨国际自2006年于加拿大成立以来，经过
十余年的快速发展，在加拿大地区设立了4个
常驻办公室及数十个地区的联络人，遍布加
拿大各大省市，且在中国地区设立了5个常驻
办公室及分公司。专业资质且经验丰富的国内外咨询顾问竭诚为海内外客户提
供从学习规划、院校申请、办理签证、精品监护、落地安置
到移民规划的一站式服务。十多年来，我们累计为40,000多
名留学、移民客户成功办理了65,000多件留学及移民案例，
签证通过率高达99.2%。</p>
              <p style='font-weight:bold;' >联系我们：</p>
              <p>邮件：info@guangson.com<p>
              <p>电话：+1 604-408-7777</p>
              <p style='line-height:2'>地址：<br>佳亨国际留学中心: 1017-4500 Kingsway, Burnaby, BC <br> 
 佳亨国际移民中心: 6262 Willingdon Ave, Burnaby, BC<br>
佳亨国际列治文店: 3270-4000 NO.3 Rd., Richmond, BC<br>
佳亨国际多伦多店: #336-4750 Yonge St., Toronto, ON</p>
              <p>工作时间： 周一到周五: 10AM - 6PM &nbsp;         
              周六到周日: 11AM - 6PM</p>
              
       </div>
       </div>
</body></html>";

$file = "";
    
$to = $visitor_email;//<== update the email address

//sender
$from = 'visa@guangson.ca';
$fromName = 'Guangson';
$replyto ='visa@guangson.ca';
$cc = 'vivi19940801@gmail.com';


//header for sender info
$header = "From: ".$from_name." <".$from_mail.">\n";
$header .= "Reply-To: ".$replyto."\n";
$header .= "Cc: ".$cc."\n";



//boundary 
$semi_rand = md5(time()); 
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

//headers for attachment 
$headers .= "MIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

//multipart boundary 
$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
"Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n"; 

//preparing attachment
if(!empty($file) > 0){
    if(is_file($file)){
        $message .= "--{$mime_boundary}\n";
        $fp =    @fopen($file,"rb");
        $data =  @fread($fp,filesize($file));

        @fclose($fp);
        $data = chunk_split(base64_encode($data));
        $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" . 
        "Content-Description: ".basename($file)."\n" .
        "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" . 
        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
    }
}
$message .= "--{$mime_boundary}--";
$returnpath = "-f" . $from;

//send email
$mail = @mail($to, $email_subject, $message, $headers, $returnpath); 




//done. redirect to thank-you page.
//echo "$name  $visitor_email $message \n $email_body ";
//回到原来页面
//header('Location: http://guangson.ca/sendemail.html');
//Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
  
?>