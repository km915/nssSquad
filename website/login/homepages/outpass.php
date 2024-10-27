<?php
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Ensure code runs only on POST request
    // Retrieve form data
    $name = $_POST["name"];
    $rollnumber = $_POST["roll_number"];
    $reason = $_POST["reason"];
    $numofdays = $_POST["numofdays"];
    
    // Prepare SQL statement
    $sql1 = "INSERT INTO outpass(name, rollno, reason, days, state) VALUES ('$name', '$rollnumber', '$reason', '$numofdays', 'requested')";
    
    // Execute the SQL query
    if (mysqli_query($conn, $sql1)) {
        echo "Thanks for your response";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Outpass Application</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/329da96191.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h1 id="title">Outpass Application</h1>
            <form action="outpass.php" method="post"> <!-- Submit to the same page -->
                <div class="input-group">
                    <div class="input-field" id="nameField">                   
                        <input type="text" name="name" placeholder="Name" required>
                    </div>

                    <div class="input-field">
                        <input type="text" name="roll_number" placeholder="Roll Number" required>
                    </div>

                    <div class="input-field">
                        <input type="text" name="reason" placeholder="Reason" required>
                    </div>

                    <div class="input-field">
                        <input type="number" name="numofdays" placeholder="Number of days" required>
                    </div>
                </div>
                <div class="btn-field">
                    <button type="submit" id="submit">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
