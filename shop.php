<?php
include("config.php");

// Fetch products from the database
$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxe Attire</title>
    <link href="shop.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>
<body>

<header>
    <nav class="navbar">
        <div class="logo-container">
            <img src="images/logo.jpg" alt="Logo" class="logo">
            <h1>LUXE <span>ATTIRE</span></h1>
        </div>
        <ul class="nav-links">
            <li><a href="home.php">Home</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="sales.php">Sales</a></li>
        </ul>
        <div class="nav-buttons">
            <a class="button logout" href="logout.php">Logout</a>
        </div>
    </nav>
    <div id="cart-icon">
        <i class="ri-shopping-bag-line add-cart"></i>
        <span class="cart-item-count">0</span>
    </div>
</header>

<div class="cart">
    <h2 class="cart-title">Your Cart</h2>
    <div class="cart-content"></div>
    <div class="total">
        <div class="total-title">Total</div>
        <div class="total-price">Rs. 0</div>
    </div>
    <button class="btn-buy">Buy Now</button>
    <i class="ri-close-line" id="cart-close"></i>
</div>

<section class="shop">
    <h1 class="section-title">Shop Products</h1>
    <div class="product-content">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="product-box">
                <div class="img-box">
                    <img src="images/product items/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                </div>
                <h2 class="product-title"><?php echo $row['name']; ?></h2>
                <div class="price-and-cart">
                    <span class="price">Rs.<?php echo intval($row['price']); ?></span>
                    <i class="ri-shopping-bag-line add-cart"></i>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<footer>
    <div class="footerContainer">
        <div class="socialIcons">
            <a href="#"><i class="fa-brands fa-facebook"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-twitter"></i></a>
        </div>
        <div class="footerNav">
            <ul>
                <li><a href="AboutUs.html">About</a></li>
                <li><a href="Contact.html">Contact Us</a></li>
            </ul>
        </div>
    </div>
    <div class="footerBottom">
        <p>&copy; 2025 LUXE ATTIRE . All rights reserved.</p>
    </div>
</footer>

<script src="luxe.js"></script>

</body>
</html>
