<?php

        $email = $_POST['email'];
        $password = $_POST['password'];
        $conn = new mysqli('localhost', 'root', '', 'project');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
            $query_user = "SELECT * FROM user WHERE Email = '$email'  and Password = '$password'";
            $result_user = mysqli_query($conn, $query_user);

            $query_admin = "SELECT * FROM admin WHERE Email = '$email' and Password = '$password'";
            $result_admin = mysqli_query($conn, $query_admin);
            

            if (mysqli_num_rows($result_admin) == 1) {
                session_start();
                $_SESSION['auth'] = 'true';
                header("Location: ../Admin/AdminIndex.php");

                exit;
                } elseif (mysqli_num_rows($result_user) == 1) {
                    session_start();
                    $_SESSION['auth'] = 'true';
                    header("Location: ./html/about.html");
                    exit;
                } else {
                    $output = "Sorry, we can't find an account with this email address. or incorrect password. Please try again";
                    echo "<script>alert('$output'); window.location.href = 'http://localhost/e19-co226-Online-Grocery-Shop/LogIn/LogIn.html';</script>";
                }
    ?>