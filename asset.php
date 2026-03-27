<?php
session_start();
$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="drink";
$conn=mysqli_connect($db_host, $db_user, $db_pass, $db_name);

function hasrated($drinkid){
    global $conn;
    $userid=$_SESSION['id'];
    $sql="SELECT * FROM tbl_reviews WHERE userid=$userid AND drinkid=$drinkid";
    $result=mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
        return true;
    }else{
        return false;
    }
}



function rateDrink($userrating, $drinkid){
    $userid=$_SESSION['id'];
    global $conn;
    if (!hasrated($drinkid)) {
        $sql="INSERT INTO tbl_reviews (userid, score, drinkid) VALUES ($userid, $userrating, $drinkid)";
        
    } else {
        $sql="UPDATE tbl_reviews SET score=$userrating WHERE userid=$userid AND drinkid=$drinkid"; 
        
    }
    mysqli_query($conn, $sql);
    
}

function isLevel($level){
    if(isset($_SESSION['level'])){
        if(intval($_SESSION['level'])>=$level){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

function fix($str_raw){
    $str_raw=trim($str_raw);
    $str_raw=stripslashes($str_raw);
    $str_raw=htmlspecialchars($str_raw); 
    return $str_raw;
}

function isUserTaken($username){
    global $conn;
    $sql="SELECT username FROM tbl_user WHERE username='$username'";
    $result=mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
        return true;
    }else{
        return false;
    }
}
function showpersonalscore($drinkid){
    global $conn;
    $userid=$_SESSION['id'];
    $sql="SELECT score FROM tbl_reviews WHERE userid=$userid AND drinkid=$drinkid";
    $result=mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
        $row=mysqli_fetch_assoc($result);
        $retStr="";
        for($vdo=0;$vdo<$row['score'];$vdo++){
            $retStr.="🫒";
        }
        return $retStr;
    }else{
        return "Not rated yet";
    }
}

function showRating($drinkid){
    global $conn;
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tbl_reviews WHERE drinkid='$drinkid' LIMIT 1")) > 0) {
        $sql="SELECT AVG(score) as rating FROM tbl_reviews WHERE drinkid='$drinkid'";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($result);
        $rating=$row['rating'];
        $sql="UPDATE tbl_drinks SET rating=$rating WHERE id=$drinkid";
        mysqli_query($conn, $sql);
        $number=intval(round($row['rating']));
        $retStr="";
        for($vdo=0;$vdo<$number;$vdo++){
            $retStr.="🫒";
        }
        return $retStr;
    } else {
        return false;
    }
}
function isAlcoholic($value){
    if($value){
        return "🥴";
    }else{
        return "🤓";
    }
}
function isSelected($val){
    $val=boolval($val);
    if($val){
        return true;
    }else{
        return false;
    }
}
function getUsername(){
    global $conn;
    $userid=$_SESSION['id'];
    $sql="SELECT username FROM tbl_user WHERE id=$userid";
    $result=mysqli_query($conn, $sql);
    $row=mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)>0){
        
        return $row['username'];
    }else{
        return "Guest";
    }
}
?>