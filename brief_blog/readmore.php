<?php 
    include("database.php");

    $id = $_GET['id'];

    $incrementViewsQuery = "UPDATE articles SET views = views + 1 WHERE article_id = $id";
    mysqli_query($conn, $incrementViewsQuery);

    if (isset($_POST['like'])) {
      $query = "UPDATE articles SET likes = likes + 1 WHERE article_id = $id";
      mysqli_query($conn, $query);
      
      
  }
        
    $query = "SELECT article_id, created_at, title, content, views, likes, username FROM articles WHERE article_id = $id";
    mysqli_query($conn, $query);
 
   // Handle the comment submission
   if (isset($_POST['comment_user']) && isset($_POST['comment_content'])) {
    $comment_username = mysqli_real_escape_string($conn, $_POST['comment_user']);
    $comment_content = mysqli_real_escape_string($conn, $_POST['comment_content']);

    $query = "INSERT INTO comments (article_id, comment_username, content) 
              VALUES ('$id', '$comment_username', '$comment_content')";
    if (!mysqli_query($conn, $query)) {
      die("Error inserting comment: " . mysqli_error($conn));
    }
  }

  // Fetch the comments for the article
  $comments_query = "SELECT comment_username, content, created_at FROM comments WHERE article_id = $id ORDER BY created_at DESC";
  $comments_result = mysqli_query($conn, $comments_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog Card</title>
  <link rel="stylesheet" href="style1.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<header>
    <?php 
        include("header.php");
    ?>
</header>

    <main>
    <div class="blog-container">

    <?php
        $query = "SELECT article_id, created_at, title, content, views, likes, username FROM articles where article_id= $id";
        $resu = mysqli_query($conn, $query);
        ?>

        <?php
       while($article = mysqli_fetch_assoc($resu)) {
        ?>

    <section class="blog-header">
      <img src="images/cover.jpg" alt="Blog Banner" class="blog-banner">
      <div class="blog-header-content">
      <h1 class="blog-title"><?php echo htmlspecialchars($article['title'])?></h1>        
      <p class="blog-date">Published on: <?php echo htmlspecialchars($article['created_at'])?></p>
      </div>
    </section>

    <main class="blog-content">
      <p>
      <?php echo htmlspecialchars($article['content']); ?>

    </p>
    
    </main>
      <span class="flex-container">
        <svg class="icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
        </svg>        
        <span><?php echo $article['views']; ?> views</span>
        
        <span id="likeCount"><?php echo $article['likes']; ?> <button id="like">likes</button></span>
                                    
        </span>

        <form action="readmore.php?id=<?php echo $article['article_id']; ?>" method="POST">
          <button type="submit" name="like" id="likeButton" class="flex items-center">
          <img id="likebtn" src="images/like.png" alt="">
          </button>
        </form>


    <!-- Comment Section -->
    <section class="comments-section">
      <h2 class="comments-title">Leave a Comment</h2>

      <form class="comment-form" method="POST">
        <label for="comment_user" class="comment_user_label">Username:</label>
        <input type="text" id="comment_user" name="comment_user" required>
        <textarea name="comment_content" class="comment-input" placeholder="Write your comment..." rows="5" required></textarea>
        <button type="submit" class="comment-button">Submit Comment</button>
      </form>

      <div class="comment-list">
        <h3 class="comment-list-title">Comments</h3>
        <?php while ($comment = mysqli_fetch_assoc($comments_result)) { ?>
          <div class="comment">
            <p><strong><?php echo htmlspecialchars($comment['comment_username']); ?>:</strong></p>
            <p><?php echo htmlspecialchars($comment['content']); ?></p>
            <p class="text-sm text-gray-500"><?php echo htmlspecialchars($comment['created_at']); ?></p>
          </div>
          <hr>
        <?php } ?>
       
      </div>
    </section>
  </div>
  </main>
  <?PHP } ?>
  <script>
    const like = document.getElementById('like');
    const jaime= document.querySelector('.jaime');

    like.addEventListener('click', () => {
        jaime.setAttribute('fill', 'red');
        <?php 
    
         $query = "UPDATE articles SET likes = likes + 1 where article_id = $id";
         mysqli_query($conn, $query);
        ?>
        
    });
  </script>
</body>
</html>
