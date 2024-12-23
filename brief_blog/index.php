<?php 
    include("database.php");
    session_start();
?>
<?php
    if(isset($_POST["logout"])){
        session_destroy();
        header("location: signin.php");
        exit();
    }
    ?> 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="style1.css">
</head>
<body>
<header>
    <div>
    <?php 
        include("header.php");
    ?>
    </div>

    <?php if(isset($_SESSION['username'])){ echo '
    <div>
        <form action="index.php" method="POST">
            <input type="submit" name="logout" value="log Out" class="logout">
        </form>
    </div>';}
    ?>
</header>

    <main class="container">
        <?php
        $query = "SELECT article_id, created_at, title, content, username, views FROM articles ORDER BY views DESC";
        $resu = mysqli_query($conn, $query);
        ?>

        <?php
       while($article = mysqli_fetch_assoc($resu)) {
        ?>

  <div class="blog-card">
    <img src="images/cover.jpg" alt="Blog Image" class="blog-image">
    <div class="blog-content">
      <h2 class="blog-title1"><?php echo htmlspecialchars($article['title'])?></h2>
      <p class="blog-author"><?php echo htmlspecialchars($article['username'])?></p>
      
      <p class="blog-description">
          <?php echo htmlspecialchars(substr($article['content'], 0, 50)) . ' ...'; ?>
        </p> 
        <p class="blog-like"><?php echo ($article['views'])?> likes</p>

        <p class="blog-date"><?php echo htmlspecialchars($article['created_at'])?></p> 
       

      <a href="readmore.php?id=<?php echo $article['article_id']; ?>" class="read-more-button">Read More</a>
    </div>
  </div>
  <?php
       }
        ?>
  </main>

  <footer>
    <?php
    include("footer.php");
    ?>
  </footer>

</body>
</html>

