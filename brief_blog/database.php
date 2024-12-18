<link rel="stylesheet" href="style1.css">
<?php
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "blogpress";
$conn = "";

try{
    $conn = mysqli_connect($db_server, 
                            $db_user, 
                            $db_pass, 
                            $db_name);
}

catch(mysqli_sql_exception){
    echo '<h2 class="cnxerror">Connection error!</h2>';
    exit();
}


?>