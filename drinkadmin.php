<!DOCTYPE html>
<?php require_once("asset.php"); ?>
<?php
if(!isLevel(1000)){ 
    header("Location: index.php");
}
if(isset($_GET['del'])){
    $id=intval($_GET['del']);
    $sql="DELETE FROM tbl_drinks WHERE id=$id";
    $result=mysqli_query($conn, $sql);
    $sql="DELETE FROM tbl_reviews WHERE drinkid=$id";
    $result=mysqli_query($conn, $sql);
    header("Location: drinkadmin.php");
}

if(isset($_POST['btn_edit'])){
    $id=intval($_POST['id']);
    $drink=htmlentities($_POST['drinkname']);
    $desc=htmlentities($_POST['desc']);
    $alc=intval($_POST['alcoholic']);
    $ingr=htmlentities($_POST['ingredients']);
    $rec=htmlentities($_POST['recipe']);

    $sql="UPDATE `tbl_drinks` SET `id`=$id,`drinkname`='$drink',`description`='$desc',`ingredients`='$ingr',`recipe`='$rec',`alcoholic`=$alc,`rating`=$rating WHERE id=$id";
    $result=mysqli_query($conn, $sql);
    header("Location: drinkadmin.php");
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
        <h1>User admin</h1>
    </header>
    <?php require_once("_nav.php"); ?>
    <main>
        <?php  if(isset($_GET['edit'])): ?>
            <?php
                $id=intval($_GET['edit']);
                $sql="SELECT * FROM tbl_drinks WHERE id=$id";
                $result=mysqli_query($conn, $sql);
                $row=mysqli_fetch_assoc($result);

            ?>
        <form action="drinkadmin.php" method="POST">
            <input type="hidden" name="id" value="<?=$id?>">
            <div class="user_data"><?=$id?>&nbsp;&nbsp;<?=$row['drinkname']?><br><?=$row['description']?><br><?=$row['rating']?></div>
            <label for="drinkname">Drink name:</label>
            <input type="text" name="drinkname" id="drinkname" value="<?=$row['drinkname']?>">
            <label for="desc">Description:</label>
            <input type="text" name="desc" id="desc" value="<?=$row['description']?>">
            <label for="alcoholic">Is there alcohol in this drink?</label>
            <select name="alcoholic">
                <option value="0" <?php if($row['alcoholic']==0){echo "selected";} ?> >Not alcoholic</option>
                <option value="1" <?php if($row['alcoholic']==1){echo "selected";} ?> >Contains alcohol</option>
            </select>
            <label for="ingredients">Ingredients (Separate rows)</label>
            <textarea name="ingredients" rows="6"><?=$row['ingredients']?></textarea>
            <label for="recipe">How do you build the drink?</label>
            <textarea name="recipe" rows="6"><?=$row['recipe']?></textarea>
            <input type="submit" name="btn_edit" value="Update drink">
        </form>
        <?php else: ?>
 <?php
    $sql="SELECT * FROM tbl_drinks ORDER BY rating DESC"; 
    $result=mysqli_query($conn, $sql);
?>
<?php while($row=mysqli_fetch_assoc($result)): ?>
<details>
    <summary>
        <div>
            <h2><?=$row['drinkname']?>&nbsp;&nbsp;<span><?=isAlcoholic(intval($row['alcoholic']))?></span></h2>
            <h4><?=$row['description']?></h4></div> 
            <div class="filler"></div>
            <?php if (showRating($row['id']) !== false) {
                $rating2 = "Rated:" . showRating($row['id']);
            }else {
                $rating2 = "Not rated yet";
             } ?>  
            <div> <?=$rating2?> &nbsp;&nbsp;<a href="drinkadmin.php?edit=<?=$row['id']?>">🖋️</a>&nbsp;&nbsp;<a href="drinkadmin.php?del=<?=$row['id']?>">❌</a></div>   
    </summary>
    <div class="ingredients">
        <pre><?=$row['ingredients']?></pre>
    </div>
    <div class="recipe">
        <pre><?=$row['recipe']?></pre>
    </div>
</details>
<?php endwhile; ?>
            <?php endif; ?>
    </main>
    <?php require_once("_footer.php"); ?>
</body>
</html>