<?php
  include("php/config.php");
  session_start();

  // Check if the user is logged in (optional)
  if (!isset($_SESSION['valid'])) {
    // Redirect the user to the login page or handle the unauthorized access
    header("Location: login.php");
    exit; // Make sure to exit after redirection
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
    <link rel="stylesheet" href="styles\aboutstyles.css">
    
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
            <li>
              <a href="profile.php">Settings</a>
            </li>
            <li class="active">
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
                  <div class="dropdown-profile" style="float:right;">
                    <button type="button" class="btn">
                      <span class="navbar-text">
                        <i class="fas fa-user-circle fa-lg" style="color: orange;"></i>
                      </span>
                    </button>
                    <div class="dropdown-content-profile">
                      <a href="profile.php">Manage Profile</a>
                      <a href="#" onclick="confirmLogout()">Logout</a>

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
                    </div>
                  </div>
              </div>
          </nav>

          <body>
            <img src="assets\background.png" class="bg-image">
            <div class="container mx-5">
              <header id="header">
                <h1 style="display: inline-block;"><b>About us</b></h1>
              </header>
                <div class="column col-sm">
                  <div class="task d-flex flex-column">
                    <div class="text">
                        <p> <strong> To-do list </strong> list apps are digital tools designed to help individuals or teams manage their <strong>daily tasks, goals, and projects. </strong> These apps provide a user-friendly interface for <strong> creating, organizing, and tracking</strong>  various types of tasks, including one-time activities, recurring tasks, and long-term goals.<i></i></p>
                    </div>
                    <h5>
                    </h5>
                      <p>
                        Most <strong> to-do list </strong>  apps offer features such as <strong>task prioritization, due dates, reminders, note-taking, categorization, and collaboration. </strong>  Users can also customize their 
                        <strong> to-do lists </strong>  by adding tags, labels, colors, or other visual elements to make their tasks more visually appealing and easier to navigate.
                      </p>

                        <div style="text-align: center;">
                            <img src="assets/tips.png" alt="todolist"  width="350" height="350"  >
                        </div>
                      
                        <div>
                        <footer>
                          <p>&copy; 2023 Minni Studio. All rights reserved.</p>
                          <p>Contact: <a href="mailto:your-email@example.com">minnistudio@um.com</a></p>
                        </footer>
                        </div>
                  </div>
                </div>
              </div>
            </div>
            <?php
            include("php/addTask.php");
            ?>
            <!-- Link to jQuery and Bootstrap JavaScript -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script type="text/javascript" src="scripts/index.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
  </body>
</html>