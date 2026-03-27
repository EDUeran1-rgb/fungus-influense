<!DOCTYPE html>
<?php require_once("asset.php"); ?>
<?php
if(isLevel(10)){ 
    header("Location: index.php");
}
if(isset($_POST['btn_reg'])){
    $username=$_POST['username'];
    $realname=$_POST['realname'];
    $mail=$_POST['mail'];
    $password=md5($_POST['password']);
    $sql="INSERT INTO tbl_user(username, password, realname, mail) VALUES ('$username', '$password', '$realname', '$mail')";
    $result=mysqli_query($conn, $sql);
    header("Location: register.php?reg=aac7d883b45");
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Register</h1>
    </header>
    <?php require_once("_nav.php"); ?>
    <main>
    <?php if(isset($_GET['reg'])): ?>
            <h1>Thank you for registering a user!</h1>
            <a href="index.php">Go to homepage</a>
    <?php else: ?>    
    <form action="register.php" method="POST">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" placeholder="Preferred username" required >
        <label for="realname">Real Name</label>
        <input type="text" name="realname" id="realname" placeholder="Your real name"required>
        <label for="mail">Email</label>
        <input type="email" name="mail" id="mail" placeholder="Your email adress" required>
        <label for="password">Password</label>
        <input type="text" name="password" id="password" placeholder="Password (min 14 chars)" required  pattern=".{14,}">
        <input type="submit" name="btn_reg" value="Create user">
    </form>
    <?php endif; ?>
    </main>
    <?php require_once("_footer.php"); ?>
</body>
</html>
<script>
    //validate if username is taken
    const username=document.getElementById("username");
    names=[
        <?php
            $sql="SELECT username FROM tbl_user";
            $result=mysqli_query($conn, $sql);
            while($row=mysqli_fetch_assoc($result)): ?>
                "<?=$row['username']?>",
        <?php endwhile; ?>
    ]
    username.addEventListener("input", function(){
        if(names.includes(username.value)){
            username.setCustomValidity("Username is already taken");
            username.reportValidity();

        }else{
            username.setCustomValidity("");
            username.reportValidity();

        }
    });
    
</script>