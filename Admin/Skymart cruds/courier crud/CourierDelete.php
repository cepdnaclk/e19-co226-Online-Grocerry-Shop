<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";

$id = $_GET["id"];
$sql = "DELETE FROM `courier` WHERE id = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: CourierIndex.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($conn);
}