<?php
// Validate and sanitize user input
if (isset($_POST['email'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Database connection
  $servername = "localhost";
$database = "u335992634_shreefurniture";
$username = "u335992634_sanchan";
$password = "@Sanchan77";
 
// Create connection
 
$conn = mysqli_connect($servername, $username, $password, $database);

   
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepared statement
    $checkSql = "SELECT id FROM email_subscriptions WHERE email = ?";
    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param("s", $email);

    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if email already exists
    if ($result->num_rows > 0) {
        echo "You have already subscribed!";
    } else {
        // Escape the email address
        $email = mysqli_real_escape_string($conn, $email);

        // Insert email into database
        $insertSql = "INSERT INTO email_subscriptions (email) VALUES (?)";
        $stmt = $conn->prepare($insertSql);
        $stmt->bind_param("s", $email);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Subscribed successfully";
        } else {
            echo "Error: Subscription failed";
        }
    }

    // Close the statement
    $stmt->close();

    // Close the connection
    $conn->close();
} else {
    echo "Error: Invalid input";
}
?>
