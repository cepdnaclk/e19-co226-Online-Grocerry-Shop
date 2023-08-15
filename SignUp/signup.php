<?php
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$phonenum = $_POST['phonenum'];
$email = $_POST['email'];
$password = $_POST['password'];
$re_enter_password = $_POST['re_enter_password'];
$dateofbirth = $_POST['dateofbirth'];
$district = $_POST['district'];
$city = $_POST['city'];
$street = $_POST['street'];
$house_no = $_POST['house_no'];

$conn = new mysqli('localhost', 'root', '', 'project');
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Prepare and bind the query using a prepared statement
    $stmt = $conn->prepare("SELECT * FROM user WHERE Email = ?");
    $stmt->bind_param("s", $email); // "s" indicates the parameter type is a string
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $output = "Email address already exists.";
        echo "<script>alert('$output'); window.location.href = 'http://localhost/co226/e19-co226-Online-Grocerry-Shop/SignUp/SignUp.html';</script>";
        
    }else{
        if ($conn->connect_error) {
            die('Connection Failed: ' . $conn->connect_error);
        } else {
            $stmt = $conn->prepare("INSERT INTO user(FName, LName, Password, Dirstrict, City, Street, HouseNo, PhoneNo, Email, Dateofbirth) VALUES (?,?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param("ssssssssss", $fname, $lname, $password, $district, $city, $street, $house_no, $phonenum, $email, $dateofbirth);
            $stmt->execute();
            $query_user = "SELECT * FROM user WHERE Email = '$email' AND Password = '$password'";
            $result_user = mysqli_query($conn, $query_user);
            $user_row = mysqli_fetch_assoc($result_user);
            $_SESSION['auth'] = 'true';
            $_SESSION['UserId'] = $user_row['UserId'];
            header("Location: 'http://localhost/co226/e19-co226-Online-Grocerry-Shop/Homepage/'");
            exit;
            
            // Close the statement
            $stmt->close();
        }
    }
    
    // Close the connection
    $conn->close();
?>
