<?php
$email = $_POST['email'];

// Database connection
$servername = "localhost";
$username = "u335992634_sanchan";
$password = "@Sanchan77";
$dbname = "u335992634_shreefurniture";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if email already exists
$checkSql = "SELECT id FROM email_subscriptions WHERE email = '$email'";
$result = $conn->query($checkSql);

if ($result->num_rows > 0) {
    echo "You have already subscribed!";
} else {
    // Insert email into database
    $insertSql = "INSERT INTO email_subscriptions (email) VALUES ('$email')";

    if ($conn->query($insertSql) === TRUE) {
        echo "Subscribed successfully";
    } else {
        echo "Error: " . $insertSql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
