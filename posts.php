<!DOCTYPE html>
<?php require_once("asset.php"); ?>
<?php if(isset($_POST['userrating'])){
rate(intval($_POST['userrating']), intval($_POST['revid']), intval($_POST['revtype']));
    if (isset($_POST['thepost'])or isset($_GET['thepost'])) {
        header("Location: posts.php?thepost=" . urlencode(isset($_POST['thepost']) ? $_POST['thepost'] : urldecode($_GET['thepost'])). "&thetopic=" . urlencode(isset($_POST['thetopic']) ? $_POST['thetopic'] : urldecode($_GET['thetopic'])) . "&thetext=" . urlencode(isset($_POST['thetext']) ? $_POST['thetext'] : urldecode($_GET['thetext'])) . "&theuid=" . urlencode(isset($_POST['theuid']) ? $_POST['theuid'] : urldecode($_GET['theuid'])));
    } else {
        header("Location: posts.php");
}
}

if(isset($_POST['btnparent'])){
    comment(intval($_POST['parentid']), htmlentities($_POST['text']), 'none');
    if (isset($_POST['thepost'])or isset($_GET['thepost'])) {
        header("Location: posts.php?thepost=" . urlencode(isset($_POST['thepost']) ? $_POST['thepost'] : urldecode($_GET['thepost'])). "&thetopic=" . urlencode(isset($_POST['thetopic']) ? $_POST['thetopic'] : urldecode($_GET['thetopic'])) . "&thetext=" . urlencode(isset($_POST['thetext']) ? $_POST['thetext'] : urldecode($_GET['thetext'])) . "&theuid=" . urlencode(isset($_POST['theuid']) ? $_POST['theuid'] : urldecode($_GET['theuid'])));
    } else {
        header("Location: posts.php");
}
}?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Posts</h1>
    </header>
<?php require_once("_nav.php"); ?>
    <main>



<?php
    if (isset($_POST['thepost']) or isset($_GET['thepost'])) {
        $parid=isset($_POST['thepost']) ? $_POST['thepost'] : (isset($_GET['thepost']) ? $_GET['thepost'] : 1);
        $topic = isset($_POST['thetopic']) ? $_POST['thetopic'] : (isset($_GET['thetopic']) ? $_GET['thetopic'] : "err: this did not work :( for reasons trying to find out");
        $text=isset($_POST['thetext']) ? $_POST['thetext'] : (isset($_GET['thetext']) ? $_GET['thetext'] : "err: this did not work :( for reasons trying to find out");
        $theuid=isset($_POST['theuid']) ? $_POST['theuid'] : (isset($_GET['theuid']) ? $_GET['theuid'] : 1);
        $sql="SELECT * FROM tbl_posts WHERE parentid=$parid ORDER BY created ASC";  
        ?><a href="posts.php" class="addpost">Back</a><?php

        echo"<h2>" . $topic .$parid. "</h2>";
        echo"<p>" . $text . "</p>";
        echo"<p>Posted by: " . getUsername2($theuid) . "</p>";
        if(showrating($parid) !== false){
            echo"<p>Rating: " . showRating($parid) . "</p>";
        } else {
            echo"<p>Not rated yet</p>";
        }
        if(!hasrated($parid)){
            echo "<p>Rate this:</p>";
            }else{
                echo "<p>You have rated this:" . showpersonalscore($parid) . ".<br> Update your rating:</p>";
            }
        if(islevel(10)): ?>
            <form class="rate-form" action="posts.php?thepost=<?=urlencode($parid)?>&thetopic=<?=urlencode($topic)?>&thetext=<?=urlencode($text)?>&theuid=<?=urlencode($theuid)?>" method="POST">
                <input type="hidden" name="thetopic" value="<?=$topic?>">
                <input type="hidden" name="thetext" value="<?=$text?>">
                <input type="hidden" name="theuid" value="<?=$theuid?>">
                <input type="hidden" name="revid" value="<?=$parid?>">
                <input type="hidden" name="revtype" value="post">
                <button  name="userrating" value="1" class="rate">1</button>
                <button  name="userrating" value="2" class="rate">2</button>
                <button  name="userrating" value="3" class="rate">3</button>
                <button  name="userrating" value="4" class="rate">4</button>
                <button  name="userrating" value="5" class="rate">5</button>
            </form><?php endif;
    } else {
         if (isLevel(10)) { ?>
            <a href="add_post.php" class="addpost">Add new post!</a>
        <?php } 
        $sql="SELECT * FROM tbl_posts WHERE parentid='0' ORDER BY rating DESC";
    }
    $result=mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($result)): ?>

