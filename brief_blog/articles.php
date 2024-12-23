<?php 
include("database.php");
session_start();

  // Redirect to signin.php if no user is logged in
  if (!isset($_SESSION['username'])) {
    header("location: signin.php");
    exit();
}

if (isset($_POST["create"])) {
    
    $title = htmlspecialchars(trim($_POST["arttitle"]));
    $content = htmlspecialchars(trim($_POST["artcontent"]));
    $user_id = $_SESSION['username'];

   
    if (!empty($title) && !empty($content)) {
        $query = "INSERT INTO articles (title, content, username) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            // Bind the parameters to prevent SQL injection
            $stmt->bind_param("sss", $title, $content, $user_id);

            // Execute the query
            if ($stmt->execute()) {
              header("Location: articles.php"); 
              exit(); 
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "<script>alert(' Error. Please try again later.');</script>";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
</head>
<body>
<header>
    <div>
        <?php 
            include("header.php");
        ?>
    </div>

    <div>
        <form action="dashboard.php" method="POST">
            <input type="submit" name="logout" value="log Out" class="logout">
        </form>
    </div>

</header>

<div class="mainView">
    <div class="sidebar">
       <img src="images/user icon2.png" alt="">
       <div class="sessionUser"> <?php echo $_SESSION['username']; ?> </div>
       <div class="articles"><h2>Articles</h2></div>
       <div class="createBtn"><h2>Create Article</h2></div>
       <div class="stats"><h2>Statistics</h2></div>
    </div>

    <div class="content">
        <div id="createArticleBox" class="createArticleBox">
            <div class="boxContent">
                <button id="close">X</button>

                <h2>New Article</h2>

                    <form id="articleForm" action="articles.php" method="POST">
                    <label for="articleTitle" class="artlabel">Title:</label>
                    <input type="text" id="articleTitle" name="arttitle" required>
                    <label for="articleContent" class="artlabel">Content:</label>
                    <textarea id="articleContent" name="artcontent" rows="4" cols="50" required></textarea>    
                    <input class="artsubmit" type="submit" name="create" value="Create">
                    </form>
            </div>
        </div>

        <div class="createdart">

        <?php
            // Fetch articles created by the logged-in user
            $user_id = $_SESSION['username'];
            $query = "SELECT article_id, title, content, created_at FROM articles WHERE username = ?";
            $stmt = $conn->prepare($query);

            if ($stmt) {
                $stmt->bind_param("s", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();

                // Loop through the result and display each article
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="created_article">';
                    echo '<div class="title1">' . htmlspecialchars($row['title']) . '</div>';
                    echo '<div class="content1">' . htmlspecialchars($row['content']) . '</div>';
                    echo '<div class="date1">Created at: ' . htmlspecialchars($row['created_at']) . '</div>';
                    echo '<div class="buttons">';
                    echo '<form method="POST" action="delete.php">';
                    echo '<input type="hidden" name="article_id" value="' . $row['article_id'] . '">';
                    echo '<button type="submit" name="delete" class="deletebtn">Delete</button>';
                    echo '</form>';

                    echo '<form method="POST" action="edit.php">';
                    echo '<input type="hidden" name="article_id" value="' . $row['article_id'] . '">';
                    echo '<button type="submit" name="edit" class="editbtn">Edit</button>';
                    echo '</form>';


                    echo '</div>';
                    echo '</div>';
                }

                // Close the statement
                $stmt->close();
            } else {
                echo '<div class="error">Error fetching articles. Please try again later.</div>';
            }
        ?>
        </div>

    </div>

</div>




<!-- <footer>
    <?php 
        include("footer.php");
    ?>
</footer> -->
<script src="main.js"></script>

</body>
</html>

<?php
    if(isset($_POST["logout"])){
        session_destroy();
        header("location: signin.php");
        exit();
    }
?>