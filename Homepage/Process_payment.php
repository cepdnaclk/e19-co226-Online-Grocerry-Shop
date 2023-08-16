<?php
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

    // Data variables
    $user_id = $_POST['userId'];
    $total_amount = $_POST['totalAmount'];
    $order_date = $_POST['orderDate'];
    $delivery_date = $_POST['deliveryDate'];
    $payment_method ='card';

    // Prepare and execute SQL query
    $stmt = $conn->prepare("INSERT INTO ordertable (UserId, Amount, OrderDate, DeliveryDate,PaymentMethod) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $user_id, $total_amount, $order_date, $delivery_date,$payment_method);

    $response = array();

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = "Payment processed and data inserted successfully!";
        
        $redirectUrl = 'project.php?reload=true'; 
        header("Location: $redirectUrl");
        echo "<script>alert('Payment successful')</script>";
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
    echo "alert('Method Not Allowed')";
}
?>