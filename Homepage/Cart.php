<?php
session_start();
$userId = $_SESSION['UserId'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

if (isset($_GET['productIds'])) {
    $encodedProductIds = $_GET['productIds'];

    $productIds = json_decode(urldecode($encodedProductIds), true);
}
$jsonData_1 = json_encode($productIds);
echo "<script>var Id = $jsonData_1;</script>";
$price = [];
$_SESSION['$productIds'] = $productIds;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="design.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-md">
            <h1 style="color:aliceblue">Shopping Cart</h1>
        </div>
    </nav>
    <main class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <?php
                        $total = 0.00;
                        foreach ($productIds as $key => $value) {
                            $query = "SELECT * FROM product WHERE Id = $value";
                            $query_run = mysqli_query($conn, $query);
                            $check_query = mysqli_num_rows($query_run);
                            $row = mysqli_fetch_assoc($query_run);
                            $imageData = base64_encode($row['Image']);
                            array_push($price, number_format($row['SellingPrice'], 2));
                            $total = $total + floatval($row['SellingPrice']);
                        ?>
                            <div class="col-md-4 ">
                                <img src='data:image/jpg;base64,<?php echo $imageData; ?>' alt="Product" class="img-fluid">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">

                                    <h5 class="card-title"><?php echo $row['ProductName']; ?></h5>
                                    <label for="quantity">Quantity:</label>
                                    <input type="number" id="quantity<?php echo $row['Id']; ?>" name="quantity" min="1" value="1" required style="width: 1.5cm;">
                                    <p class="card-text">
                                    <h6 class="card-title">LKR <?php echo number_format($row['SellingPrice'], 2); ?></h6>
                                    </p>
                                    <button class="btn btn-danger remove-button">Remove</button>
                                </div>
                            </div>
                        <?php
                        }
                        $jsonData_2 = json_encode($price);
                        echo "<script>var Price = $jsonData_2;</script>";
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4" style="float: right;">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Cart Summary</h5>
                        <p class="card-text" id="totalPrice">Total Price:<?php echo $total ?>.00 </p>
                        <p> Delivery Date: <span id="delivery-date-id-display"></span></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Payment Process</h5>
                        <form id="payment-form" action="order.php" method="POST">
                            <input type="radio" id="card" name="payment" value="Card payment" checked>
                            <label for="html">Card payment</label><br>
                            <input type="radio" id="cash" name="payment" value="Cash on delivery">
                            <label for="css">Cash on delivery</label><br>

                            <input type="hidden" name="userId" id="userId" value="">
                            <input type="hidden" name="totalAmount" id="totalAmount" value="">
                            <input type="hidden" name="orderDate" id="orderDate" value="">
                            <input type="hidden" name="deliveryDate" id="deliveryDate" value="">

                            <p style="color: red;"><span id="selectedMethod"></span></p>
                            <button class="btn btn-primary checkout-button" id="pay">Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="container mt-4">
        <p>&copy; 2023 Sky Mart. All rights reserved.</p>
    </footer>
    <script>
        function calculateFutureDate() {
            const currentDate = new Date();
            const futureDate = new Date(currentDate.getTime() + (4 * 24 * 60 * 60 * 1000));
            return futureDate.toISOString().split('T')[0];
        }

        const deliveryDate = calculateFutureDate();
        document.getElementById('delivery-date-id-display').textContent = deliveryDate;
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <script>
        var total = 0.00;
        for (var i = 0; i < Id.length; i++) {
            var price = parseFloat(Price[i].replace(/,/g, ''));
            total += price;
        }
        const orderDate = new Date().toISOString().split('T')[0];
    </script>

    <script>
        var myParagraph = document.getElementById('totalPrice');

        function updateTotalPrice() {
            total = 0.00;
            for (var i = 0; i < Id.length; i++) {
                var quantity = parseFloat(document.getElementById('quantity' + Id[i]).value); // Use the specific product's quantity input
                var price = parseFloat(Price[i].replace(/,/g, ''));
                if (document.getElementById('quantity' + Id[i]).value == "") {
                    quantity = 0;
                }
                total += quantity * price;
            }
            myParagraph.textContent = "LKR " + total.toFixed(2);

        }

        var quantityInputs = document.querySelectorAll('input[name="quantity"]'); // Select quantity input elements by name attribute
        quantityInputs.forEach(function(input) {
            input.addEventListener('input', function() {
                updateTotalPrice();
            });
        });
    </script>



    <script>
        const getPaymentMethodButton = document.getElementById('pay');
        const selectedMethod = document.getElementById('selectedMethod');


        document.getElementById('userId').value = parseInt(<?php echo $userId; ?>);
        document.getElementById('totalAmount').value = total;
        document.getElementById('orderDate').value = orderDate;
        document.getElementById('deliveryDate').value = deliveryDate;
    </script>


</body>

</html>