<?php
$conn = new mysqli("localhost", "root", "", "luxe_attiredb");

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $on_sale = isset($_POST['on_sale']) ? 1 : 0; 

    $target = "images/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    //  Correct SQL Query with Correct Field Names
    $stmt = $conn->prepare("INSERT INTO products (name, price, image, on_sale) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdsi", $name, $price, $image, $on_sale);
    
    if ($stmt->execute()) {
        echo " Product added successfully!";
    } else {
        echo " Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel = "stylesheet" href = "add_product.css">
</head>

<body>
    <h2>Add Product</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Product Name" required>
        <input type="number" step="0.01" name="price" placeholder="Price" required>
        <input type="file" name="image" required>
        <label>
            <input type="checkbox" name="on_sale"> Add to Sales
        </label>
        <button type="submit">Add Product</button>
    </form>
    <a href="home.php">Return to Homepage</a>
</body>
</html>
