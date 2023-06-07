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

if(isset($_POST['add']))
{
    $taskname = $_POST['task-name'];
    $datetime = $_POST['date-time'];
    $category = $_POST['category'];
    $status = $_POST['status'];
    
    $sql_query = "INSERT INTO tasks (taskname,datetime,category,status)
    VALUES ('$taskname','$datetime','$category','$status')";
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
        echo "Error: " . $sql . "" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>