<details>
    <summary>
        <div>
            
            <h2><?=getUsername2($row['userid'])?> <?=$row['created']?></h2>
                <?php if (!isset($_POST['thepost']) && !isset($_GET['thepost'])) { ?>
                    <p><?=$row['topic']?></p>
                <?php }else{ ?>
                    <p><?=$row['text']?></p> 
                <?php } ?>
        </div>
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
                    
                    
                        <?php if (isset($_POST['thepost'])or isset($_GET['thepost'])) { ?>
                        <form class="rate-form" action="posts.php?thepost=<?=urlencode($parid)?>&thetopic=<?=urlencode($topic)?>&thetext=<?=urlencode($text)?>&theuid=<?=urlencode($theuid)?>" method="POST">
                        <input type="hidden" name="thetopic" value="<?=$topic?>">
                        <input type="hidden" name="thetext" value="<?=$text?>">
                        <input type="hidden" name="theuid" value="<?=$theuid?>">
                        <input type="hidden" name="revid" value="<?=$parid?>">
                        <?php }else{  ?>
                        <form class="rate-form" action="posts.php" method="POST">
                        <?php } ?>
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
            <?php if (!isset($_POST['thepost']) && !isset($_GET['thepost'])) { ?>
                <form action="posts.php" method="POST">
                    <input type="hidden" name="thetopic" value="<?=$row['topic']?>">
                    <input type="hidden" name="thetext" value="<?=$row['text']?>">
                    <input type="hidden" name="theuid" value="<?=$row['userid']?>">
                    <button name="thepost" value="<?=$row['id']?>">show more</button>
                </form>
                <?php } ?>
        </div>
     
    
    </summary>
</details>
<?php endwhile;  ?>
<?php if (isset($_POST['thepost'])or isset($_GET['thepost'])) { 
        if(islevel(10)) { ?>
            <div class="addcomment">
                <pre>
                    <form class="addpost" action="posts.php?thepost=<?=urlencode($parid)?>&thetopic=<?=urlencode($topic)?>&thetext=<?=urlencode($text)?>&theuid=<?=urlencode($theuid)?>" method="POST">
                        
                        <input type="hidden" name="thetopic" value="<?=$topic?>">
                        <input type="hidden" name="thetext" value="<?=$text?>">
                        <input type="hidden" name="theuid" value="<?=$theuid?>">
                        <input type="hidden" name="revid" value="<?=$parid?>">
                        
                        <input type="hidden" name="parentid" value="<?=$parid?>">
                        <input type="hidden" name="thepost" value="<?=$parid?>">
                        <input type="text" name="text" placeholder="Add a comment" required>
                        <input type="submit" name="btnparent" value="Add Comment">
                    </form>
                </pre> 
            </div>
        <?php } ?>
    <?php } ?>

    
<?php require_once("_footer.php"); ?>
    <dialog id="login" popover>
        <form action="_login.php" method="POST">
            <?php if (isset($_POST['thepost'])) { ?>
                <input type="hidden" name="thelink" value="posts.php?thepost=<?=urlencode($_POST['thepost'])?>&thetopic=<?=urlencode($_POST['thetopic'])?>&thetext=<?=urlencode($_POST['thetext'])?>&theuid=<?=urlencode($_POST['theuid'])?>">
            <?php } else { ?>
                <input type="hidden" name="thelink" value="posts.php">
            <?php } ?>
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