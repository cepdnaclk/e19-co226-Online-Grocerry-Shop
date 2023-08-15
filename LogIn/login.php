
<?php
session_start(); // Always start the session before any output

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $conn = new mysqli('localhost', 'root', '', 'project');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query_user = "SELECT * FROM user WHERE Email = '$email' AND Password = '$password'";
    $result_user = mysqli_query($conn, $query_user);

    $query_admin = "SELECT * FROM admin WHERE Email = '$email' AND Password = '$password'";
    $result_admin = mysqli_query($conn, $query_admin);

    if (mysqli_num_rows($result_admin) == 1) {
        $_SESSION['auth'] = 'true';
        header("Location: ../Admin/AdminIndex.php");
        exit;
    } elseif (mysqli_num_rows($result_user) == 1) {
        $user_row = mysqli_fetch_assoc($result_user);
        $_SESSION['auth'] = 'true';
        $_SESSION['UserId'] = $user_row['UserId'];
        header("Location: http://localhost/e19-co226-Online-Grocery-Shop/Homepage/Project.php");
        exit;
    }
}
?>
<!-- Rest of your HTML and JavaScript code -->

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./LogIn.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
    <script type="text/javascript">
        // JavaScript code to handle the form submission
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('login').addEventListener('submit', function(event) {
                // If the PHP script didn't redirect, show an alert
                alert("Sorry, we can't find an account with this email address or incorrect password. Please try again.");
                event.preventDefault(); // Prevent the form from submitting
            });
        });
    </script>
</head>
<body>  
    <div class="regform">
        <h3>Log In</h3>
        <form action="" method="post">
            <div class="container">
                <div class="input" >
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" >
                </div>
                <div class="input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password"  required minlength="2" maxlength="12">
                </div> 
            </div>
            <div class="btn">
                <button type="submit" id="login">Log In</button>
            </div>
            <div>
                <p>New to Sky Mart? <a href="../SignUp/SignUp.html">Sign Up Now</a></p>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        // JavaScript code to handle the form submission
        document.getElementById('login').addEventListener('submit', function(event) {
            // If the PHP script didn't redirect, show an alert
            alert("Sorry, we can't find an account with this email address or incorrect password. Please try again.");
            event.preventDefault(); // Prevent the form from submitting
        });
    </script>
    
</body>
</html>