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
    $type = $_POST['type'];
    $identifier = $_POST['identifier']; // Use email or NGO/Company name as identifier
    $password = $_POST['password'];

    // Validate the type
    if ($type == "NGO" || $type == "Company") {
        // Construct the appropriate query based on the type and identifier
        $query = "SELECT * FROM $type WHERE email = $1"; // Assuming email is used for authentication
        $result = pg_query_params($conn, $query, array($identifier));
        
        if ($result && pg_num_rows($result) > 0) {
            $user = pg_fetch_assoc($result);
            $hashed_password = $user['password'];
            
            if (password_verify($password, $hashed_password)) {
                $_SESSION['type'] = $type;
                $_SESSION['user_id'] = $user['ngoid']; // Assuming 'ngoid' is the primary key in the database
                header("Location: index.php");
                exit();
            } else {
                $error = "Incorrect password.";
            }
        } else {
            $error = "User not found.";
        }
    } else {
        $error = "Invalid user type.";
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
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        
        .container {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        
        h2 {
            margin-bottom: 20px;
        }
        
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        
        input[type="text"],
        input[type="password"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        
        button[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        
        button[type="submit"]:hover {
            background-color: #45a049;
        }
        
        .error {
            color: red;
            margin-bottom: 10px;
        }
        
        .register-link {
            margin-top: 20px;
        }
        
        .register-link a {
            color: blue;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="type">Login as:</label>
            <select id="type" name="type" required>
                <option value="NGO">NGO</option>
                <option value="Company">Company</option>
            </select><br><br>
            <label for="identifier">Identifier:</label>
            <input type="text" id="identifier" name="identifier" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <button type="submit" name="login">Login</button>
        </form>
        <div class="register-link">Don't have an account? <a href="register.php">Register here</a>.</div>
    </div>
</body>
</html>
