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
    <link rel="stylesheet" href="styles/loginstyle.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
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
                <img src="assets/background.jpg">
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
            <script  src = "scripts/script.js"></script>
        </div>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>      
</body>
</html>

