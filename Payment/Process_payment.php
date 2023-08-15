<?php
if ($_SERVER["REQUEST_METHOD"] === "PUT") {
    // Receive JSON data from the request body
    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Data variables
    $customer_id = $data['customerId'];
    $total_amount = $data['totalAmount'];
    $order_date = $data['orderDate'];
    $delivery_date = $data['deliveryDate'];

    // Prepare and execute SQL query
    $stmt = $conn->prepare("INSERT INTO ordertable (CustomerId, Amount, OrderDate, DeliveryDate) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $customer_id, $total_amount, $order_date, $delivery_date);

    $response = array();

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = "Payment processed and data inserted successfully!";
    } else {
        $response['success'] = false;
        $response['message'] = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    header("Allow: POST");
    echo "Method Not Allowed";
}
?>
