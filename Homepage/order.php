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
    $customer_id = $_POST['customerId'];
    $total_amount = $_POST['totalAmount'];
    $order_date = $_POST['orderDate'];
    $delivery_date = $_POST['deliveryDate'];
    $payment_method = $_POST['payment'];

    // Initialize the response array
    $response = array();

    // Prepare and execute SQL query for 'cash' payment method
    if ($payment_method === 'Card payment') { ?>
        <script>
            // Pass PHP variables to JavaScript
            var customerId = "<?php echo $customer_id; ?>";
            var totalAmount = "<?php echo $total_amount; ?>";
            var orderDate = "<?php echo $order_date; ?>";
            var deliveryDate = "<?php echo $delivery_date; ?>";
    
            const queryString = `totalAmount=${encodeURIComponent(totalAmount)}&customerId=${encodeURIComponent(customerId)}&orderDate=${encodeURIComponent(orderDate)}&deliveryDate=${encodeURIComponent(deliveryDate)}`;
            window.location.href = 'PaymentIndex.html?' + queryString;
        </script>
    <?php
    }
    

    if ($payment_method === 'Cash on delivery') {
        $stmt = $conn->prepare("INSERT INTO ordertable (CustomerId, Amount, OrderDate, DeliveryDate, PaymentMethod) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $customer_id, $total_amount, $order_date, $delivery_date, $payment_method);

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = "Payment processed and data inserted successfully!";
            $redirectUrl = 'project.php?reload=true'; 
            header("Location: $redirectUrl");
        } else {
            $response['success'] = false;
            $response['message'] = "Error: " . $stmt->error;
        }

        $stmt->close();

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        $conn->close();

        exit();
    }
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    header("Allow: POST");
    echo "Method Not Allowed";
}
?>
