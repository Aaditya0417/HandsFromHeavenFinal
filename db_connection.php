
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

$host = 'localhost';        
$user = 'postgres';     
$password = 'Aaditya@1399';
$dbname = 'NGO_Fund_Management'; 

try {

    $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $tables = ['Company', 'NGO', 'Project', 'FundAllocation', 'Company_Causes', 'NGO_Causes', 'Project_Causes', 'donates_to_CN', 'donates_to_CP', 'collabs_on'];

    foreach ($tables as $table) {
        echo "<h2>$table Table</h2>";
        echo "<table border='1'>";

        $stmt = $db->query("SELECT * FROM $table");
     
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
