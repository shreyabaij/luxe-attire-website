<?php
session_start();

// Get order details from URL parameters
if (isset($_GET['order']) && isset($_GET['total'])) {
    $orderData = explode(", ", urldecode($_GET['order']));
    $totalAmount = htmlspecialchars($_GET['total']);
} else {
    echo "No order found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background: #f9f9f9;
            padding: 20px;
        }
        .order-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            display: inline-block;
        }
        .product {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }
        .product img {
            width: 80px;
            height: 80px;
            border-radius: 5px;
            object-fit: cover;
        }
        .btn-confirm {
            background: purple;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 10px;
        }
        .btn-confirm:hover {
            background: darkviolet;
        }
    </style>
</head>
<body>

    <div class="order-container">
        <h2>Confirm Your Order</h2>

        

        <h3>Total Amount: Rs. <?= htmlspecialchars($totalAmount) ?></h3>

            <form action="thankyou.php" method="POST">
                <input type="hidden" name="order" value="<?= htmlspecialchars($_GET['order']) ?>">
                <input type="hidden" name="total" value="<?= htmlspecialchars($totalAmount) ?>">
                <button type="submit" class="btn-confirm">Confirm Order</button>
            </form>
    </div>

</body>
</html>
