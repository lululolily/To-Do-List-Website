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
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>