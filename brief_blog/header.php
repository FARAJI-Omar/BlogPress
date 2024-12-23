<header class="header">
<link rel="stylesheet" href="style1.css?v=<?php echo time(); ?>">

<img src="images/logo-cutout.png" class="logo"></img>

<div class="headLinks">
<?php 
if(isset($_SESSION['username'])){
echo '<a href="Dashboard.php">Dashboard</a>';
}
?>

<a href="index.php">Home</a>
<a href="#" onclick="scrollToBottom()">Contact Us</a>
<a href="faq.php">FAQ</a>
<a href="about.php">About</a>
<?php 
if(!isset($_SESSION['username'])){
echo '<a id="signinlink" href="signin.php">SignIn</a>';
}
?>
</div>

<script>
    function scrollToBottom() {
        window.scrollTo({
            top: document.body.scrollHeight,
            behavior: 'smooth'
        });
    }
</script>

</header>

