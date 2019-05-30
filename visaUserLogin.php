<?php
//插入连接数据库的相关信息
require_once 'connectvarsvisa.php';
//开启一个会话
session_start();
ini_set('session.gc_maxlifetime', "60");
$error_msg = "";

if($_GET['action'] == "logout"){
    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
    echo '<p>Successfully Log Out</p>
          <a href="visaUserLogin.php"><button style="margin-top:20px">Back to login page</button></a>';
    exit;
}
//如果用户未登录，即未设置$_SESSION['user_id']时，执行以下代码
if(!isset($_SESSION['user_id'])){
  if(isset($_POST['submit'])){//用户提交登录表单时执行如下代码

    $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

    $user_username = trim($_POST['username']);
    $user_password = trim($_POST['password']);
  
    if(!empty($user_username)&&!empty($user_password)){
      //MySql中的SHA()函数用于对字符串进行单向加密
      $query = "SELECT user_id, username FROM mismatch_user WHERE username = '$user_username' AND "."password ='$user_password'";
      //用用户名和密码进行查询
      $data = mysqli_query($dbc,$query);
      //若查到的记录正好为一条，则设置SESSION，同时进行页面重定向
      if(mysqli_num_rows($data)==1){
        $row = mysqli_fetch_array($data);
        $_SESSION['user_id']=$row['user_id'];
        $_SESSION['username']=$row['username'];
        $home_url = 'visaOrderData.php';
        header('Location: '.$home_url);
      }else{//若查到的记录不对，则设置错误信息
        $error_msg = 'Sorry, you must enter a valid username and password to log in.';
      }
    }else{
      $error_msg = 'Sorry, you must enter a valid username and password to log in.';
    }
  }
}else{//如果用户已经登录，则直接跳转到已经登录页面
  $home_url = 'visaOrderData.php';
  header('Location: '.$home_url);
}
?>

<html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<style type="text/css">
#LoginForm{ background-image:url("https://hdwallsource.com/img/2014/9/blur-26347-27038-hd-wallpapers.jpg"); background-repeat:no-repeat; background-position:center; background-size:cover; padding:10px;}

.form-heading { color:#fff; font-size:23px; margin-top:50px}
.panel h2{ color:#444444; font-size:18px; margin:0 0 8px 0;}
.panel p { color:#777777; font-size:14px; margin-bottom:30px; line-height:24px;}

.login-form .form-control {
  background: #f7f7f7 none repeat scroll 0 0;
  border: 1px solid #d4d4d4;
  border-radius: 4px;
  font-size: 14px;
  height: 50px;
  line-height: 50px;
}
.login-form{
 margin-top:100px;
}
.main-div {
  background: #ffffff none repeat scroll 0 0;
  border-radius: 2px;
  margin: 10px auto 30px;
  max-width: 38%;
  padding: 50px 71px 70px 71px;
}

.login-form {
  margin-bottom:50px;
}

.form-group {

margin-bottom:10px;

}
.login-form{ text-align:center;}

.forgot a {
  color: #777777;
  font-size: 14px;
  text-decoration: underline;
}
.login-form  .btn.btn-primary {
  background: #f0ad4e none repeat scroll 0 0;
  border-color: #f0ad4e;
  color: #ffffff;
  font-size: 14px;
  width: 100%;
  height: 50px;
  line-height: 50px;
  padding: 0;
}
.forgot {
  text-align: left; margin-bottom:30px;
}
.botto-text {
  color: #ffffff;
  font-size: 14px;
  margin: auto;
}
.login-form .btn.btn-primary.reset {
  background: #ff9900 none repeat scroll 0 0;
}
.back { text-align: left; margin-top:10px;}
.back a {color: #444444; font-size: 13px;text-decoration: none;}

</style>

 
    <title>Log In</title>
      </head>
  <body id="LoginForm">
  <div class ="container">
     <h1 class="text-center form-heading">Guangson Order Data Access Center</h1>

    <!--通过$_SESSION['user_id']进行判断，如果用户未登录，则显示登录表单，让用户输入用户名和密码-->
    <?php
    if(!isset($_SESSION['user_id'])){
      echo '<p class="error">'.$error_msg.'</p>';
    ?>
    <!-- $_SERVER['PHP_SELF']代表用户提交表单时，调用自身php文件 -->
    <div class ="login-form">
    <div class="main-div">
    <div class ="panel">
    <h2>Education Admin Login</h2>
    <p>Please enter your username and password</p>
    </div>
    <form id="Login" method = "post" action="<?php echo $_SERVER['PHP_SELF'];?>">
      
        <div class ="form-group">
  
        
        <!-- 如果用户已输过用户名，则回显用户名 -->
        <input  type="text" class="form-control" id="username" name="username" placeholder="username"
        value="<?php if(!empty($user_username)) echo $user_username; ?>" />
  
        </div>
  
        <div class="form-group">

        <input class="form-control" type="password" id="password" placeholder="password" name="password"/>
        
        </div>
  
      
       <input class="btn btn-primary" type="submit" value="Log In" name="submit"/>
    </form>
</div>
</div>
</div>
</div>
    <?php
    }
    ?>
  </body>
</html>