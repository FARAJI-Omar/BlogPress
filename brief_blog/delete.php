<?php
include("database.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("location: signin.php");
    exit();
}

if (isset($_POST["delete"])) {
    $article_id = $_POST["article_id"]; 
    $user_id = $_SESSION['username']; 

    // Prepare and execute the SQL query to delete the article
    $query = "DELETE FROM articles WHERE article_id = ? AND username = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("is", $article_id, $user_id);

        if ($stmt->execute()) {
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Error deleting article: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Error deleting article.');</script>";
    }
}
?>