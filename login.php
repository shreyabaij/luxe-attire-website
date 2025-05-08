<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="register.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h2>Login</h2>
        <form action="login.php" method="post"> 
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="submit" class="btn">Login</button>
        </form>

        <?php
        if (isset($_POST["submit"])) {
            $username = trim($_POST['username']);
            $password = $_POST['password'];

            if (empty($username) || empty($password)) {
                echo "<div class='error'>Please fill in all fields</div>";
            } else {
                $con = new mysqli('localhost', 'root', '', 'luxe_attiredb');

                if ($con->connect_error) {
                    die("<div class='error'>Connection failed: " . $con->connect_error . "</div>");
                }

                $query = "SELECT id, password FROM users WHERE username = ?";
                $stmt = $con->prepare($query);
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $stmt->store_result();
                
                if ($stmt->num_rows > 0) {
                    $stmt->bind_result($id, $hashedPassword);
                    $stmt->fetch();
                    
                    if (password_verify($password, $hashedPassword)) {
                        echo "<div class='success'>Login successful! Redirecting...</div>";
                        session_start();
                        $_SESSION['user_id'] = $id;
                        $_SESSION['username'] = $username;
                        header("Refresh:2; url=home.php");
                        exit();
                    } else {
                        echo "<div class='error'>Invalid username or password</div>";
                    }
                } else {
                    echo "<div class='error'>Invalid username or password</div>";
                }
                
                $stmt->close();
                $con->close();
            }
        }
        ?>

        <p class="register-link">Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</body>

</html>
