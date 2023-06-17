<?php
$server_name="localhost";
$username="root";
$password="";
$database_name="database1";

/*$conn = mysqli_connect($server_name, $username, $password, $database_name);
if(!$conn)
{
    die("Connection Failed:" . mysqli_connect_error());
}

$errors = [];

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
                echo "<script>alert('Login successful!'); window.location='index.php';</script>";
                exit();
            } else {
                $errors[] = "Wrong Email or password";
            }
        } else {
            $errors[] = "Wrong Email or password";
        }
    
    mysqli_close($conn);
}
// Display error messages as popups
if (!empty($errors)) {
    echo "<script>alert('" . implode("\\n", $errors) . "');window.location='login.html'</script>";

}
?>*/
