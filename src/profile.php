<?php 
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: login.php");
   }
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Minni To-Do List</title>
    <link rel="shortcut icon" type="image/png" href="assets/icon.png">
    <!-- Link to Bootstrap stylesheet -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <link rel="stylesheet" href="styles\profilestyles.css"> 
  </head>

    <div class="wrapper">
      <!-- Sidebar  -->
      <nav id="sidebar">
          <div class="sidebar-header">
              <h3>Minni<br>TO-DO List</h3>
          </div>

          <ul class="list-unstyled components">
            <li>
                <a href="index.php">Today</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#pageSubmenu" role="button" data-bs-toggle="collapse" aria-expanded="false">Tasks</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                  <li>
                    <a class="dropdown-item" href="summary.php">Summary</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="status.php">Status</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="category.php">Category</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="progress.html">Progress</a>
                  </li>
                </ul>
            </li>
            <li class="active">
              <a href="profile.php">Settings</a>
            </li>
            <li>
              <a href="about.html">About Us</a>
            </li>
        </ul>
      </nav>

      <!-- Page Content  -->
      <div id="content">

          <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
              <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn btn-light">
                  <div>
                    <i class="fas fa-align-left fa-lg" style="color: darkorange;"></i>
                  </div>
                </button>

                <a href="#" class="navbar-brand">
                  <img class="d=inline-block align-top" src="assets\logo.png"
                  width="75" height="44.5"/>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  </ul>
                </ul>
                <button onclick="openPopup()" type="button" class="btn">
                  <span class="navbar-text">
                    <i class="fa-regular fa-plus fa-xl" style="color: orange;"></i>
                  </span>
                </button>
                <div class="dropdown">
                  <button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="navbar-text">
                      <i class="fas fa-bell fa-lg" style="color: orange;"></i>
                    </span>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notification">
                    <div class="notification-header">
                      <h5 class="text-center">Notification</h5>
                    </div>
                    <div class="notification-content">
                      <div class="notification-list notification-list--priority">
                        <p class="notify"><b>Tutorial Web Programming</b><br>
                          <small>due Today 8 May, 10:00 pm</small>
                        </p>
                      </div>
                      <div class="notification-list notification-list--deadline">
                        <p class="notify"><b>Tutorial ADA</b><br>
                          <small>due Today 8 May, 11:59 pm</small>
                        </p>
                      </div>
                    </div>
                  </ul>
                </div>  
                  <button type="button" class="btn">
                    <li class="nav-item-dropdown">
                      <a href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="navbar-text">
                          <i class="fas fa-user-circle fa-lg" style="color: orange;"></i>
                        </span>
                      </a>
                      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="profile.php">Manage Profile</a></li>
                        <li><a class="dropdown-item" href="php/logout.php">Logout</a></li>
                      </ul>
                    </li>
                  </button>
              </div>
          </nav>

          <body>
            <img src="assets\background.png" class="bg-image">
            <div class="container mx-5">
              <header id="header">
                <h1 style="display: inline-block;"><b> Manage Account</b></h1>
                <?php 
            
            $id = $_SESSION['id'];
            $sql = "SELECT * FROM `entry_details` WHERE `id` = '".$_SESSION['id']."'";
            $query = mysqli_query($conn, $sql);

            while($result = mysqli_fetch_assoc($query)){
                $res_Uname = $result['username'];
                $res_Email = $result['email'];
                // $res_Age = $result['Age'];
                $res_id = $result['id'];
            }
            
            echo "<a href='edit.php?Id=$res_id'>Change Profile</a>";

            // Update username if form is submitted
          if(isset($_POST['update_username'])){
            $newUsername = mysqli_real_escape_string($conn, $_POST['new_username']);
            $id = $_SESSION['id'];
            
            $sql = "UPDATE entry_details SET username='$newUsername' WHERE id='$id'";
            if(mysqli_query($conn, $sql)){
              $_SESSION['username'] = $newUsername;
              echo "<script>
                        alert('Username updated successfully');
                        window.location.href = 'profile.php';
                    </script>";
              exit;
            } else {
              echo "Error updating username: " . mysqli_error($conn);
            }
        }

        if (isset($_POST['new_username'])) {
          $newUsername = mysqli_real_escape_string($conn, $_POST['new_username']);
          $id = $_SESSION['id'];
        
          // Check if the new username already exists in the database
          $checkQuery = "SELECT * FROM entry_details WHERE username = '$newUsername' AND id != '$id'";
          $checkResult = mysqli_query($conn, $checkQuery);
          if (mysqli_num_rows($checkResult) > 0) {
            echo "<script>
                  alert('Username already exists. Please choose a different username.');
                  window.location.href = 'profile.php';
                </script>";
            exit;
          }
        
          $sql = "UPDATE entry_details SET username='$newUsername' WHERE id='$id'";
          if (mysqli_query($conn, $sql)) {
            $_SESSION['username'] = $newUsername;
            echo "<script>
                  alert('Username updated successfully');
                  window.location.href = 'profile.php';
                </script>";
            exit;
          } else {
            echo "Error updating username: " . mysqli_error($conn);
          }
        }
            ?>
              </header>
              <div class="contents">
                <div class="row">
                  <div class="column left">
                    <img src="assets\profile.png" class="profile-image">
                    <div class="input-field">
                      <button onclick="openPhotoPopup()"  type="button"class="submit1">Upload Photo</button>
                  </div>
                  </div>
                    
                  <div class="column right">
                    <h2 style="display: inline-block;"><b>Profile</b></h2>
                    <div class="text">
                      <h4 style="display: inline-block;"><b>Username</b></h4>
                    </div>  
                    <div class="text">
                      <p style="display: inline-block;"><b><?php echo $res_Uname ?></b></p>
                    </div>  
                    <div class="input-field">
                      <button onclick="openUsernamePopup()"  type="button" class="submit2">Change Username</button>
                    </div>
                    <div class="text">
                      <h4 style="display: inline-block;"><b>Email</b></h4>
                    </div>  
                    <div class="text">
                      <p style="display: inline-block;"><b><?php echo $res_Email ?></b></p>
                    </div>  
                  
                  <div class="input-manage">
                    <a href="php/logout.php"><button class="submit3">Logout</button></a>
                  </div>
                  <div class="input-field">
              
                    <button onclick="openEmailPopup()" type="button" class="submit4">Delete Account</button>


                  </div>
                  
                  </div> 
                </div>
              </div>
            </div>

            <div class="overlaymail">
              <div class="popup" id="email-popup">
                <div class="popup-header">
                  <h2>Delete Account</h2>
                </div>
                <form class="dialog">
                  <label class=label for="ChangeEmail">Enter Password</label>
                  <input type="text" class="input" id="ChangeEmail" required>
                  <button type="button" onclick="closeEmailPopup()" class="submit5">Cancel</button>
                  <button type="submit" class="submit5">Save</button>
                </form>
              </div>
            </div>
            <div class="overlay-name">
      <div class="popup" id="username-popup" >
        <div class="popup-header">
          <h2>Change Username</h2>
        </div>
        <form class="dialog" method="POST">
  <label class="label" for="ChangeUsername">New Username</label>
  <input type="text" class="input" id="ChangeUsername" name="new_username" required>
  <button type="button" onclick="closeUsernamePopup()" class="submit5">Cancel</button>
  <button type="submit" class="submit5">Save</button>
</form>

      </div>
    </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script type="text/javascript" src="scripts/profile.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
  </body>
</html>