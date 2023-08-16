<?php
session_start();

$alertMessage = isset($_SESSION['alert_message']) ? $_SESSION['alert_message'] : "";
unset($_SESSION['alert_message']); // Clear the session variable

$showAlert = isset($_GET['show_alert']) && $_GET['show_alert'] == 1;



$userId = $_SESSION['UserId'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}
$query = "SELECT * FROM user WHERE UserId = $userId";
$query_run = mysqli_query($conn, $query);
$check_query = mysqli_num_rows($query_run);
$row = mysqli_fetch_assoc($query_run)
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a href="Project.php">
                <img src="images/logo.png" alt="logo" height="60">
            </a>

            <a href="http://localhost/CO226/e19-co226-Online-Grocerry-Shop/LogIn/login.php" class="ml-auto">Log Out</a>
        </div>
    </nav>

    <div class="container mt-4" style="background-color :aliceblue">
        <div class="row">
            <div class="col-md-6">
                <h2 class="mb-3">Update Profile</h2>
                <form id="updateProfile" action="updateProfile.php" method="post" class="mb-4">
                    <div class="form-group">
                        <label for="fname">First Name:</label>
                        <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $row['FName'];  ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name:</label>
                        <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $row['LName'];  ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phoneNo">Phone No:</label>
                        <input type="text" class="form-control" id="phoneNo" name="phoneNo" value="<?php echo $row['PhoneNo'];  ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">E-Mail:</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $row['Email'];  ?>" required>
                    </div>
            </div>

            <div class="col-md-6">
                <h2 class="mb-3">Update Address</h2>
                <div class="form-group">
                    <label for="District">District:</label>
                    <input type="text" class="form-control" id="District" name="District" value="<?php echo $row['Dirstrict'];  ?>" required>
                </div>
                <!-- ... Other form fields ... -->
                <div class="form-group">
                    <label for="city">City:</label>
                    <input type="text" class="form-control" id="city" name="city" value="<?php echo $row['City'];  ?>" required>
                </div>
                <div class="form-group">
                    <label for="street">Street:</label>
                    <input type="text" class="form-control" id="street" name="street" value="<?php echo $row['Street'];  ?>" required>
                </div>
                <div class="form-group">
                    <label for="houseNo">House No:</label>
                    <input type="text" class="form-control" id="houseNo" name="houseNo" value="<?php echo $row['HouseNo'];  ?>" required>
                </div>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-danger">Update Profile</button>
                <button type="reset" class="btn btn-light">Cancel</button>
                </form>
            </div>


            <div class="col-md-6">
                <form id="changePasswordForm" action="updatePassword.php" method="post">
                    <h2 class="mb-3">Change Password</h2>
                    <div class="form-group">
                        <label for="currentPassword">Current Password:</label>
                        <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                    </div>
                    <!-- ... Other form fields ... -->
                    <div class="form-group">
                        <label for="newPassword">New Password:</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm New Password:</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                    </div>
                    <button type="submit" class="btn btn-danger">Change Password</button>
                    <button type="reset" class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="script.js"></script>
</body>

</html>