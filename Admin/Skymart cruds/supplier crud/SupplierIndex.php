<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkyMart Courier CRUD</title>



    <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    
    <nav class="navbar navbar-light fs-3 mb-5" style="background-color: #1877F2 !important;">
        <a href="" class="navbar-brand">
            <img src="images/logo.jpg" alt="logo is missing" width="120" height="50">
        </a>

        <a href="AddSupplier.html" class="btn btn-outline-primary " type="submit" style="border-color: white;color: white;">Add New</a>

        <div class="d-flex align-items-center mx-auto justify-content-center" style="margin-left: 350px !important;"> <!-- Adjust the margin value as needed -->
        <h2 class="m-0" style="color: white;">Supplier Details</h2>
        </div>

        <button class="btn btn-outline" type="submit" style="border-color: white;color: white;" id="supplier_index_back_button">Back</button>
    </nav>

    <div class="container">

      <div class="row">
      <div class="col-2" style="margin-left: -100px;">
            <div style=" background-color: rgba(66, 180, 244, 0.7); padding: 20px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); height:fit-content; ">
              <br>
              <br>
              <p style="font-size: 21px; font-weight: bold; color: black; margin-bottom: 10px; ">Fueling Growth, Empowering Innovation 🚀🌱</p>
              <p style="font-size: 18px; font-weight: normal; color: black;">Step into the Supplier Main Page, where every connection sparks growth and innovation. Your products are catalysts that fuel our journey, enabling us to provide an array of choices to our customers. Your dedication to quality and innovation drives our shared success. Together, we're shaping an ecosystem that brings ideas to life and serves the needs of many."</p>
              <br>
            </div>
        </div>

        <div class="col-10">
        <table class="table table-hover text-center table-striped" style="background-color: rgba(242, 242, 242, 0.8) !important;">
        <thead class="table-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Supplier Name</td>
          <th scope="col">Email</th>
          <th scope="col">Phone Number</th>
          <th scope="col">Due Payment</th>
          <th scope="col">Image</th>
          <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
          include "db_connection.php";

          $sql = "SELECT * FROM `supplier`";
          $result = mysqli_query($conn, $sql);

          while ($row = mysqli_fetch_assoc($result)) {
              $imageData = base64_encode($row['SupplierImage']); // Assuming 'Image' contains binary image data
              
              echo "
                  <tr>
                      <td>{$row['Id']}</td>
                      <td>{$row['SupplierName']}</td>
                      <td>{$row['Email']}</td>
                      <td>{$row['PhoneNo']}</td>
                      <td>".number_format($row['DuePayment'],2) ."</td>
                      <td><img src='data:image/jpg;base64,{$imageData}' width='100px' height='100px'></td>
                      <td>
                          <a href='SupplierEdit.php?id={$row['Id']}' class='link-dark'><i class='fa-solid fa-pen-to-square fs-5 me-3'></i></a>
                          <a href='SupplierDelete.php?id={$row['Id']}' class='link-dark'><i class='fa-solid fa-trash fs-5'></i></a>
                      </td>
                  </tr>
              ";
          }
          ?>
        </tbody>
      </table>
        </div>
        <div class="col-2" style="margin-right: -100px;">
            <div style=" background-color: rgba(66, 180, 244, 0.7); padding: 20px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); height:fit-content; ">
              <br>
              <br>
              <p style="font-size: 21px; font-weight: bold; color: black; margin-bottom: 10px; ">Nurturing Partnerships, Delivering Quality 🤝✨</p>
              <p style="font-size: 18px; font-weight: normal; color: black;">Welcome to the Supplier Main Page, where collaboration becomes the cornerstone of progress. With every interaction, we're shaping a supply chain that resonates with reliability and excellence. As suppliers, you're the foundation of our offerings, and your commitment ensures our customers receive nothing but the best. Together, we're crafting a network that delivers value and trust.</p>
              <br>
            </div>
        </div>
      </div>
    </div>

    <script>
      document.getElementById('supplier_index_back_button').addEventListener('click', function() {
          window.location.href='http://localhost/co226/e19-co226-Online-Grocerry-Shop/Admin/AdminIndex.php'; // Replace 'Admin_home.html' with your Admin home page URL
      });
    </script>
        

    <!--bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>