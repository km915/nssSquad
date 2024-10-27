<?php
// Enable error reporting for debugging (remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$database = "users";

// Establish a new database connection
$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Start HTML structure
echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Check Status</title>
</head>
<body>";

// Check if 'name' is provided in the URL and is a valid string
if (isset($_GET['name']) && !empty($_GET['name']) && is_string($_GET['name'])) {
    $name = $connection->real_escape_string($_GET['name']);
    
    // SQL query to select the state for the specified name
    $sql = "SELECT state FROM outpass WHERE name = '$name'";
    $result = $connection->query($sql);

    // Check if the query was successful and if there is a result
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<p>Current state for " . htmlspecialchars($name) . ": " . htmlspecialchars($row["state"]) . "</p>";
    } else {
        echo "<p>No record found with the specified name.</p>";
    }
} else {
    echo "<p>Invalid request: No valid name provided in the URL.</p>";
}

// End HTML structure
echo "</body>
</html>";

// Close the database connection
$connection->close();
exit;
?>
