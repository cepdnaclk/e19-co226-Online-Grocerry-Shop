<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$id = $_GET["id"];

if (isset($_POST["submit"])) {
  $Product_Name = $_POST['product_name'];
  $Product_Category = $_POST['product_category'];
  $Buying_Price = $_POST['buying_price'];
  $Selling_Price = $_POST['selling_price'];
  $Product_Description = $_POST['product_description'];

  // Handle image upload
  if (isset($_FILES['product_image']['tmp_name']) && is_uploaded_file($_FILES['product_image']['tmp_name'])) {
      $product_image = file_get_contents($_FILES['product_image']['tmp_name']);
      if ($product_image === false) {
          die("Error: Unable to read image file.");
      }
  } else {
      die("Error: Image not uploaded.");
  }

  $sql = "UPDATE `product` SET `ProductName`='$Product_Name',`Category`='$Product_Category',`BuyingPrice`='$Buying_Price',`SellingPrice`='$Selling_Price',`Description`='$Product_Description', `Image` = ? WHERE Id = $id";

  // Use prepared statement for the query
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, 's', $product_image);
  $result = mysqli_stmt_execute($stmt);

  if ($result) {
    header("Location: product_index.php?msg=Data updated successfully");
  } else {
    echo "Failed: " . mysqli_error($conn);
  }

  mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<!-- ... The rest of your HTML code ... -->


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>Products</title>
</head>

<body>
<nav class="navbar navbar-light fs-3 mb-5" style="background-color: #1877F2 !important;">
        <a href="" class="navbar-brand d-flex align-items-center " style="margin-left: 50px !important;">
            <img src="images/logo.jpg" alt="logo is missing" width="120" height="50" >
        </a>

        <div class="d-flex align-items-center mx-auto justify-content-center" style="margin-left: 450px !important;"> <!-- Adjust the margin value as needed -->
        <h2 class="m-0" style="color: white;">Product Details</h2>
        </div>

        <button class="btn btn-outline d-flex align-items-center" type="submit" style="border-color: white;color: white; margin-right: 50px;" id="product_edit_back_button">Back</button>
</nav>

  <div class="container">
    <div class="row">
    <div class="col-4">
        <br>
        <br>
          <div style="text-align: center; background-color: rgba(161, 212, 248, 0.6); padding: 20px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); height:fit-content; ">
            <br>
            <br>
            <p style="font-size: 21px; font-weight: bold; color: black; margin-bottom: 10px; ">Refining Excellence, One Detail at a Time 🛍️✨</p>
            <p style="font-size: 18px; font-weight: normal; color: black;">Welcome to the 'Product Details Edit' page, where every modification adds a stroke to the canvas of perfection. As you fine-tune the product's attributes, you're weaving threads of precision that enhance our offerings. Your attention to detail crafts an experience that resonates with our customers. With each adjustment, we're elevating the art of shopping. Thank you for your commitment to delivering excellence in every product journey.</p>
            <br>
          </div>
      </div>
      <br>
      <div class="col-2"></div>
      <div class="col-6" style="background-color: rgba(193, 234, 243, 0.6);padding: 20px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); height:fit-content; ">
          <div class="text-center mb-4">
            <h3>Edit Product Information</h3>
            <p class="text-muted">Click update after changing any information</p>
          </div>

          <?php
            $id = $_GET['id'];
            $sql = "SELECT * FROM `product` WHERE id = $id LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
          ?>

        <div class="container d-flex justify-content-center">
          <form  method="post" enctype="multipart/form-data" style="width:50vw; min-width:300px;">
            
            <div class="form-group mb-3">
              <label for="product_name">Product Name</label>
              <input type="text" class="form-control" id="product_name" name="product_name" 
              placeholder="Ex: Green Apple" required>
            </div>

            <div class="form-group mb-3">
              <label for="product_category">Product Category</label>
              <input type="text" class="form-control" id="product_category" name="product_category" placeholder="Ex: Apple" required>
            </div>

            <div class="form-group mb-3">
              <label for="product_price">Buying Price</label>
              <input type="number" class="form-control" id="buying_price" name="buying_price"  placeholder="Ex: 1234.56" required>
            </div>

            <div class="form-group mb-3">
              <label for="product_price">Selling Price</label>
              <input type="number" class="form-control" id="selling_price" name="selling_price"  placeholder="Ex: 2345.67" required>
            </div>

            <div class="form-group mb-3">
              <label for="product_image">Product Image</label>
              <input type="file" class="form-control" id="product_image" name="product_image" accept="image/*" required>
            </div>
        
            <div class="form-group mb-3">
              <label for="product_description">Product Description</label>
              <textarea class="form-control" id="product_description" name="product_description" rows="3" placeholder="Ex: Comment Here..!" required></textarea>
            </div>

            <div class="container d-flex justify-content-center">
              <button type="submit" class="btn btn-success" name="submit">Update</button>
              <a href="product_index.php" class="btn btn-danger">Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
      document.getElementById('product_edit_back_button').addEventListener('click', function() {
          window.location.href='product_index.php'; 
      });
    </script>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>