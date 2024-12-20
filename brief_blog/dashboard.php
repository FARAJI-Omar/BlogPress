<?php 
    include("database.php");
    session_start();

    // Redirect to signin.php if no user is logged in
    if (!isset($_SESSION['username'])) {
        header("location: signin.php");
        exit();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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