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
    
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
      <h2>Courier Details</h2>
    </nav>

    <div class="container">

      <a href="Addproduct.html" class="btn btn-dark mb-3">Add New</a>

      <table class="table table-hover text-center">
        <thead class="table-dark">
        <tr>
          <td scope="col">ID</td>
          <td scope="col">Courier Name</td>
          <td scope="col">Salary</td>
          <td scope="col">Start Date</td>
          <td scope="col">Phone Number</td>
          <td scope="col">Area Covered</td>
          <td scope="col">Image</td>
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
                      <td>{$row['Salary']}</td>
                      <td>{$row['StartDate']}</td>
                      <td>{$row['phoneNumber']}</td>
                      <td>{$row['AreaCovered']}</td>
                      <td><img src='data:image/jpg;base64,{$imageData}' width='100px' height='100px'></td>
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
        

    <!--bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>