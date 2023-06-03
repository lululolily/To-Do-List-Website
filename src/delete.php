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

if(isset($_POST['delete'])) {
    $id = $_POST['id'];
    
    $sql_query = "DELETE FROM tasks WHERE id='$id'";
    
    if (mysqli_query($conn, $sql_query)) {
        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    
    mysqli_close($conn);
}
?>