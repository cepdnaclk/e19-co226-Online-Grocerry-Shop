<?php
session_start();
$userId = $_SESSION['UserId'];

// Initialize variables
$currentPassword = '';
$newPassword = '';
$confirmPassword = '';
$error = '';
$successMessage = '';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Replace with your database connection code
    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'project';

    $connection = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }



    // Retrieve current hashed password from the database
    $query = "SELECT password FROM user WHERE  UserId = '$userId'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $hashedPassword = $row['password'];

    // Verify if the current password matches the stored hashed password
    if ($currentPassword ===  $hashedPassword) {
        // Check if new password matches confirm password
        if ($newPassword !== $confirmPassword) {
            $error = 'New password and confirm password do not match.';
        } else {

            // Update the password in the database
            $updateQuery = "UPDATE user SET password = $newPassword WHERE UserId = '$userId'";
            if (mysqli_query($connection, $updateQuery)) {
                $_SESSION['alert_message'] = "User details and address updated successfully";
                header("Location: http://localhost/e19-co226-Online-Grocery-Shop/Homepage/Profile.php?show_alert=1");
            } else {
                echo'Error updating password: ' . mysqli_error($connection);
            }
        }
    } else {
        echo 'Current password is incorrect.';
        echo $hashedPassword;
        echo $currentPassword;
        echo (password_verify($currentPassword, $hashedPassword));
    }

    // Close the database connection
    mysqli_close($connection);
}
?>
