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

  $sql = "UPDATE `supplier` SET `SupplierName`='$supplier_name',`Email`='$email',`PhoneNo`='$phone_number',`DuePayment`='$due_payment', `SupplierImage` = ? WHERE Id = $id";

  // Use prepared statement for the query
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, 's', $supplier_image);
  $result = mysqli_stmt_execute($stmt);

  if ($result) {
    header("Location: SupplierIndex.php?msg=Data updated successfully");
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

  <title>Supplier</title>
</head>

<body>
<nav class="navbar navbar-light fs-3 mb-5" style="background-color: #1877F2 !important;">
        <a href="" class="navbar-brand d-flex align-items-center " style="margin-left: 50px !important;">
            <img src="images/logo.jpg" alt="logo is missing" width="120" height="50" >
        </a>

        <div class="d-flex align-items-center mx-auto justify-content-center" style="margin-left: 450px !important;"> <!-- Adjust the margin value as needed -->
        <h2 class="m-0" style="color: white;">Supplier Details</h2>
        </div>

        <button class="btn btn-outline d-flex align-items-center" type="submit" style="border-color: white;color: white; margin-right: 50px;" id="supplier_edit_back_button">Back</button>
</nav>

  <div class="container">
    <div class="row">
      <div class="col-4">
        <br>
        <br>

          <div style=" background-color: rgba(161, 212, 248, 0.6); padding: 20px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); height:fit-content; ">
            <br>
            <br>
            <p style="font-size: 21px; font-weight: bold; color: black; margin-bottom: 10px; ">Cultivating Excellence, Together and Always 🌱🤝</p>
            <p style="font-size: 18px; font-weight: normal; color: black;">Welcome to the 'Supplier Details Edit' page, where every adjustment is a step towards nurturing our partnership. As we refine the details, we're strengthening the foundation of trust and collaboration. Your dedication to delivering quality resonates through every product and transaction. With each modification, we're crafting a narrative of shared success. Thank you for being a cornerstone of our growth and innovation journey.</p>
            <br>
          </div>
      </div>
      <div class="col-2"></div> 

      <div class="col-6" style="background-color: rgba(193, 234, 243, 0.6);padding: 20px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); height:fit-content; ">
            <div class="text-center mb-4">
              <h3>Edit Supplier Information</h3>
              <p class="text-muted" style="color: black !important;">Click update after changing any information</p>
            </div>

            <?php
              $id = $_GET['id'];
              $sql = "SELECT * FROM `supplier` WHERE id = $id LIMIT 1";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_assoc($result);
            ?>

            <div class="container d-flex justify-content-center">
              <form  method="post" enctype="multipart/form-data" style="width:50vw; min-width:300px;">
                
                <div class="form-group mb-3">
                  <label for="supplier_name">Supplier Name</label>
                  <input type="text" class="form-control" id="supplier_name" name="supplier_name" 
                  placeholder="Ex: FirstName LastName" required>
                </div>

                <div class="form-group mb-3">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Ex: example123@gmail.com" required>
                </div>

                <div class="form-group mb-3">
                  <label for="phone_number">Phone Number</label>
                  <input type="tel" class="form-control" id="phone_number" name="phone_number"  placeholder="Ex: 07x xxxxxxx" required>
                </div>

                <div class="form-group mb-3">
                  <label for="due_payment">Due Payment</label>
                  <input type="number" class="form-control" id="due_payment" name="due_payment" rows="3" placeholder="Ex: xxxxxx.yy" required>
                </div>

                <div class="form-group mb-3">
                  <label for="supplier_image">Image</label>
                  <input type="file" class="form-control" id="supplier_image" name="supplier_image" accept="image/*" required>
                </div>

                <div class="container d-flex justify-content-center">
                    <button type="submit" class="btn btn-success mr-3" name="submit">Update</button>
                    <a href="SupplierIndex.php" class="btn btn-danger ml-3">Cancel</a>
                </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    <script>
      document.getElementById('supplier_edit_back_button').addEventListener('click', function() {
          window.location.href='SupplierIndex.php'; 
      });
    </script>
    
  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>