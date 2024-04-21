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
$password = 'aaditya';
$dbname = 'NGO_Fund_Management';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Fetch tables and display their contents
    $tables = ['company', 'ngo', 'project', 'fundallocation', 'ngo_causes', 'project_causes', 'collabs_on', 'company_causes','donates_to_cn','donates_to_cp'];

    foreach ($tables as $table) {
        echo "<h2>$table Table</h2>";
        echo "<table>";
        try {
            $stmt = $pdo->query("SELECT * FROM \"$table\"");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($rows) {
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
            } else {
                echo "<tr><td colspan='100'>No data found.</td></tr>";
            }
        } catch (PDOException $e) {
            if (strpos($e->getMessage(), 'relation "'.$table.'" does not exist') !== false) {
                echo "<tr><td colspan='100'>Table \"$table\" does not exist.</td></tr>";
            } else {
                echo "<tr><td colspan='100'>Error: " . $e->getMessage() . "</td></tr>";
            }
        }
        echo "</table><br>";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
</body>
</html>
