<?php
//�����������ݿ�������Ϣ
require_once 'connectvars.php';
//����һ���Ự
session_start();
ini_set('session.gc_maxlifetime', "60");
$error_msg = "";

if($_GET['action'] == "logout"){
    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
    echo '<p>Successfully Log Out</p>
          <a href="login.php"><button style="margin-top:20px">Back to login page</button></a>';
    exit;
}
//����û�δ��¼����δ����$_SESSION['user_id']ʱ��ִ�����´���
if(!isset($_SESSION['user_id'])){
  if(isset($_POST['submit'])){//�û��ύ��¼��ʱִ�����´���

    $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

    $user_username = trim($_POST['username']);
    $user_password = trim($_POST['password']);
  
    if(!empty($user_username)&&!empty($user_password)){
      //MySql�е�SHA()�������ڶ��ַ������е������
      $query = "SELECT user_id, username FROM mismatch_user WHERE username = '$user_username' AND "."password ='$user_password'";
      //���û�����������в�ѯ
      $data = mysqli_query($dbc,$query);
      //���鵽�ļ�¼����Ϊһ����������SESSION��ͬʱ����ҳ���ض���
      if(mysqli_num_rows($data)==1){
        $row = mysqli_fetch_array($data);
        $_SESSION['user_id']=$row['user_id'];
        $_SESSION['username']=$row['username'];
        $home_url = 'customerData.php';
        header('Location: '.$home_url);
      }else{//���鵽�ļ�¼���ԣ������ô�����Ϣ
        $error_msg = 'Sorry, you must enter a valid username and password to log in.';
      }
    }else{
      $error_msg = 'Sorry, you must enter a valid username and password to log in.';
    }
  }
}else{//����û��Ѿ���¼����ֱ����ת���Ѿ���¼ҳ��
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
    <!--ͨ��$_SESSION['user_id']�����жϣ�����û�δ��¼������ʾ��¼�������û������û���������-->
    <?php
    if(!isset($_SESSION['user_id'])){
      echo '<p class="error">'.$error_msg.'</p>';
    ?>
    <!-- $_SERVER['PHP_SELF']�����û��ύ��ʱ����������php�ļ� -->
    <form method = "post" action="<?php echo $_SERVER['PHP_SELF'];?>">
      <fieldset>
        <legend>Migration Apartment User Log In</legend>
  
        <label for="username">Username:</label>
        <!-- ����û�������û�����������û��� -->
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