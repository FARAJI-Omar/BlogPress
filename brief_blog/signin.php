<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style1.css?v=<?php echo time(); ?>">
</head>
<body>
    <header>
        <?php 
            include("header.php");
        ?>
    </header>

    <div class="signin">
        <h2>Sign In</h2>
        <form action="signin.php" method="POST">
            <label>Username</label>
            <input type="text" name="username">
            <div class="error"></div>

            <label>Password</label>
            <input type="password" name="password">
            <div class="error"></div>

            <input class="submit" type="submit" name="signin" value="Sign In">
        </form>
    </div>
    <?php 
        if(isset($_POST['signin'])){
    
            session_start();
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['password'] = $_POST['password'];

            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
            if(empty($username)){
                echo 'username is required';
            }
        
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
            if(empty($email)){
                echo 'email is required';
            }
        
            $password = $_POST['password'];
            if(empty($password)){
                echo 'password is required';
            }

            header("location: home.php");

        }
    ?>



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
?>
