<?php
$server_name = "localhost";
$username = "root";
$password = "";
$database_name = "database1";

$conn = mysqli_connect($server_name, $username, $password, $database_name);
if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

$errors = [];

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    // Escape user input to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);
    $confirmpassword = mysqli_real_escape_string($conn, $confirmpassword);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email format invalid";
    }

    // Validate password length
    if (strlen($password) < 8) {
        $errors[] = "Password needs to be longer than 8 characters";
    }

    $select = "SELECT * FROM entry_details WHERE email = '$email'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $errors[] = "User already exists";
    }

    if ($password != $confirmpassword) {
        $errors[] = "Password and Confirm Password do not match";
    }

    if (empty($errors)) {
        $sql_query = "INSERT INTO entry_details (username, email, password, confirmpassword)
                      VALUES ('$username', '$email', '$password', '$confirmpassword')";
        if (mysqli_query($conn, $sql_query)) {
            mysqli_close($conn);
            // Redirect to login.html or display success message
            echo "<script>alert('Registration successful!'); window.location='login.php';</script>";
            exit();
        } else {
            $errors[] = "Error: " . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
}

// Display error messages on the page
if (!empty($errors)) {
    echo "<script>alert('" . implode("\\n", $errors) . "');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/registerstyles.css">

</head>
<body>
    <div class="wrapper">
        <div class="container main">
            <div class="row">
                <div class="col-md-6 side-image">
                    <img src="assets\test.jpg" class="side-image">
                
                </div>
                <div class="col-md-6 right">
                    <div class="input-box">
                       <header>WELCOME TO MINNI TO-DO-LIST</header>
                       <form id = "register-form" action="" method="post">
                       <div class="input-field">
                            <input type="text" class="input" name="username" id="username"  placeholder="Username" autocomplete="off" required> 
                            <label for="username"></label>     
                       </div>
                       <div class="input-field">
                            <input type="text" class="input" name="email" id="email" placeholder="Email" autocomplete="off" required>
                            <label for="email"></label>
                       </div>
                       <div class="input-field">
                       <input type="password" class="input" name="password" id="password"  placeholder="Password" autocomplete="off" required>
                       <label for="password"></label>
                       </div>
                       <div class="input-field">
                       <input type="password" class="input" name="confirmpassword" id="confirmpassword"  placeholder="Confirm Password" autocomplete="off" required>
                       <label for="emailconfirmpassword"></label>
                       </div>
                       <div class="input-field">
                           <input type="submit" class="submit" name="submit" value="Sign up" >
                       </div>                      
                       <div class="signin">
                           <span>Already a member? <a href="login.php">Sign in here</a></span>
                       </div>
                       </form>
                     </div>
                </div>
            </div>
        </div>
</body>
</html>

