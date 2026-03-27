<?php
require_once("asset.php");

if(isset($_GET['logout'])){
    $_SESSION['mess']="Logged out, welcome back!";
    $_SESSION['name']="";
    $_SESSION['level']="";
    $_SESSION['id']="";
    header("Location: index.php");
}

if(isset($_POST['btn_login'])){
    $user=$_POST['user'];
    $pass=md5($_POST['pass']);
    $sql="SELECT * FROM tbl_user WHERE ((username='$user') AND (password='$pass'))";
    $result=mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)===1){
        $row=mysqli_fetch_assoc($result);
        $_SESSION['mess']="Login successful!";
        $_SESSION['name']=$row['realname'];
        $_SESSION['level']=$row['userlevel'];
        $_SESSION['id']=$row['id'];
    }else{
        $_SESSION['mess']="Login failed! Wrong username or password.";

    }
    header("Location: index.php");
}

?>