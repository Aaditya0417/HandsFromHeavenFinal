<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        input[type="email"],
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

        .btn-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .btn {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
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
    $type = "NGO";
    $error = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
        $type = $_POST['type'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
        
        if ($type == "NGO") {
        
        } else if ($type == "Company") {
            $company_name = isset($_POST['company_name']) ? $_POST['company_name'] : null;
            $phone_no = isset($_POST['phone_no_company']) ? $_POST['phone_no_company'] : null;
            $email_id = isset($_POST['email_id_company']) ? $_POST['email_id_company'] : null;
            $funds_available = isset($_POST['funds_available']) ? $_POST['funds_available'] : null;
            
         
            $query = "INSERT INTO company (password, companyname, phone, email, fundavailable) VALUES ($1, $2, $3, $4, $5)";
            $params = array($password, $company_name, $phone_no, $email_id, $funds_available);

          
            echo "Query: $query <br>";
            echo "Params: ";
            var_dump($params);
            
            
            $result = pg_query_params($conn, $query, $params);
            
            if ($result) {
                $_SESSION['registration_success'] = true;
                header("Location: index.php"); 
                exit();
            } else {
                $error = "Registration failed: " . pg_last_error($conn);
            }
        } else {
            $error = "Invalid user type.";
        }
    }
?>


        <div class="btn-group">
            <button class="btn" onclick="toggleRegisterType('NGO')">Register as NGO</button>
            <button class="btn" onclick="toggleRegisterType('Company')">Register as Company</button>
        </div>
        <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="registrationForm">
            <input type="hidden" name="type" id="registerType" value="NGO"> <!-- Hidden field to store registration type -->
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <div id="ngoFields">
                <label for="ngo_name">NGO Name:</label>
                <input type="text" id="ngo_name" name="ngo_name" required><br><br>
                <label for="phone_no">Phone No:</label>
                <input type="text" id="phone_no" name="phone_no" required><br><br>
                <label for="email_id">Email ID:</label>
                <input type="email" id="email_id" name="email_id" required><br><br>
                <label for="mission_statement">Mission Statement:</label>
                <input type="text" id="mission_statement" name="mission_statement" required><br><br>
                <label for="funding_needs">Funding Needs:</label>
                <input type="text" id="funding_needs" name="funding_needs" required><br><br>
            </div>
            <div id="companyFields" style="display: none;">
                <label for="company_name">Company Name:</label>
                <input type="text" id="company_name" name="company_name" required><br><br>
                <label for="phone_no_company">Phone No:</label>
                <input type="text" id="phone_no_company" name="phone_no_company" required><br><br>
                <label for="email_id_company">Email ID:</label>
                <input type="email" id="email_id_company" name="email_id_company" required><br><br>
                <label for="funds_available">Funds Available:</label>
                <input type="text" id="funds_available" name="funds_available" required><br><br>
            </div>
            <button type="submit" name="register">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Log in</a></p>
    </div>

    <script>
        function toggleRegisterType(type) {
            document.getElementById('registerType').value = type;
            if (type === 'NGO') {
                document.getElementById('ngoFields').style.display = 'block';
                document.getElementById('companyFields').style.display = 'none';
            } else if (type === 'Company') {
                document.getElementById('ngoFields').style.display = 'none';
                document.getElementById('companyFields').style.display = 'block';
            }
        }
    </script>
</body>
</html>