<?php
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select username , id, credits from reg_users where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   $login_sessionId = $row['id'];
   $login_sessionCredits = $row['credits'];
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
      die();
   }
?>