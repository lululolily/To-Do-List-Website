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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
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
                    <a class="dropdown-item" href="progress.php">Progress</a>
                  </li>
                </ul>
            </li>
            <li class="active">
              <a href="profile.php">Settings</a>
            </li>
            <li>
            <a href="about.php">About Us</a>
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
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modalPopup">
                    <span class="navbar-text">
                      <i class="fa-regular fa-plus fa-xl" style="color: orange;"></i>
                    </span>
                </button>
                <div class="dropdown">
                    <button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                      <span class="navbar-text">
                        <i class="fas fa-bell fa-lg" id="taskCount" style="color: orange;"><?php include("php/countnotify.php")?></i>
                      </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notification">
                      <div class="notification-header">
                        <h5 class="text-center">Notification</h5>
                      </div>
                      <div class="notification-content" id="taskContainer">
                      <?php
                        include("php/notification.php")
                      ?>
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
                        <li>
                          <a class="dropdown-item" href="#" onclick="confirmLogout()">Logout</a>
                        </li>

                        <script>
                          function confirmLogout() {
                            var confirmLogout = confirm("Are you sure you want to log out?");
                            if (confirmLogout) {
                              window.location.href = "php/logout.php";
                            } else {
                              // User cancelled logout, do nothing or perform any other action
                            }
                          }
                        </script>
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
            $sql = "SELECT * FROM `users` WHERE `id` = '".$_SESSION['id']."'";
            $query = mysqli_query($conn, $sql);

            while($result = mysqli_fetch_assoc($query)){
                $res_Uname = $result['username'];
                $res_Email = $result['email'];
                $res_id = $result['id'];
                $res_photo = $result['profile_photo'];
            }
            if(isset($_POST['upload_photo'])){
              $newPhoto = mysqli_real_escape_string($conn, $_POST['new_photo']);
              $id = $_SESSION['id'];

              $sql = "UPDATE users SET profile_photo='$newPhoto' WHERE id='$id'";
              if(mysqli_query($conn, $sql)){
                $_SESSION['profile_photo'] = $newPhoto;
                echo "<script>
                          alert('Photo uploaded successfully');
                          window.location.href = 'profile.php';
                      </script>";
                exit;
              } else {
                echo "Error uploading photo: " . mysqli_error($conn);
              }
          }

            // Update username if form is submitted
          if(isset($_POST['update_username'])){
            $newUsername = mysqli_real_escape_string($conn, $_POST['new_username']);
            $id = $_SESSION['id'];
            
            $sql = "UPDATE users SET username='$newUsername' WHERE id='$id'";
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
          $checkQuery = "SELECT * FROM users WHERE username = '$newUsername' AND id != '$id'";
          $checkResult = mysqli_query($conn, $checkQuery);
          if (mysqli_num_rows($checkResult) > 0) {
            echo "<script>
                  alert('Username already exists. Please choose a different username.');
                  window.location.href = 'profile.php';
                </script>";
            exit;
          }
        
          $sql = "UPDATE users SET username='$newUsername' WHERE id='$id'";
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


        if (isset($_POST['update_password'])) {
          $currentPassword = mysqli_real_escape_string($conn, $_POST['current_password']);
          $newPassword = mysqli_real_escape_string($conn, $_POST['new_password']);
          $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirm_password']);
          $id = $_SESSION['id'];
      
          // Retrieve current password from the database
          $retrievePasswordQuery = "SELECT password FROM users WHERE id='$id'";
          $result = mysqli_query($conn, $retrievePasswordQuery);
          if ($row = mysqli_fetch_assoc($result)) {
              $currentPasswordFromDB = $row['password'];
      
              // Verify current password
              if ($currentPassword !== $currentPasswordFromDB) {
                  echo "<script>alert('Incorrect current password. Please try again.');
                  window.location.href = 'profile.php';
                  </script>";
                  exit;
              }
          }

          if ($newPassword === $currentPassword) {
            echo "<script>alert('New password same as old password.');
            window.location.href = 'profile.php';
            </script>";
            exit;
        }
      
          // Password Length Validation
          if (strlen($newPassword) < 8) {
              echo "<script>alert('New password should be at least 8 characters long.');
              window.location.href = 'profile.php';
              </script>";
              exit;
          }
      
          // Password and Confirm Password Matching Validation
          if ($newPassword !== $confirmPassword) {
              echo "<script>alert('New password and confirm password do not match.');
              window.location.href = 'profile.php';
              </script>";
              exit;
          }
      
          // Update the password in the database
          $updatePasswordQuery = "UPDATE users SET password='$newPassword' WHERE id='$id'";
          if (mysqli_query($conn, $updatePasswordQuery)) {
              $_SESSION['password'] = $newPassword;
              echo "<script>
                      alert('Password reset successful');
                      window.location.href = 'profile.php';
                    </script>";
              exit;
          } else {
              echo "Error updating password: " . mysqli_error($conn);
          }
      }

      if (isset($_POST['confirm'])) {
        $Password = mysqli_real_escape_string($conn, $_POST['password']);
        $id = $_SESSION['id'];

        $retrievePasswordQuery = "SELECT password FROM users WHERE id='$id'";
        $result = mysqli_query($conn, $retrievePasswordQuery);
        if ($row = mysqli_fetch_assoc($result)) {
            $currentPasswordFromDB = $row['password'];

            if ($Password !== $currentPasswordFromDB) {
                echo "<script>alert('Incorrect password. Please try again.');
                window.location.href = 'profile.php';
                </script>";
                exit;
            }
        }

        

        $userId = $_SESSION['id'];

        // Delete associated tasks
        $deleteTasksQuery = "DELETE FROM tasks WHERE `user_id` = '$userId'";
        if (!mysqli_query($conn, $deleteTasksQuery)) {
            echo "Error deleting associated tasks: " . mysqli_error($conn);
            exit;
        }
        
        // Delete users
        $deleteQuery = "DELETE FROM users WHERE `id` = '$userId'";
        if (mysqli_query($conn, $deleteQuery)) {
            $_SESSION['password'] = $Password;
            session_unset();
            session_destroy();
            echo "<script>
                    alert('Account deleted successfully!');
                    window.location.href = 'login.php';
                  </script>";
            exit;
        } else {
            echo "Account deletion failed. Please try again. " . mysqli_error($conn);
        }
      }        

      ?>
   
              </header>
              <div class="contents">
                <div class="row">
                  <div class="column left">
                  <?php
                        // Assuming $res_filename contains the filename of the uploaded photo
                        if (isset($res_photo)) {
                          echo '<img src="uploads/' . $res_photo . '" class="profile-image" alt="">';
                        } else {
                          echo '<img src="assets/profile.png" class="profile-image" alt="">';
                        }
                        ?>
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
                      <button class="submit3" onclick="openPasswordPopup()" type="button">Reset Password</button>
                    </div>
                  
                    <div class="input-manage">
                      <button class="submit3" onclick="confirmLogout()">Logout</button>
                    </div>

                    <script>
                      function confirmLogout() {
                        var confirmLogout = confirm("Are you sure you want to log out?");
                        if (confirmLogout) {
                          window.location.href = "php/logout.php";
                        } else {
                          // User cancelled logout, do nothing or perform any other action
                        }
                      }
                    </script>
                    <div class="input-field">
                      <button onclick="openEmailPopup()" type="button" class="submit4">Delete Account</button>
                    </div>
                  </div> 
                </div>
              </div>
            </div>
            <div class="overlay-pfp">
              <div class="popup" id="photo-popup">
                <div class="popup-header">
                  <h2>Upload Profile Picture</h2>
                </div>
                <form action="upload.php" method="POST" enctype="multipart/form-data">
                  <label class="label" for="Password">New Profile Picture</label>
                  <input type="file" id="photo" class="filebox" name="photo" required>
                  <button type="button" onclick="closePhotoPopup()" class="submit5">Cancel</button>
                  <input type="hidden" name="uploaded_photo" id="uploaded_photo">
                  <button type="submit" name="upload_photo" class="submit5">Upload</button>
                </form>
              </div>
            </div>
            <div class="overlaymail">
              <div class="popup" id="email-popup">
                <div class="popup-header">
                  <h2>Delete Account</h2>
                </div>
                <form class="dialog" method="POST" >
                  <label class="label" for="Password">Enter Password</label>
                  <input type="password" class="input" id="Password" name="password" required>
                  <button type="button" onclick="closeEmailPopup()" class="submit5">Cancel</button>
                  <button type="submit" name="confirm" class="submit5">Confirm</button>
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
        <div class="overlaypass">
          <div class="popup" id="password-popup">
              <div class="popup-header">
                  <h2>Change Password</h2>
              </div>
              <form class="dialog" method="POST">
                  <label class="label" for="CurrentPassword">Current Password</label>
                  <input type="password" class="input" id="CurrentPassword" name="current_password" required>
                  <label class="label" for="NewPassword">New Password</label>
                  <input type="password" class="input" id="NewPassword" name="new_password" required>
                  <label class="label" for="ConfirmPassword">Confirm Password</label>
                  <input type="password" class="input" id="ConfirmPassword" name="confirm_password" required>
                  <button type="button" onclick="closePasswordPopup()" class="submit5">Cancel</button>
                  <button type="submit" name="update_password" class="submit5">Save</button>
              </form>
          </div>
        </div>
        <?php
          include("php/addTask.php");
        ?>
        <script>
          // JavaScript code to update the hidden input field with the selected photo file name
          const photoInput = document.getElementById('photo');
          const uploadedPhotoInput = document.getElementById('uploaded_photo');

          photoInput.addEventListener('change', (event) => {
            const selectedFile = event.target.files[0];
            uploadedPhotoInput.value = selectedFile.name;
          });
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script type="text/javascript" src="scripts/profile.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

  </body>
</html>
