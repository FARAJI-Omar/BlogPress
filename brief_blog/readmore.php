<?php 
    include("database.php");

    $id = $_GET['id'];


    $query = "UPDATE articles SET views = views + 1 where article_id = $id";
    mysqli_query($conn, $query);

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
    <span class="flex flex-row items-center">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
        </svg>
        <span><?php echo $article['views']; ?> views</span>
        <svg class="jaime w-5 h-5 ml-2" fill="white" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                    <span id="likeCount"><?php echo $article['likes']; ?> <button id="like">likes</button></span>
                                    
        </span>

    <!-- Comment Section -->
    <section class="comments-section">
      <h2 class="comments-title">Leave a Comment</h2>
      <form class="comment-form">
        <textarea class="comment-input" placeholder="Write your comment..." rows="4" required></textarea>
        <button type="submit" class="comment-button">Submit Comment</button>
      </form>
      <div class="comment-list">
        <h3 class="comment-list-title">Comments</h3>
        <div class="comment">
          <p><strong>User1:</strong> Great article! Very informative and well-designed.</p>
        </div>
        <div class="comment">
          <p><strong>User2:</strong> I love the compact layout. It’s modern and easy to read.</p>
        </div>
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
