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

    // Update the state to 3 for the specified id
    $sql = "UPDATE outpass SET state = 'accepted' WHERE id = $id";
    if ($connection->query($sql) === TRUE) {
        echo "Request accepted successfully!";
    } else {
        echo "Error updating record: " . $connection->error;
    }
} else {
    echo "Invalid request: No valid ID provided.";
}

$connection->close();
exit;
?>
