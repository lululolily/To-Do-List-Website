<?php 
      session_start();

      if (isset($_SESSION['valid'])) {
       // User is already logged in, redirect to index.php
       header("Location: index.php");
       exit;
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loginstyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>Login</title>
</head>
<body>
<div class="wrapper">
        <div class="container main">
            <div class="row">
            <?php 
             
             include("php/config.php");
             if(isset($_POST['submit'])){
               $email = mysqli_real_escape_string($conn,$_POST['email']);
               $password = mysqli_real_escape_string($conn,$_POST['password']);

               $result = mysqli_query($conn,"SELECT * FROM users WHERE email='$email' AND password='$password' ") or die("Select Error");
               $row = mysqli_fetch_assoc($result);

               if(is_array($row) && !empty($row)){
                   $_SESSION['valid'] = $row['email'];
                   $_SESSION['username'] = $row['username'];
                   // $_SESSION['age'] = $row['Age'];
                   $_SESSION['id'] = $row['id'];
                   echo "<script>
                       alert('Successful login! Click OK to continue');
                       window.location.href = 'index.php';
                   </script>";
                   exit;
               }else{
                echo "<script>
                       alert('Wrong Username or Password');
                       window.location.href = 'login.php';
                   </script>";
                   exit;
        
               }
               if(isset($_SESSION['valid'])){
                   
                   header("Location: profile.php");
               }
             }else{

             }
           ?>
                <div class="col-md-6 side-image">
                    <img src="images/white.png" alt="">
                </div>
                <div class="col-md-6 right">
                     <div class="input-box">
                        <header>WELCOME TO MINNI TO-DO-LIST</header>
            <form id = "login-form" action="" method="post">
                <div class="input-field">
                    <input type="text" class="input" name="email" id="email" placeholder="Email" autocomplete="off" required>
                    <label for="email"></label>
                </div>
               <div class="input-field">
                  <input type="password" class="input" name="password" id="password"  placeholder="Password" autocomplete="off" required>
                   <label for="password"></label>
                  </div>
               <div class="input-field">
                   <input type="submit" class="submit" name="submit" value="Login" required >
                </div> 
                <div class="links">
                    Don't have account? <a href="register.php">Sign Up Now</a>
                </div>
            </form>
            <script  src = "script.js"></script>
        </div>
      </div>      
</body>
</html>

