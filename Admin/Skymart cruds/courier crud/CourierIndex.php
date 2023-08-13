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
            <img src="logo_1.jpg" alt="logo is missing" width="120" height="50">
        </a>

        <a href="AddCourier.html" class="btn btn-outline-primary " type="submit" style="border-color: white;color: white;">Add New</a>

        <div class="d-flex align-items-center mx-auto justify-content-center" style="margin-left: 350px !important;"> <!-- Adjust the margin value as needed -->
        <h2 class="m-0" style="color: white;">Courier Details</h2>
        </div>

        <button class="btn btn-outline" type="submit" style="border-color: white;color: white;" id="courier_index_back_button">Back</button>
    </nav>

    <div class="container">

      <div class="row">
      <div class="col-2" style="margin-left: -100px;">
            <div style=" background-color: rgba(66, 180, 244, 0.7); padding: 20px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); height:fit-content; ">
              <br>
              <br>
              <p style="font-size: 21px; font-weight: bold; color: white; margin-bottom: 10px; ">Connecting Paths, Delivering Dreams 🚚✨</p>
              <p style="font-size: 18px; font-weight: normal; color: white;">Every mile traveled is a bridge between stories. With each delivery, we're stitching the tapestry of connections that shape our world. From doorsteps to destinations, we carry not just parcels but aspirations, smiles, and surprises. With every package, we create moments that span the distance. Welcome to the heart of our courier network.</p>
              <br>
            </div>
        </div>

        <div class="col-10">
        <table class="table table-hover text-center table-striped" style="background-color: rgba(242, 242, 242, 0.5) !important;">
        <thead class="table-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Courier Name</td>
          <th scope="col">Salary</th>
          <th scope="col">Start Date</th>
          <th scope="col">Phone Number</th>
          <th scope="col">Area Covered</th>
          <th scope="col">Image</th>
          <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
          include "db_connection.php";

          $sql = "SELECT * FROM `courier`";
          $result = mysqli_query($conn, $sql);

          while ($row = mysqli_fetch_assoc($result)) {
              $imageData = base64_encode($row['CourierImage']); // Assuming 'Image' contains binary image data
              
              echo "
                  <tr>
                      <td>{$row['Id']}</td>
                      <td>{$row['CourierName']}</td>
                      <td>".number_format($row['Salary'],2) ."</td>
                      <td>{$row['StartDate']}</td>
                      <td>{$row['PhoneNumber']}</td>
                      <td>{$row['AreaCovered']}</td>
                      <td><img src='data:image/jpg;base64,{$imageData}' width='100px' height='100px'></td>
                      <td>
                          <a href='CourierEdit.php?id={$row['Id']}' class='link-dark'><i class='fa-solid fa-pen-to-square fs-5 me-3'></i></a>
                          <a href='CourierDelete.php?id={$row['Id']}' class='link-dark'><i class='fa-solid fa-trash fs-5'></i></a>
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
              <p style="font-size: 21px; font-weight: bold; color: white; margin-bottom: 10px; ">Bridging Distances, Delivering Happiness 🌍📦</p>
              <p style="font-size: 18px; font-weight: normal; color: white;">Beyond roads and borders, our couriers forge the path of convenience. In every journey, we're not just delivering items – we're delivering moments of joy, convenience, and connection. From package to recipient, our network becomes a thread that weaves together lives. With every delivery, we're writing stories of smiles and memories</p>
              <br>
            </div>
        </div>
      </div>
    </div>

    <script>
      document.getElementById('courier_index_back_button').addEventListener('click', function() {
          console.log("Button clicked!"); 
          window.location.href='http://localhost/co226%20project/Admin/AdminIndex.php'; // Replace 'Admin_home.html' with your Admin home page URL
      });
    </script>
        

    <!--bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>