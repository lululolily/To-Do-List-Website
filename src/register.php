<?php
$server_name="localhost";
$username="root";
$password="";
$database_name="database1";

/*$conn = mysqli_connect($server_name, $username, $password, $database_name);
if(!$conn)
{
    die("Connection Failed:" . mysqli_connect_error());
}

$errors = [];

if (isset($_POST['save'])) {
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
    } else {
        if ($password != $confirmpassword) {
            $errors[] = "Password and Confirm Password do not match";
        } else {
            $sql_query = "INSERT INTO entry_details (username, email, password, confirmpassword)
                          VALUES ('$username', '$email', '$password', '$confirmpassword')";
            if (mysqli_query($conn, $sql_query)) {
                mysqli_close($conn);
                // Redirect to login.html or display success message
                echo "<script>alert('Registration successful!'); window.location='login.html';</script>";
                exit();
            } else {
                $errors[] = "Error: " . mysqli_error($conn);
            }
        }
    }
    mysqli_close($conn);
}

// Display error messages as popups
if (!empty($errors)) {
    echo "<script>alert('" . implode("\\n", $errors) . "');window.location='register.html'</script>";

}
?>*/