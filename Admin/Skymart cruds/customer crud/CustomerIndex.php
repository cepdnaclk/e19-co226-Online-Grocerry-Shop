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

        <div class="d-flex align-items-center mx-auto justify-content-center" style="margin-left: 350px !important;"> <!-- Adjust the margin value as needed -->
        <h2 class="m-0" style="color: white;margin-left: 70px !important;">Customer Details</h2>
        </div>

        <button class="btn btn-outline" type="submit" style="border-color: white;color: white;" id="customer_index_back_button">Back</button>
    </nav>

    <div class="container">

      <div class="row">
        <div class="col">
        <table class="table table-hover text-center table-striped" style="background-color: rgba(242, 242, 242, 0.8) !important; margin-left: 0px !important;">
        <thead class="table-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">FName</td>
          <th scope="col">LName</td>
          <th scope="col">District</td>
          <th scope="col">City</td>
          <th scope="col">Street</td>
          <th scope="col">HouseNo</td>
          <th scope="col">PhoneNo</th>
          <th scope="col">Email</th>
          <th scope="col">Dateofbirth</th>
        </tr>
        </thead>
        <tbody>
        <?php
          include "db_connection.php";

          $sql = "SELECT * FROM `user`";
          $result = mysqli_query($conn, $sql);

          while ($row = mysqli_fetch_assoc($result)) {
              
              echo "
                  <tr>
                      <td>{$row['UserId']}</td>
                      <td>{$row['FName']}</td>
                      <td>{$row['LName']}</td>
                      <td>{$row['Dirstrict']}</td>
                      <td>{$row['City']}</td>
                      <td>{$row['Street']}</td>
                      <td>{$row['HouseNo']}</td>
                      <td>{$row['PhoneNo']}</td>
                      <td>{$row['Email']}</td>
                      <td>{$row['Dateofbirth']}</td>
                  </tr>
              ";
          }
          ?>
        </tbody>
      </table>
        </div>
      </div>
    </div>

    <script>
      document.getElementById('customer_index_back_button').addEventListener('click', function() {
          window.location.href='http://localhost/co226/e19-co226-Online-Grocerry-Shop/Admin/AdminIndex.php'; // Replace 'Admin_home.html' with your Admin home page URL
      });
    </script>
        

    <!--bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>