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

$conn = new mysqli('localhost', 'root', '', 'co226');
    
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
        echo "<script>alert('$output'); window.location.href = './SignUp.html';</script>";
        
    }else{
        if ($conn->connect_error) {
            die('Connection Failed: ' . $conn->connect_error);
        } else {
            $stmt = $conn->prepare("INSERT INTO user(FName, LName, Password, Dirstrict, City, Street, HouseNo, PhoneNo, Email, Dateofbirth) VALUES (?,?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param("ssssssssss", $fname, $lname, $password, $district, $city, $street, $house_no, $phonenum, $email, $dateofbirth);
            $stmt->execute();
            echo ("Registration Successfully Completed");
            // Close the statement
            $stmt->close();
        }
    }
    
    // Close the connection
    $conn->close();
?>
