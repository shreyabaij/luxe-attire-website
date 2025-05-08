<?php
session_start();
include("config.php"); // Include database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Error: You must be logged in to place an order.");
}

// Get user details from session
$user_id = $_SESSION['user_id'];
$totalAmount = isset($_POST['total']) ? floatval($_POST['total']) : 0;
$orderDetails = isset($_POST['order']) ? trim($_POST['order']) : "";

// Verify if user exists in the database
$user_check_query = "SELECT id FROM users WHERE id = ?";
$stmt = $conn->prepare($user_check_query);

if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 0) {
    $stmt->close();
    die("Error: User does not exist in the database.");
}
$stmt->close();

// Insert order into the database
$order_query = "INSERT INTO orders (user_id, order_details, total_price) VALUES (?, ?, ?, NOW())";
$stmt = $conn->prepare($order_query);

if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("isd", $user_id, $orderDetails, $totalAmount);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    header("Location: thankyou.php"); // Redirect to thank you page
    exit();
} else {
    die("Error placing order: " . $stmt->error);
}

// Close database connection
$conn->close();
?>
