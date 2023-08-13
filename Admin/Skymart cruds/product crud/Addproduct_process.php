<?php

// Database Connection
$conn = new mysqli('localhost', 'root', '', 'project');
if ($conn->connect_error) {
    die('Connection Failed : ' . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $buying_price = $_POST['buying_price'];
    $selling_price = $_POST['selling_price'];
    $product_description = $_POST['product_description'];

    // Handle image upload
    if (isset($_FILES['product_image']['tmp_name']) && is_uploaded_file($_FILES['product_image']['tmp_name'])) {
        $product_image = file_get_contents($_FILES['product_image']['tmp_name']);
        if ($product_image === false) {
            die("Error: Unable to read image file.");
        }
    } else {
        die("Error: Image not uploaded.");
    }

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO product (ProductName, Category, SellingPrice, BuyingPrice, Description, Image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssddss", $product_name, $product_category, $selling_price, $buying_price, $product_description, $product_image);

    if ($stmt->execute()) {
        header("Location: product_index.php?msg=New product added successfully");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
