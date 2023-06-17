<?php
// Database configuration
$server_name="localhost";
$username="root";
$password="";
$database_name="database1";

/*$conn = mysqli_connect($server_name, $username, $password, $database_name);
if(!$conn)
{
    die("Connection Failed:" . mysqli_connect_error());
}

$currentUsername = $_SESSION['username']; // Assuming you have the username stored in the session
$query = "SELECT username, photo, email FROM entry_details WHERE username = '$currentUsername'";
$result = mysqli_query($connection, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $currentUsername = $row['username'];
    $currentPhoto = $row['photo'];
    $currentEmail = $row['email'];
} else {
    // Handle the error if the query fails
    $errorMessage = mysqli_error($connection);
    // You can log the error, display an error message, or perform any other appropriate action
    echo "Error: " . $errorMessage;
}

// Update the user's data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $currentUsername = $_SESSION['username']; // Assuming you have the username stored in the session

    if (isset($_POST['newUsername'])) {
        $newUsername = $_POST['newUsername'];
        // Update the username in the database
        $updateQuery = "UPDATE entry_details SET username = '$newUsername' WHERE username = '$currentUsername'";
        $updateResult = mysqli_query($connection, $updateQuery);
        if ($updateResult) {
            $currentUsername = $newUsername;
        } else {
            // Handle the error if the update query fails
            $errorMessage = mysqli_error($connection);
            // You can log the error, display an error message, or perform any other appropriate action
            echo "Error updating username: " . $errorMessage;
        }
    }

    if (isset($_POST['newEmail'])) {
        $newEmail = $_POST['newEmail'];
        // Update the email in the database
        $updateQuery = "UPDATE entry_details SET email = '$newEmail' WHERE username = '$currentUsername'";
        $updateResult = mysqli_query($connection, $updateQuery);
        if ($updateResult) {
            $currentEmail = $newEmail;
        } else {
            // Handle the error if the update query fails
            $errorMessage = mysqli_error($connection);
            // You can log the error, display an error message, or perform any other appropriate action
            echo "Error updating email: " . $errorMessage;
        }
    }
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $photo = $_FILES['photo'];
      
        // Retrieve the photo details
        $photoName = $photo['name'];
        $photoTmpName = $photo['tmp_name'];
        $photoError = $photo['error'];
      
        // Validate the photo file and move it to the desired location
        if ($photoError === UPLOAD_ERR_OK) {
            // Specify the directory where you want to save the uploaded photo
            $uploadDirectory = 'path/to/upload/directory/';
          
            // Generate a unique filename for the uploaded photo
            $photoExtension = pathinfo($photoName, PATHINFO_EXTENSION);
            $newPhotoName = uniqid() . '.' . $photoExtension;
          
            // Move the uploaded photo to the specified directory
            $destination = $uploadDirectory . $newPhotoName;
            if (move_uploaded_file($photoTmpName, $destination)) {
                // Update the photo in the database
                $updateQuery = "UPDATE entry_details SET photo = '$newPhotoName' WHERE username = '$currentUsername'";
                $updateResult = mysqli_query($connection, $updateQuery);
                if ($updateResult) {
                    $currentPhoto = $newPhotoName;
                } else {
                    // Handle the error if the update query fails
                    $errorMessage = mysqli_error($connection);
                    // You can log the error, display an error message, or perform any other appropriate action
                    echo "Error updating photo: " . $errorMessage;
                }
            } else {
                // Handle the error if the file couldn't be moved
                echo "Error uploading photo. Please try again.";
            }
        } else {
            // Handle the error if the uploaded file is invalid
            echo "Invalid photo. Please choose a different file.";
        }
    }
    
    // Redirect to the profile page after the updates
    header("Location: profile.php");
    exit();
}
?>*/


