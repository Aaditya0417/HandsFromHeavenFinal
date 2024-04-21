<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Tables</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<?php
$host = 'localhost';
$user = 'postgres';
$password = 'Aaditya@1399';
$dbname = 'NGO_Fund_Management';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Fetch tables and display their contents
    $tables = ['company', 'NGO', 'project', 'fundallocation', 'company_Causes', 'ngo_causes', 'project_causes', 'donates_to_CN', 'donates_to_CP', 'collabs_on', 'admins'];

    foreach ($tables as $table) {
        echo "<h2>$table Table</h2>";
        echo "<table>";
        $stmt = $pdo->query("SELECT * FROM $table");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<tr>";
        foreach ($rows[0] as $key => $value) {
            echo "<th>$key</th>";
        }
        echo "</tr>";

        foreach ($rows as $row) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>$value</td>";
            }
            echo "</tr>";
        }
        echo "</table><br>";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
</body>
</html>
