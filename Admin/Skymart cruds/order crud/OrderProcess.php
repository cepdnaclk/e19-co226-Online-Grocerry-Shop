<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
} else {
    // Handle missing ID parameter here
    $id = 0; // Default value or any other appropriate action
}

$Process_Status = "processed";

$sql = "UPDATE `ordertable` SET `ProcessStatus` = ? WHERE Id = ?";
   
// Use prepared statement for the query
$stmt = mysqli_prepare($conn, $sql);

// Bind parameters to the prepared statement
mysqli_stmt_bind_param($stmt, "si", $Process_Status, $id);

$result = mysqli_stmt_execute($stmt);

if ($result) {
    echo "ProcessStatus updated successfully";
    header("Location: OrderIndex.php?msg=Order process updated successfully");
} else {
    echo "Failed: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
mysqli_close($conn); // Close the database connection
?>
