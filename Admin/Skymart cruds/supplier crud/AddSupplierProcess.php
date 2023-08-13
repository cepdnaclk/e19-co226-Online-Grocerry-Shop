<?php

// Database Connection
$conn = new mysqli('localhost', 'root', '', 'project');
if ($conn->connect_error) {
    die('Connection Failed : ' . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $supplier_id = $_POST['supplier_id'];
    $supplier_name = $_POST['supplier_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $due_payment = $_POST['due_payment'];

    // Handle image upload
    if (isset($_FILES['supplier_image']['tmp_name']) && is_uploaded_file($_FILES['supplier_image']['tmp_name'])) {
        $supplier_image = file_get_contents($_FILES['supplier_image']['tmp_name']);
        if ($supplier_image === false) {
            die("Error: Unable to read image file.");
        }
    } else {
        die("Error: Image not uploaded.");
    }

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO supplier (Id, SupplierName, Email, PhoneNo, DuePayment, SupplierImage) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("dsssds",$supplier_id, $supplier_name, $email, $phone_number, $due_payment, $supplier_image);

    if ($stmt->execute()) {
        header("Location: SupplierIndex.php?msg=New supplier added successfully");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
