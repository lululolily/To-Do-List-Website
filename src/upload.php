<?php 
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: login.php");
   }
?>
<?php

$server_name="localhost";
$username="root";
$password="";
$database_name="database1";

// Get the uploaded photo file details
$uploadedPhotoName = $_FILES['photo']['name'];
$uploadedPhotoTmpName = $_FILES['photo']['tmp_name'];

// Move the uploaded photo to a desired directory
$destination = 'uploads/' . $uploadedPhotoName;
move_uploaded_file($uploadedPhotoTmpName, $destination); 

// Store the uploaded photo details in the database
$connection = mysqli_connect($server_name, $username, $password, $database_name);

// Update the user's profile with the uploaded photo filename
$id = 123; // Replace with the actual user ID

// Store the uploaded photo details in the database
$query = "UPDATE users SET profile_photo = '$uploadedPhotoName' WHERE `id` = '".$_SESSION['id']."'";

mysqli_query($connection, $query);

mysqli_close($connection);

// Redirect the user back to the profile page
header("Location: profile.php");
exit();
?>