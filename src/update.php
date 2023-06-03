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

if(isset($_POST['update']))
{
    $id = $_POST['id'];
    $taskname = $_POST['task-name'];
    $datetime = $_POST['date-time'];
    $category = $_POST['category'];
    $status = $_POST['status'];
    
    $sql_query = "UPDATE tasks SET `taskname`='$taskname', `datetime`='$datetime',`category`='$category', `status`='$status' WHERE id='$id'"; 
    if (mysqli_query($conn, $sql_query)) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql_query . "" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>