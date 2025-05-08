<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You - Luxe Attire</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }
        .container {
            max-width: 500px;
            margin: auto;
            background: #f8f8f8;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #27ae60;
        }
        p {
            font-size: 18px;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            color: white;
            background: #27ae60;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background: #219150;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Thank You for Your Order!</h2>
    <p>Your order has been successfully placed.</p>
    <p>We appreciate your business and will process your order soon.</p>
    <a href="home.php">Return to Homepage</a>
</div>

</body>
</html>
