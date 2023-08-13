<?php

// Database Connection
$conn = new mysqli('localhost', 'root', '', 'project');
if ($conn->connect_error) {
    die('Connection Failed : ' . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $courier_name = $_POST['courier_name'];
    $salary = $_POST['salary'];
    $start_date = $_POST['start_date'];
    $phone_number = $_POST['phone_number'];
    $area_covered = $_POST['area_covered'];

    // Handle image upload
    if (isset($_FILES['courier_image']['tmp_name']) && is_uploaded_file($_FILES['courier_image']['tmp_name'])) {
        $courier_image = file_get_contents($_FILES['courier_image']['tmp_name']);
        if ($courier_image === false) {
            die("Error: Unable to read image file.");
        }
    } else {
        die("Error: Image not uploaded.");
    }

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO courier (CourierName, Salary, StartDate, PhoneNumber, AreaCovered, CourierImage) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $courier_name, $salary, $start_date, $phone_number, $area_covered, $courier_image);

    if ($stmt->execute()) {
        header("Location: CourierIndex.php?msg=New courier added successfully");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
