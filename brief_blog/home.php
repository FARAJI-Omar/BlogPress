<?php 
    include("database.php");
    

    mysqli_close($conn);
?>

<?php 
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: signin.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<header>
    <div>
        <?php 
            include("header.php");
        ?>
    </div>
    <div>
        <form action="home.php" method="POST">
            <input type="submit" name="logout" value="logout" class="logout">
        </form>
    </div>
</header>

<h1>home page</h1>



<footer>
    <?php 
        include("footer.html");
    ?>
</footer>
</body>
</html>

<?php
    echo $_SESSION['username'] . "<br>";
    echo $_SESSION['password'] . "<br>";

    if(isset($_POST["logout"])){
        session_destroy();
        header("location: signin.php");
    }
?>