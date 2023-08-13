<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkyMart CRUD</title>

    <style>

      /* Style the table with rounded corners */
      .table {
        background-color: white;
        border-radius: 10px !important; /* Adjust the border radius as needed */
        overflow: hidden; /* Hide overflow to prevent content from overflowing the rounded corners */
      }

       /* Style the table header cells */
       .table th {
        background-color: #333333 !important;
      }

      /* Style the table body cells */
      .table td {
        background-color: white !important;
      }

      /* Style odd rows */
      .odd-row {
        background-color: #f2f2f2 !important; /* Lighter color for odd rows */
      }

      /* Style even rows */
      .even-row {
        background-color: #e0e0e0 !important; /* Slightly darker color for even rows */
      }
    </style>



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

        <a href="Addproduct.html" class="btn btn-outline-primary " type="submit" style="border-color: white;color: white;">Add New</a>

        <div class="d-flex align-items-center mx-auto justify-content-center" style="margin-left: 350px !important;"> <!-- Adjust the margin value as needed -->
        <h2 class="m-0" style="color: white;">Products Details</h2>
        </div>

        <button class="btn btn-outline-primary" type="submit" style="border-color: white;color: white;" id="product_index_back_button">Back</button>
    </nav>

    <div style="text-align: center; background-color: #d0efff;padding: 20px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); height:fit-content; width: 80%; margin-left: 150px;">
      <p style="font-size: 23px; font-weight: bold; color: rgb(17, 17, 17); margin-bottom: 10px; ">Elevating Everyday Moments with Quality 🛍️✨</p>
      <p style="font-size: 18px; font-weight: normal; color: rgb(28, 27, 27);">Step into the realm of possibilities on our product main page. Here, every click unveils a world of choice and delight. As you explore our offerings, you're weaving stories of comfort, style, and convenience. From essentials to luxuries, each product has a story to tell. Welcome to the gateway of elevated living, where your journey meets our commitment to excellence</p>
    </div>
5
    <div class="container">
      <table class="table table-hover text-center">
        <thead class="table-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Product Name</th>
          <th scope="col">Product Category</th>
          <th scope="col">Product Description</th>
          <th scope="col">Selling Price</th>
          <th scope="col">Buying Price</th>
          <th scope="col">Image</th>
          <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
          include "db_connection.php";

          $sql = "SELECT * FROM `product`";
          $result = mysqli_query($conn, $sql);

          while ($row = mysqli_fetch_assoc($result)) {
              $imageData = base64_encode($row['Image']); // Assuming 'Image' contains binary image data
              
              echo "
                  <tr>
                      <td>{$row['Id']}</td>
                      <td>{$row['ProductName']}</td>
                      <td>{$row['Category']}</td>
                      <td>{$row['Description']}</td>
                      <td>" . number_format($row['SellingPrice'], 2) . "</td>
                      <td>" . number_format($row['BuyingPrice'], 2) . "</td>
                      <td><img src='data:image/jpg;base64,{$imageData}' width='120px' height='70px'></td>
                      <td>
                          <a href='edit.php?id={$row['Id']}' class='link-dark'><i class='fa-solid fa-pen-to-square fs-5 me-3'></i></a>
                          <a href='delete.php?id={$row['Id']}' class='link-dark'><i class='fa-solid fa-trash fs-5'></i></a>
                      </td>
                  </tr>
              ";
          }
          ?>
        </tbody>
      </table>
    </div>

    <script>
      document.getElementById('product_index_back_button').addEventListener('click', function() {
          window.location.href='http://localhost/co226%20project/Admin/AdminIndex.php'; // Replace 'Admin_home.html' with your Admin home page URL
      });
    </script>
    
        

    <!--bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>