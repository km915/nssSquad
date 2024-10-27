<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "users";
$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if the id is set and is a valid integer
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']); // Convert to integer for safety

    // Update the state to 1 for the specified id
    $sql = "DELETE FROM outpass WHERE id = $id";
    if ($connection->query($sql) === TRUE) {
        echo "Request rejected successfully!";
    } else {
        echo "Error updating record: " . $connection->error;
    }
} else {
    echo "Invalid request: No valid ID provided.";
}

$connection->close();
exit;
?>
