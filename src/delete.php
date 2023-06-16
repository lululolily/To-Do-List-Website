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
    $user_id = $_SESSION['id'];
    
    $sql_query = "DELETE FROM tasks WHERE id='$id'";
    
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
        echo "Error: " . mysqli_error($conn);
    }
    
    mysqli_close($conn);
}
?>