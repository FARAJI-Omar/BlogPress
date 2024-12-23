<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign In</title>
    <link rel="stylesheet" href="style1.css?v=<?php echo time(); ?>">
</head>
<body>
    <header>
        <?php 
            include("header.php");
        ?>
    </header>

    <?php 
        $username_error = $signin_error = '';

        if(isset($_POST['signin'])){

            include("database.php");

            $isValid = true;

            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
            if(empty($username)){
                $username_error = "Invalid Username";
                $isValid = false;
            }

            $password = $_POST['password'];
            if(empty($password)){
                $isValid = false;
            } 
            if($isValid){
                $sql = "SELECT * FROM users WHERE username = '$username'";
                $result = mysqli_query($conn, $sql);
                
                // Check if username exists
                if ($result && mysqli_num_rows($result) > 0) {
                    $user = mysqli_fetch_assoc($result);


                     // Verify password
                     if (  password_verify($password, $user['password'])) {
                        session_start();

                        echo  $user['password'];
                        echo $password;
                        $_SESSION['username'] = $user['username'];

                        header("Location: dashboard.php");
                        exit();
                    }

                } else {
                    $signin_error = "Invalid username or password.";
                }
            }
            mysqli_close($conn);
        } 
    ?> 

<?php 
    $username_error = $signin_error = '';

    if (isset($_POST['signin'])) {
        include("database.php");

        if (!$conn) {
            echo 'connection failed';
        }

        $isValid = true;

        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($username)) {
            $username_error = "Invalid Username";
            $isValid = false;
        }

        $password = $_POST['password'];
        if (empty($password)) {
            $signin_error = "Password cannot be empty.";
            $isValid = false;
        }

        if ($isValid) {
            $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            //
            echo "1.$username";
            echo "2.$password";
            //

            if ($result && $result->num_rows > 0) {
                $user = $result->fetch_assoc();

                if (password_verify($password, $user['password'])) {
                    session_start();

                    $_SESSION['username'] = $user['username'];

                    header("Location: dashboard.php");
                    exit();
                } else {
                    $signin_error = "Invalid username or password.";
                }
            } else {
                $signin_error = "Invalid username or password.";
            }

            $stmt->close();
        }

        mysqli_close($conn);
    }
?> 


    <div class="signin">
        <h2>Sign In</h2>
        <form action="signin.php" method="POST">
            <label>Username:</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
            <div class="error"><?php echo $username_error; ?></div>

            <label>Password:</label>
            <input type="password" name="password">

            <input class="submit" type="submit" name="signin" value="Sign In">
            <br><br>
            <div class="error"><?php echo $signin_error; ?></div>
            <p>Don't have an account? <a href="signup.php">Create account</a></p>

        </form>
    </div>

<footer>
<?php 
    include("footer.php");
?>
</footer>

</body>
</html>


