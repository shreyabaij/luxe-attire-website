<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link href="register.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h2>Register</h2>
        <form action="register.php" method="post"> <!-- Ensure the action points to the correct PHP file -->
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required> <!-- Fixed the id here -->
            </div>
            <button type="submit" name="submit" class="btn">Register</button> <!-- Added name attribute -->
        </form>

        <?php
        if (isset($_POST["submit"])) {
            // Input sanitization
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            // Input validation
            if (empty($username) || empty($email) || empty($password)) {
                echo "Please fill in all fields";
            } else {
                // Database connection
                $con = mysqli_connect('localhost', 'root', '', 'luxe_attiredb'); // Fixed the connection function and removed extra space
                if ($con) {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
                    $stmt = $con->prepare($query);
                    $stmt->bind_param("sss", $username, $email, $hashedPassword); // Use prepared statements to prevent SQL injection
                    $result = $stmt->execute();

                    if ($result) {
                        echo "Registration successful";
                        header("Refresh:2; url=login.php");

                    } else {
                        echo "Registration failed: " . $stmt->error; // Show error if registration fails
                    }

                    $stmt->close();
                    $con->close();
                } else {
                    echo "Connection failed: " . mysqli_connect_error(); // Show connection error
                }
            }
        }
        ?>
    </div>
</body>

</html>