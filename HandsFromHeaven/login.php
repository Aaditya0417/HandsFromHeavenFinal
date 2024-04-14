<?php
session_start();

$dbhost = "localhost";
$dbname = "NGO_Fund_Management";
$dbuser = "postgres";
$dbpass = "Aaditya@1399";

$conn = pg_connect("host=$dbhost dbname=$dbname user=$dbuser password=$dbpass");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = $1";
    $result = pg_query_params($conn, $query, array($username));
    
    if ($result && pg_num_rows($result) > 0) {
        $user = pg_fetch_assoc($result);
        $hashed_password = $user['password'];
        
        if (password_verify($password, $hashed_password)) {
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container {
            width: 400px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error {
            color: #ff0000;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <button type="submit" name="login">Login</button>
        </form>
        <p style="text-align: center; margin-top: 10px;">Don't have an account? <a href="register.php">Register now</a>.</p>
    </div>
</body>
</html>
