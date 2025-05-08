<?php
include("config.php"); // Ensure database connection

if (isset($_GET["id"])) {
    $id = intval($_GET["id"]); // Ensure id is an integer

    // Prepare a statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error deleting product: " . $conn->error;
    }
    
    $stmt->close();
} else {
    echo "Invalid Product ID";
}
?>
