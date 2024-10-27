<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        /* Optional: Add some styling for the button */
        .redirect-button {
            background-color: #4CAF50; /* Green */
            color: white;
            padding: 15px 32px;/*height*/
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
        }
    </style>
    <link ref = "stylesheet" href ="style.css">
</head>
<body style="background-color:rgba(84, 182, 220, 0.813)">

    <h1 >User Dashboard</h1>
    <a href="outpass.php">
        <button class="redirect-button">Outpass Application</button>
    </a>
    <br>
    <br>
    <a href="user_status.php">
        <button class="redirect-button">Check User Status</button>
    </a>

</body>
</html>
