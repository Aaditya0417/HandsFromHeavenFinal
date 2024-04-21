<?php
session_start(); // Start the session to manage user login state

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check login credentials (You need to implement this logic)
    // For demonstration purposes, let's assume the login is successful if the type, identifier, and password match
    $type = $_POST["type"];
    $identifier = $_POST["identifier"];
    $password = $_POST["password"];

    // Check if the type is NGO
    if ($type === "NGO") {
        // Check NGO login credentials
        // For simplicity, assuming the identifier and password are valid for NGOs
        if ($identifier === "ngoname" && $password === "password") {
            $_SESSION['loggedin'] = true; // Set session variable to indicate user is logged in
            $_SESSION['type'] = $type; // Set type in session
            $_SESSION['identifier'] = $identifier; // Set identifier in session
            header("Location: index.php"); // Redirect to redirectafterlogin.php after successful login
            exit; // Terminate script after redirection
        } else {
            $error = "Invalid credentials. Please try again."; // Set error message
        }
    } elseif ($type === "Company") {
        // Check Company login credentials
        // For simplicity, assuming the identifier and password are valid for Companies
        if ($identifier === "companyname" && $password === "password") {
            $_SESSION['loggedin'] = true; // Set session variable to indicate user is logged in
            $_SESSION['type'] = $type; // Set type in session
            $_SESSION['identifier'] = $identifier; // Set identifier in session
            header("Location: index.php"); // Redirect to redirectafterlogin.php after successful login
            exit; // Terminate script after redirection
        } else {
            $error = "Invalid credentials. Please try again."; // Set error message
        }
    } else {
        $error = "Invalid login type. Please select a valid option."; // Set error message
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
        
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php 
        // Define the $error variable to avoid PHP errors
        $error = ""; 
        if(isset($error)) echo "<div class='error'>$error</div>"; 
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="type">Login as:</label>
            <select id="type" name="type" onchange="showFields(this.value)" required>
                <option value="">Select...</option>
                <option value="NGO">NGO</option>
                <option value="Company">Company</option>
            </select><br><br>
            <div id="emailField" class="hidden">
                <label for="identifier">Email:</label>
                <input type="text" id="identifier" name="identifier">
            </div>
            <div id="ngoNameField" class="hidden">
                <label for="ngoname">NGO Name:</label>
                <input type="text" id="ngoname" name="ngoname">
            </div>
            <div id="companyNameField" class="hidden">
                <label for="companyname">Company Name:</label>
                <input type="text" id="companyname" name="companyname">
            </div>
            <div id="passwordField" class="hidden">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="login">Login</button>
        </form>
        <div class="register-link">Don't have an account? <a href="register.php">Register here</a>.</div>
    </div>

    <script>
        function showFields(selectedType) {
            var emailField = document.getElementById('emailField');
            var ngoNameField = document.getElementById('ngoNameField');
            var companyNameField = document.getElementById('companyNameField');
            var passwordField = document.getElementById('passwordField');
            var loginButton = document.querySelector('button[type="submit"]');

            if (selectedType === 'NGO') {
                emailField.classList.remove('hidden');
                ngoNameField.classList.remove('hidden');
                companyNameField.classList.add('hidden');
                passwordField.classList.remove('hidden');
                loginButton.classList.remove('hidden');
                emailField.querySelector('input').setAttribute('name', 'identifier');
                ngoNameField.querySelector('input').setAttribute('name', 'ngoname');
            } else if (selectedType === 'Company') {
                emailField.classList.remove('hidden');
                companyNameField.classList.remove('hidden');
                ngoNameField.classList.add('hidden');
                passwordField.classList.remove('hidden');
                loginButton.classList.remove('hidden');
                emailField.querySelector('input').setAttribute('name', 'identifier');
                companyNameField.querySelector('input').setAttribute('name', 'companyname');
            } else {
                emailField.classList.add('hidden');
                ngoNameField.classList.add('hidden');
                companyNameField.classList.add('hidden');
                passwordField.classList.add('hidden');
                loginButton.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
