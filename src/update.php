<?php
$server_name="localhost";
$username="root";
$password="";
$database_name="database1";

include("php/config.php");
session_start();

  // Check if the user is logged in (optional)
  if (!isset($_SESSION['valid'])) {
    // Redirect the user to the login page or handle the unauthorized access
    header("Location: login.php");
    exit; // Make sure to exit after redirection
}
if(!$conn)
{
    die("Connection Failed:" . mysqli_connect_error());
}

if (isset($_SESSION['id'])) {
    $id = $_POST['id'];
    $taskname = $_POST['task-name'];
    $datetime = $_POST['date-time'];
    $category = $_POST['category'];
    $status = $_POST['status'];
    $user_id = $_SESSION['id'];
    
    $sql_query = "UPDATE tasks SET `taskname`='$taskname', `datetime`='$datetime',`category`='$category', `status`='$status' WHERE id='$id'"; 
    if (mysqli_query($conn, $sql_query)) {
        $redirect_url = '';

        if (strpos($_SERVER['HTTP_REFERER'], 'index.php') !== false) {
            $redirect_url = 'index.php';
        } elseif (strpos($_SERVER['HTTP_REFERER'], 'summary.php') !== false) {
            $redirect_url = 'summary.php';
        } elseif (strpos($_SERVER['HTTP_REFERER'], 'category.php') !== false) {
            $redirect_url = 'category.php';
        } elseif (strpos($_SERVER['HTTP_REFERER'], 'status.php') !== false) {
            $redirect_url = 'status.php';
        } elseif (strpos($_SERVER['HTTP_REFERER'], '') !== false) {
            $redirect_url = 'index.php';
        }

        if (!empty($redirect_url)) {
            header("Location: " . $redirect_url);
            exit;
        }
    } else {
        echo "Error: " . $sql_query . "" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>