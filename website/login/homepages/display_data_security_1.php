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
           $servername = "localhost";
           $username = "root";
           $password = "";
           $database = "users";
           
           $connection = new mysqli($servername, $username, $password, $database);
           if ($connection->connect_error) {
               die("Connection failed: " . $connection->connect_error);
           }
           
           $sql = "SELECT * FROM outpass WHERE state = 'accepted'"; 
           $result = $connection->query($sql);

           if (!$result) {
               die("Invalid query: " . $connection->error);
           }

           if ($result->num_rows === 0) {
               echo "<tr><td colspan='6'>No records found.</td></tr>"; // Display a message if no records found
           } else {
               while ($row = $result->fetch_assoc()) {
                   echo "<tr>
                           <td>" . htmlspecialchars($row["name"]) . "</td>
                           <td>" . htmlspecialchars($row["rollno"]) . "</td>
                           <td>" . htmlspecialchars($row["reason"]) . "</td>
                           <td>" . htmlspecialchars($row["days"]) . "</td>
                           <td>" . htmlspecialchars($row["state"]) . "</td>
                           <td>
                               <a href='display_data_security_1.php?id=" . urlencode($row["id"]) . "&action=out' class='btn btn-success btn-sm'>OUT</a>
                           </td>
                       </tr>";
               }
           }

           $connection->close();
           ?>
       </tbody>
   </table>
</body>
</html>

<?php
// Include database connection
include("database.php");

$id = $_GET['id'] ?? null; // Use null if not set
$action = $_GET['action'] ?? null; // Use null if not set

if ($action === 'out' && $id !== null) { // Check if action is 'out' and id is set
    // Use prepared statements for security
    $stmt = $conn->prepare("UPDATE outpass SET state = 'out' WHERE id = ?");
    $stmt->bind_param("i", $id); // Assuming id is an integer
    if ($stmt->execute()) {
        echo "State updated to 'out' successfully.";
    } else {
        echo "Error updating state: " . $stmt->error;
    }
    $stmt->close();
}
?>
