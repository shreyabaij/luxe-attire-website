<?php 
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Luxe Attire</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="logo-container">
                <img src="images/logo.jpg" alt="Logo" class="logo">
                <h1>LUXE <span>ATTIRE</span></h1>
            </div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="sales.php">Sales</a></li>
            </ul>
            <div class="nav-buttons">
                <!-- Force Admin Button to Show -->
                <a class="button admin" href="admin_login.php">Admin</a>

                <?php if ($username): ?> 
                    <span class="username">Hello, <?php echo htmlspecialchars($username); ?>!</span> 
                    <a class="button logout" href="logout.php">Logout</a> 
                <?php else: ?> 
                    <a class="button login" href="login.php">Log In</a>
                <?php endif; ?> 
            </div>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>WHERE FASHION <br> <span>MEETS CONFIDENCE</span></h1> 
            <a class="btn shop-now" href="shop.php">SHOP NOW</a>
        </div>
    </section>

    <footer class="footer" style="margin-top: 1%;">
        <div class="footer-container">
            <div class="social-icons">
                <a href="#"><i class="fa-brands fa-facebook"></i></a> 
                <a href="#"><i class="fa-brands fa-instagram"></i></a> 
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
            </div>
            <ul class="footer-nav">
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
            <p>&copy; 2025 LUXE ATTIRE. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>
