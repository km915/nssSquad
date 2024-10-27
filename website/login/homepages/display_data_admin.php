<?php
// Assuming each row in `outpass` has a unique identifier, like `id`
$servername = "localhost";
$username = "root";
$password = "";
$database = "users";
$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$sql = "SELECT * FROM outpass WHERE state = 'requested' ";
$result = $connection->query($sql);

if (!$result) {
    die("Invalid query: " . $connection->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style="margin: 50px">
    <h1>Leave Requests</h1>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Roll No</th>
                <th>Reason</th>
                <th>Days</th>
                <th>State</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row["name"] . "</td>
                    <td>" . $row["rollno"] . "</td>
                    <td>" . $row["reason"] . "</td>
                    <td>" . $row["days"] . "</td>
                    <td>" . $row["state"] . "</td> 
                    <td>
                        <a href='accept.php?id=" . $row["id"] . "' class='btn btn-success'>Accept</a>
                        <a href='reject.php?id=" . $row["id"] . "' class='btn btn-danger'>Reject</a>
                    </td> 
                </tr>";
            }
            $connection->close();
            ?>
        
        </tbody>
    </table>
</body>
</html>