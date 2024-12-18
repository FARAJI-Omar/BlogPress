<?php
session_start(); 
?>

<?php 
    include("database.php");
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (username, email, password) 
            VALUES ($username, $email, $password)";


    $result = mysqli_query($conn, $sql);

    if($result){
        echo "Data inserted successfully!";
    }
    else{
        die(mysqli_error($conn));
    }

    mysqli_close($conn);
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

    <div class="signup">
        <h2>Sign Up</h2>
        <form action="signup.php" method="POST">
            <label>Username</label>
            <input type="text" name="username">
            <div class="error"><?php echo $username_error ?? ''; ?></div>

            <label>email</label>
            <input type="email" name="email">
            <div class="error"><?php echo $email_error ?? ''; ?></div>

            <label>Password</label>
            <input type="password" name="password">
            <div class="error"><?php echo $password_error ?? ''; ?></div>

            <input class="submit" type="submit" name="signup" value="Sign up">
        </form>
    </div>
    <?php 
if(isset($_POST['signup'])){
    $isValid = true;

    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    if(empty($username)){
        echo 'username is required';
        $isValid = false;
    }

    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    if(empty($email)){
        echo 'email is required';
        $isValid = false;
    }

    $password = $_POST['password'];
    if(empty($password)){
        echo 'password is required';
        $isValid = false;
    }

    if($isValid){
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];

        header("location: signin.php");
        exit();
    }
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

