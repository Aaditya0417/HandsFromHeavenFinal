<?php

$host = 'localhost';
$dbname = 'NGO_Fund_Management';
$username = 'postgres';
$password = 'aaditya';

try {
    $db = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    // Set PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  
    echo "Connection failed: " . $e->getMessage();
    exit(); // Stop script execution
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['registerNGO'])) {
        // Register as NGO
        $ngoname = htmlspecialchars($_POST['ngoname']);
        $phone = htmlspecialchars($_POST['phone']);
        $email = htmlspecialchars($_POST['email']);
        $missionstatement = htmlspecialchars($_POST['missionstatement']);
        $fundingneeds = htmlspecialchars($_POST['fundingneeds']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

        // Prepare and execute the SQL statement
        $sql = "INSERT INTO ngo (ngoname, phone, email, missionstatement, fundingneeds, password, verified) 
                VALUES (:ngoname, :phone, :email, :missionstatement, :fundingneeds, :password, false)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':ngoname', $ngoname);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':missionstatement', $missionstatement);
        $stmt->bindParam(':fundingneeds', $fundingneeds);
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
            // Redirect to login page after successful registration
            header("Location: login.php");
            exit();
        } else {
            echo "Error: Unable to register NGO.";        }
    } elseif (isset($_POST['registerCompany'])) {
        // Register as Company
        $companyname = htmlspecialchars($_POST['companyname']);
        $companyPhone = htmlspecialchars($_POST['companyPhone']);
        $companyEmail = htmlspecialchars($_POST['companyEmail']);
        $fundavailable = htmlspecialchars($_POST['fundavailable']);
        $companyPassword = password_hash($_POST['companyPassword'], PASSWORD_DEFAULT); // Hash the password

        // Prepare and execute the SQL statement
        $sql = "INSERT INTO company (companyname, phone, email, fundavailable, password, verified) 
                VALUES (:companyname, :phone, :email, :fundavailable, :password, false)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':companyname', $companyname);
        $stmt->bindParam(':phone', $companyPhone);
        $stmt->bindParam(':email', $companyEmail);
        $stmt->bindParam(':fundavailable', $fundavailable);
        $stmt->bindParam(':password', $companyPassword);

        if ($stmt->execute()) {
            // Redirect to login page after successful registration
            header("Location: login.php");
            exit();
        } else {
            echo "Error: Unable to register Company.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
        /* CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-top: 0;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        textarea,
        input[type="password"] {
            width: calc(100% - 10px);
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .btn-group {
            text-align: center;
            margin-bottom: 20px;
        }
        .btn {
            margin: 0 10px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>User Registration</h2>
    <div class="btn-group">
        <button class="btn" onclick="showNGOForm()">Register as NGO</button>
        <button class="btn" onclick="showCompanyForm()">Register as Company</button>
    </div>

    <form id="ngoForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="display: none;">
        <!-- NGO registration fields -->
        <label for="ngoname">NGO Name:</label>
        <input type="text" id="ngoname" name="ngoname" required>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="missionstatement">Mission Statement:</label>
        <textarea id="missionstatement" name="missionstatement" rows="4" cols="50" required></textarea>

        <label for="fundingneeds">Funding Needs:</label>
        <input type="text" id="fundingneeds" name="fundingneeds" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" name="registerNGO" value="Register">
    </form>

    <form id="companyForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="display: none;">
        <!-- Company registration fields -->
        <label for="companyname">Company Name:</label>
        <input type="text" id="companyname" name="companyname" required>

        <label for="companyPhone">Phone:</label>
        <input type="text" id="companyPhone" name="companyPhone" required>

        <label for="companyEmail">Email:</label>
        <input type="email" id="companyEmail" name="companyEmail" required>

        <label for="fundavailable">Fund Available:</label>
        <input type="text" id="fundavailable" name="fundavailable" required>

        <label for="companyPassword">Password:</label>
        <input type="password" id="companyPassword" name="companyPassword" required>

        <input type="submit" name="registerCompany" value="Register">
    </form>
</div>

<script>
    // Function to display NGO registration form
    function showNGOForm() {
        document.getElementById('ngoForm').style.display = 'block';
        document.getElementById('companyForm').style.display = 'none';
    }

    // Function to display Company registration form
    function showCompanyForm() {
        document.getElementById('ngoForm').style.display = 'none';
        document.getElementById('companyForm').style.display = 'block';
    }
</script>
</body>
</html>
