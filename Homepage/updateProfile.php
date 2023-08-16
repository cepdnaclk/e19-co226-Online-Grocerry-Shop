<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $userId = $_SESSION['UserId'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phoneNo = $_POST['phoneNo'];
    $email = $_POST['email'];
    $district = $_POST['District'];
    $city = $_POST['city'];
    $street = $_POST['street'];
    $houseNo = $_POST['houseNo'];

    // Construct the SQL queries
    $updateProfileQuery = "UPDATE user SET FName = '$fname', LName = '$lname', PhoneNo = '$phoneNo', Email = '$email',Dirstrict = '$district', City = '$city', Street = '$street', HouseNo = '$houseNo' WHERE UserId = $userId";

    $success = true;

    if ($conn->query($updateProfileQuery) !== TRUE) {
        $success = false;
        echo "Error updating user profile: " . $conn->error;
    }


    if ($success) {
        header("Location: Project.php");
        echo '<script>alert("User details and address updated successfully.");</script>';
    }

    $conn->close();
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    header("Allow: POST");
    echo "Method Not Allowed";
}
?>
