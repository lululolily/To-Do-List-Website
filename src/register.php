<?php
$server_name="localhost";
$username="root";
$password="";
$database_name="database1";

$conn = mysqli_connect($server_name, $username, $password, $database_name);
if(!$conn)
{
    die("Connection Failed:" . mysqli_connect_error());
}

if(isset($_POST['save']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    
    $sql_query = "INSERT INTO entry_details (username,email,password,confirmpassword)
    VALUES ('$username','$email','$password','$confirmpassword')";
if (mysqli_query($conn, $sql_query)) {
    header("Location: index.html");
} else {
    echo "Error: " . $sql . "" . mysqli_error($conn);
}
mysqli_close($conn);
}
?>