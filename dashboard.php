<?php
session_start();
include("config.php");

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM products");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <h2>Admin Dashboard</h2>
    <a href="add_product.php">Add Product</a> 
    <a href="orders.php">Ordered Product</a>
   
    
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td>Rs.<?php echo $row["price"]; ?></td>
            <td><img src="uploads/<?php echo $row["image"]; ?>" width="100"></td>
            <td>
                <a href="edit_product.php?id=<?php echo $row["id"]; ?>">Edit</a> | 
                <a href="delete_product.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>