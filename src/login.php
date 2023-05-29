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

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM entry_details WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if ($stmt_result->num_rows > 0) {
            $data = $stmt_result->fetch_assoc();
            if ($data['password'] === $password) {
                header("Location: index.html");
                exit();
            } else {
                echo "<h2>Invalid Email or password</h2>";
            }
        } else {
            echo "<h2>Invalid Email or password</h2>";
        }
    
    mysqli_close($conn);
}

?>
