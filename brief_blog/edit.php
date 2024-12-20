<?php
include("database.php");
session_start();

// Redirect to signin.php if no user is logged in
if (!isset($_SESSION['username'])) {
    header("location: signin.php");
    exit();
}

$user_id = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['edit'])) {
        // Fetch article details for editing
        $article_id = $_POST['article_id'];

        $query = "SELECT title, content FROM articles WHERE article_id = ? AND username = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("is", $article_id, $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $article = $result->fetch_assoc();
            } else {
                echo "<script>alert('Article not found or access denied.');</script>";
                header("Location: articles.php");
                exit();
            }
            $stmt->close();
        } else {
            echo "<script>alert('Error fetching article details.');</script>";
            header("Location: articles.php");
            exit();
        }
    } elseif (isset($_POST['update'])) {
        // Update article details
        $article_id = $_POST['article_id'];
        $new_title = htmlspecialchars(trim($_POST['arttitle']));
        $new_content = htmlspecialchars(trim($_POST['artcontent']));

        if (!empty($new_title) && !empty($new_content)) {
            $update_query = "UPDATE articles SET title = ?, content = ? WHERE article_id = ? AND username = ?";
            $update_stmt = $conn->prepare($update_query);

            if ($update_stmt) {
                $update_stmt->bind_param("ssis", $new_title, $new_content, $article_id, $user_id);

                if ($update_stmt->execute()) {
                    header("Location: articles.php");
                    exit();
                } else {
                    echo "<script>alert('Error updating article.');</script>";
                }
                $update_stmt->close();
            } else {
                echo "<script>alert('Error preparing update query.');</script>";
            }
        } else {
            echo "<script>alert('Title and content cannot be empty.');</script>";
        }
    }
} else {
    header("Location: articles.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Article</title>
</head>
<body>
<header>
    <?php include("header.php"); ?>
</header>

<div class="mainView">
    <div class="content">
        <h2>Edit Article</h2>
        <form id="articleForm" action="edit.php" method="post">
            <input type="hidden" name="article_id" value="<?php echo $article_id; ?>">
            <label for="articleTitle" class="artlabel">Title:</label>
            <input type="text" id="articleTitle" name="arttitle" value="<?php echo htmlspecialchars($article['title'] ?? ''); ?>" required>
            
            <label for="articleContent" class="artlabel">Content:</label>
            <textarea id="articleContent" name="artcontent" rows="4" cols="50" required><?php echo htmlspecialchars($article['content'] ?? ''); ?></textarea>

            <input class="artsubmit" type="submit" name="update" value="Update">
        </form>
    </div>
</div>
</body>
</html>
