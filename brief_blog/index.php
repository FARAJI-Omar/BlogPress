<?php 
    include("database.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog Card</title>
  <link rel="stylesheet" href="style1.css">
</head>
<body>
<header>
    <?php 
        include("header.php");
    ?>
</header>

    <main class="container">
        <?php
        $query = "SELECT article_id, created_at, title, content, username FROM articles";
        $resu = mysqli_query($conn, $query);
        ?>

        <?php
       while($article = mysqli_fetch_assoc($resu)) {
        ?>

  <div class="blog-card">
    <img src="images/cover.jpg" alt="Blog Image" class="blog-image">
    <div class="blog-content">
      <h2 class="blog-title1"><?php echo htmlspecialchars($article['title'])?></h2>
      <p class="blog-date"><?php echo htmlspecialchars($article['created_at'])?></p>
      <p class="blog-description">
        <?php echo htmlspecialchars(substr($article['content'], 0, 20)) . '...'; ?>
      </p>
      <a href="readmore.php?id=<?php echo $article['article_id']; ?>" class="read-more-button">Read More</a>
    </div>
  </div>
  <?php
       }
        ?>
  </main>
</body>
</html>
