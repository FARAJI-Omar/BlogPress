
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
    <?php 
        include("header.php")
    ?>
    </header>

<main class="about_body">
<div class="about_text">
<div class="about_content">
<h2>About BlogPress</h2>
<h3>Welcome to BlogPress!</h3>
<p>BlogPress is a modern blogging platform designed to empower users to publish, explore, and analyze blog content. Built with PHP and MySQL, BlogPress combines simplicity and functionality, offering a seamless experience for both authors and visitors. It integrates user-friendly interfaces with insightful analytics to track article performance, making it the perfect tool for bloggers and content enthusiasts.
</p>
<br><br>
<h2>Our Vision</h2>
<p>To create an intuitive platform where users can share their stories and insights while leveraging analytics to enhance content impact.</p>
<br><br>

<h2>Key Features</h2>
<p><b>User Authentication System</b><ul>
<li>Sign-Up and Log-In: Simple and secure registration and authentication for all users.</li>
<li>Role Management: Tailored experiences for authors and visitors.</li>
<li>Secure Routes: Protect sensitive pages and features from unauthorized access.</li>
</ul></p>
<br>
<p><b>Homepage</b><ul>
<li>Browse articles ranked by popularity.</li>
<li>Discover insights like views and comments per article.</li>
<li>Interactive charts (powered by Chart.js) for visualizing popular content.</li>
</ul></p>
<br>
<p><b>Article Pages</b><ul>
<li>Engage with content through comments and likes.</li>
<li>See live view counters and estimated reading times for each article.</li>
</ul></p>
<br>
<p><b>Author Dashboard</b><ul>
<li>Manage articles with full CRUD capabilities.</li>
<li>Track trends using interactive graphs to visualize growth over time</li>
<li>Access detailed statistics on article performance, including views, comments, and likes.</li>
</ul></p>
<br>
</div>
</div>
</main>



<?php 
    include("footer.php")
?>
</body>
</html>