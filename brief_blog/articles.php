<?php 
include("database.php");
session_start();

if (isset($_POST["create"])) {
    
    $title = htmlspecialchars(trim($_POST["arttitle"]));
    $content = htmlspecialchars(trim($_POST["artcontent"]));
    $user_id = $_SESSION['username'];

   
    if (!empty($title) && !empty($content)) {
        // Prepare the SQL query to insert the article into the database
        $query = "INSERT INTO articles (title, content, username) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            // Bind the parameters to prevent SQL injection
            $stmt->bind_param("sss", $title, $content, $user_id);

            // Execute the query
            if ($stmt->execute()) {
              // Redirect to avoid form resubmission
              header("Location: articles.php"); 
              exit();
            } else {
                echo "<script>alert('Error creating article: " . $stmt->error . "');</script>";
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "<script>alert(' Error. Please try again later.');</script>";
        }
    } else {
        echo "<script>alert('All fields are required.');</script>";
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
       <div class="stats"><h2><Str>Statistics</Str></h2></div>
    </div>

    <div class="content">
        <button class="createBtn">Create Article</button>
        <div id="createArticleBox" class="createArticleBox">
            <div class="boxContent">
                <button id="close">X</button>

                <h2>New Article</h2>

                    <form id="articleForm" action="articles.php" method="post">
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
            $query = "SELECT title, username, created_at FROM articles WHERE username = ?";
            $stmt = $conn->prepare($query);

            if ($stmt) {
                $stmt->bind_param("s", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();

                // Loop through the result and display each article
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="created_article">';
                    echo '<div class="title1">Title: ' . htmlspecialchars($row['title']) . '</div>';
                    echo '<div class="author1">Author: ' . htmlspecialchars($row['username']) . '</div>';
                    echo '<div class="date1">Created at: ' . htmlspecialchars($row['created_at']) . '</div>';
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
        include("footer.html");
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