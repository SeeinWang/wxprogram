<?php
//插入连接数据库的相关信息
require_once 'connectvars.php';
//开启一个会话
session_start();
ini_set('session.gc_maxlifetime', "60");
$error_msg = "";

if($_GET['action'] == "logout"){
    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
    echo '<p>Successfully Log Out</p>
          <a href="migrateUserLogin.php"><button style="margin-top:20px">Back to login page</button></a>';
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
        $home_url = 'customerData.php';
        header('Location: '.$home_url);
      }else{//若查到的记录不对，则设置错误信息
        $error_msg = 'Sorry, you must enter a valid username and password to log in.';
      }
    }else{
      $error_msg = 'Sorry, you must enter a valid username and password to log in.';
    }
  }
}else{//如果用户已经登录，则直接跳转到已经登录页面
  $home_url = 'customerData.php';
  header('Location: '.$home_url);
}
?>

<html>
  <head>
    <title>Log In</title>
      </head>
  <body>
    <h3>Guangson Customer Data Access Center</h3>
    <!--通过$_SESSION['user_id']进行判断，如果用户未登录，则显示登录表单，让用户输入用户名和密码-->
    <?php
    if(!isset($_SESSION['user_id'])){
      echo '<p class="error">'.$error_msg.'</p>';
    ?>
    <!-- $_SERVER['PHP_SELF']代表用户提交表单时，调用自身php文件 -->
    <form method = "post" action="<?php echo $_SERVER['PHP_SELF'];?>">
      <fieldset>
        <legend>Migration Apartment User Log In</legend>
  
        <label for="username">Username:</label>
        <!-- 如果用户已输过用户名，则回显用户名 -->
        <input style="margin-top:10px" type="text" id="username" name="username"
        value="<?php if(!empty($user_username)) echo $user_username; ?>" />
  
        <br/>
  
        <label style="margin-top:20px;margin-left:2px" for="password">Password:</label>
        <input style="margin-top:20px;margin-left:2px" type="password" id="password" name="password"/>
  
      </fieldset>
      <input style="margin-top:30px;" type="submit" value="Log In" name="submit"/>
    </form>
    <?php
    }
    ?>
  </body>
</html>