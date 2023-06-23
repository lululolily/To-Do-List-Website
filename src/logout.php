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
    <title>Minni To-Do List</title>
    <link rel="shortcut icon" type="image/png" href="assets/icon.png">
    <link rel="stylesheet" href="styles/logoutstyles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    
</head>
<body>
    <div class="wrapper">
        <div class="container main">
            <div class="row">
                <div class="col-md-6">
                    <img src="assets\bglogout1.png" class="side-image">
                    <div class="text">
                        <p>You are the one who should be the pilot of your time<i></i></p>
                    </div>
                </div>
                <div class="col-md-6 right">
                     <div class="input-box">
                        <header>You have successfully logged out!</header>
                        <div class="tq">
                            <p>Thank you</p>
                        </div>
                        <div class="input-field">
                            <a href="login.php"><input type="submit" class="submit" value="Back to Log In"></a>
                        </div>

                     </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>