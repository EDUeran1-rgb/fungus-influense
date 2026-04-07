<!DOCTYPE html>
<?php require_once("asset.php"); ?>
<?php if(isset($_POST['userrating'])):rate(intval($_POST['userrating']), intval($_POST['revid']), intval($_POST['revtype']));
header("Location: index.php"); 
endif;
if(isset($_POST['btnparent'])){
    comment(intval($_POST['parentid']), htmlentities($_POST['text']), 'none');
    header("Location: index.php");
}
?>

<?php
$mess="";
if(isset($_SESSION['mess'])){
    $mess=$_SESSION['mess'];
}else{
    $mess="";
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
        <h1>Main Page</h1>
    </header>
<?php require_once("_nav.php"); ?>
    <main>
<h1 class="message"><?=$mess;?></h1>
<?php if (isLevel(10)) { ?>
    <a href="add_post.php" class="addpost">Add new post!</a>
<?php } ?>

<?php
    $sql="SELECT * FROM tbl_posts WHERE parentid='0' ORDER BY rating DESC"; 
    $result=mysqli_query($conn, $sql);
?>
<?php while($row=mysqli_fetch_assoc($result)): ?>

<details>
    <summary>
        <div>
            <h2><?=getUsername2($row['userid'])?> <?=$row['created']?></h2>
            
            <p><?=$row['text']?></p></div> 
            
            <div class="filler"></div>
            <?php if(islevel(10)) { ?>
            <?php if (showRating($row['id']) !== false) { ?>
                <div class="ratingdiv">Rated: <?=showRating($row['id'])?> </div> 
            <?php }else { ?>
                <div class="ratingdiv">Not rated yet</div>
            <?php } ?>
                <div id="ratearea">
                    <?php if(!hasrated($row['id'])){ 
                        echo "<p>Rate this:</p>";
                    }else{ 
                        echo "<p>You have rated this:" . showpersonalscore($row['id']) . ".<br> Update your rating:</p>";
                     } ?>
                    
                    <form class="rate-form" action="index.php" method="POST">
                        <input type="hidden" name="revid" value="<?=$row['id']?>">
                        <input type="hidden" name="revtype" value="post">
                        <button  name="userrating" value="1" class="rate">1</button>
                        <button  name="userrating" value="2" class="rate">2</button>
                        <button  name="userrating" value="3" class="rate">3</button>
                        <button  name="userrating" value="4" class="rate">4</button>
                        <button  name="userrating" value="5" class="rate">5</button>
                    </form>
                    

                </div>
            <?php } ?>
    </summary>
    <?php if(islevel(10)) { ?>
    <div class="addcomment">
        <pre><form class="addpost" action="index.php" method="POST">
            <input type="hidden" name="parentid" value="<?=$row['id']?>">
            <input type="text" name="text" placeholder="Add a comment" required>
            <input type="submit" name="btnparent" value="Add Comment">
        </form>
        </pre>
    </div>
    <?php } ?>
    <div class="comments">
        <?php
            $parid=$row['id'];
            $sql2="SELECT * FROM tbl_posts WHERE parentid=$parid ORDER BY created ASC"; 
            $result2=mysqli_query($conn, $sql2);
        ?>
        <?php while($row2=mysqli_fetch_assoc($result2)): ?>

        <div class="comment">
            <div>
                <div>
                    <h2><?=getUsername2($row2['userid'])?> <?=$row2['created']?></h2>
                    
                    <p><?=$row2['text']?></p></div> 
                    
                    <div class="filler">
                    <?php if(islevel(10)) { ?>
                    <?php if (showRating($row2['id']) !== false) { ?>
                        <div class="ratingdiv">Rated: <?=showRating($row2['id'])?> </div> 
                    <?php }else { ?>
                        <div class="ratingdiv">Not rated yet</div>
                    <?php } ?>
                    
                        <div id="ratearea">
                            <?php if(!hasrated($row2['id'])){ 
                                echo "<p>Rate this:</p>";
                            }else{ 
                                echo "<p>You have rated this:" . showpersonalscore($row2['id']) . ".<br> Update your rating:</p>";
                            } ?>
                            
                            <form class="rate-form" action="index.php" method="POST">
                                <input type="hidden" name="revid" value="<?=$row2['id']?>">
                                <input type="hidden" name="revtype" value="post">
                                <button  name="userrating" value="1" class="rate">1</button>
                                <button  name="userrating" value="2" class="rate">2</button>
                                <button  name="userrating" value="3" class="rate">3</button>
                                <button  name="userrating" value="4" class="rate">4</button>
                                <button  name="userrating" value="5" class="rate">5</button>
                            </form>
                            
                        </div>
                        <?php }  ?>
                    </div>
                
            </div>
        </div>
        <?php endwhile; ?>
    </div>


    </div>
</details>
<?php endwhile;  ?>


    
<?php require_once("_footer.php"); ?>
    <dialog id="login" popover>
        <form action="_login.php" method="POST">
            <input type="hidden" name="thelink" value="index.php">
            <label for="user">Username</label>
            <input type="text" name="user" placeholder="Username" required>
            <label for="pass">Password</label>
            <input type="password" name="pass" placeholder="Password" required>
            <input type="submit" name="btn_login" value="Log in">
        </form>
    </dialog>
    </main>
</body>
</html>