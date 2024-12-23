<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signUp</title>
    <link rel="stylesheet" href="style1.css?v=<?php echo time(); ?>">
</head>
<body>
    <header>
        <?php 
            include("header.php");
        ?>
    </header>

    <?php 
        $username_error = $email_error = $password_error = $signup_error = '';

        if(isset($_POST['signup'])){
            include("database.php");

            $isValid = true;

            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
            if(empty($username)){
                $username_error = "Invalid Username!";
                $isValid = false;
            }

            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
            if(empty($email)){
                $email_error = "Invalid Email!";
                $isValid = false;
            }

            $password = $_POST['password'];
            if(empty($password)){
                $password_error = "Invalid Password.";
                $isValid = false;
            }

            if($isValid){
                $username = mysqli_real_escape_string($conn, $username);
                $email = mysqli_real_escape_string($conn, $email);

                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                  // Check if the username already exists
                  $checkUsernameSql = "SELECT * FROM users WHERE username = '$username'";
                  $checkUsernameResult = mysqli_query($conn, $checkUsernameSql);

                  $checkEmailSql = "SELECT * FROM users WHERE email = '$email'";
                  $checkEmailResult = mysqli_query($conn, $checkEmailSql);

                  if (mysqli_num_rows($checkUsernameResult) > 0) {
                    $username_error = "Username already exists. Please choose a different username";
                }else if(mysqli_num_rows($checkEmailResult) > 0){
                     $email_error = "Email already exists. Please choose a different email";
                }else { 
                    // If username and email do not exist, insert into the database
                    $sql = "INSERT INTO users (username, email, password) 
                            VALUES ('$username', '$email', '$hashed_password')";


                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        header("location: signin.php");
                        exit();
                    }else{
                        $signup_error = "An error occurre! Please try again";
                    }
                
                }
            }
            mysqli_close($conn);
        } 
    ?>

    <div class="signup">
        <h2>Create an account</h2>
        <form action="signup.php" method="POST">
            <label>Username:</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
            <div class="error"><?php echo $username_error; ?></div>

            <label>email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
            <div class="error"><?php echo $email_error; ?></div>

            <label>Password:</label>
            <input type="password" name="password">
            <div class="error"><?php echo $password_error; ?></div>

            <input class="submit" type="submit" name="signup" value="Sign Up">
            <br><br>
            <div class="error"><?php echo $signup_error; ?></div>
            <p>Have an account? <a href="signin.php">Sign in</a></p>
        </form>
    </div>

<footer>
<?php 
    include("footer.php");
?>
</footer>

</body>
</html>


