<?php
session_start();
include("config.php");

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}

$id = $_GET["id"];
$result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
$product = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $price = $_POST["price"];

    $sql = "UPDATE products SET name='$name', price='$price' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        header("Location: dashboard.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <h2>Edit Product</h2>
    <form method="POST">
        <input type="text" name="name" value="<?php echo $product['name']; ?>" required>
        <input type="text" name="price" value="<?php echo $product['price']; ?>" required>
        <button type="submit">Update Product</button>
    </form>
</body>
</html>
