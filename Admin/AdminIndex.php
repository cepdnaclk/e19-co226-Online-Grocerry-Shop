<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>




    <!--bootstarp-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

</head>

<body>
    <nav class="navbar bg-body-tertiary" style="background-color:#1877F2 !important;">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="images/logo.jpg" alt="Logo is missing" width="80" height="30" style="margin-left: -50px;">
            </a>
            <h3 class="text-muted" style="color: white !important;">SkyMart Admin</h3>
            <button class="btn btn-outline d-flex align-items-center" type="submit" style="border-color: white;color: white; margin-right: -50px;" id="admin_log_out_button">Log Out</button>
        </div>
    </nav>

    <br>
    <br>

    <nav class="navbar ">
        <div class="container justify-content-center align-item-center" style="background-color: rgba(66, 180, 244, 0.7); height: 180px; width:60%; border-radius: 10mm !important;">
            <br>
            <p style="font-size: 23px; font-weight: bold; color: white; margin-bottom: 10px; margin-top: 0.5cm; ">Welcome to the Admin Portal 🌟</p>
            <p style="text-align: center; font-size: 18px; font-weight: normal; color: white;">As you enter the admin page, your dedication ignites efficiency, your insights kindle innovation, and your actions sculpt excellence. You're the heart of seamless experiences, turning challenges into stepping stones. Your commitment sets the bar high. Welcome to the driving force of progress!</p>
        </div>
    </nav>

    <br>
    <br>
    <br>

    <div class="container">
        <div class="row">
            <div class="col-3 mx-auto   " style="margin-left: 100px; ">
                <div class="card" style="width: 18rem; margin-left: 8px !important; margin-top: 8px !important; margin-bottom: 8px !important; ">
                    <img src="images/supplier.jpg" class="card-img-top" alt="Supplier logo is missing" style="height: 200px; width:200px !important; margin-left: 40px !important;">
                    <div class="card-body">
                        <h5 class="supplier-card">Suppliers</h5>
                        <p class="card-text">Click below to look into the suppliers details, add new suppliers and to do any modification on suppliers details!</p>
                        <a href="Skymart cruds/supplier crud/SupplierIndex.php" class="btn btn-primary">View Supplier Info</a>
                    </div>
                </div>
            </div>

            <div class="col-4 mx-auto">
                <div class="card" style="width: 18rem; margin-left: 60px !important; margin-top: 8px !important; margin-bottom: 8px !important;">
                    <img src="images/product.jpg" class="card-img-top" alt="Product logo is missing" style="height: 200px; width:200px !important; margin-left: 40px !important;">
                    <div class="card-body">
                        <h5 class="product-card">Products</h5>
                        <p class="card-text">Click below to look into the products details, add new products and to do any modification on products details!</p>
                        <a href="Skymart cruds/product crud/product_index.php" class="btn btn-primary">View Product Info</a>
                    </div>
                </div>
            </div>

            <div class="col-3 mx-auto">
                <div class="card" style="width: 18rem; margin-left: 8px !important; margin-top: 8px !important; margin-bottom: 8px !important;">
                    <img src="images/courier.jpg" class="card-img-top" alt="Courier logo is missing" style="height: 200px; width:200px !important; margin-left: 40px !important; ">
                    <div class="card-body">
                        <h5 class="courier-card">Couriers</h5>
                        <p class="card-text">Click below to look into the couriers details, add new couriers and to do any modification on couriers details!</p>
                        <a href="Skymart cruds/courier crud/CourierIndex.php" class="btn btn-primary">View Courier Info</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        // Get a reference to the Log Out button
        var logOutButton = document.getElementById("admin_log_out_button");

        // Add a click event listener to the button
        logOutButton.addEventListener("click", function() {
            // Redirect to the admin.html page
            window.location.href = "http://localhost/co226/e19-co226-Online-Grocerry-Shop/LogIn/login.php";
        });
    </script>



    <!--bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>

</html>