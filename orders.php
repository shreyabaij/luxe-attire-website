<?php
session_start();
include("config.php");

// Check if admin is logged in
if (!isset($_SESSION["admin"])) {
    header("Location: admin_login.php");
    exit();
}
$query = "SELECT * FROM orders WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();


// Fetch orders from the database
$result = mysqli_query($conn, "SELECT orders.id, users.username, orders.order_details, orders.total_price
FROM orders 
JOIN users ON orders.user_id = users.id"); // Join users table to get username
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Orders</title>
    <link rel="stylesheet" href="order.css">
</head>
<body>
    <h2>Order Records</h2>
    <a href="dashboard.php">Back to Dashboard</a>
    
    <table border="1">
        <tr>
            <th>ID</th>
            <th>User Name</th>
            <th>Products</th>
            <th>Total Price</th>
          
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["username"]; ?></td>
            <td><?php echo $row["order_details"]; ?></td>
            <td>Rs.<?php echo $row["total_price"]; ?></td>
        
        </tr>
        <?php } ?>
    </table>
    <style>  a {
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
        }</style>
    <a href="home.php">Return to Homepage</a>

</body>
</html>
