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
    <link rel="stylesheet" href="styles\indexstyles.css">

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
                <li class="active">
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
                  <div class="dropdown-profile">
                    <button type="button" class="btn">
                      <span class="navbar-text">
                        <i class="fas fa-user-circle fa-lg" style="color: orange;"></i>
                      </span>
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
                    </button>
                  </div>   
              </div>
          </nav>

          <body>
            <img src="assets\background.png" class="bg-image">
            <div class="container mx-5">
              <header id="header">
                <h2><b>TO-DO Status</b></h2>
              </header>
              <div class="tab">
                <div class="btn-box">
                  <a href="summary.php"><button><i class="fa-regular fa-clipboard fa-xl"></i>Tasks Summary</button></a>
                  <a href="status.php"><button class="active"><i class="fa-regular fa-clipboard fa-xl"></i>By Status</button></a>
                  <a href="category.php"><button><i class="fa-regular fa-clipboard fa-xl"></i>By Category</button></a>
                  <a href="progress.html"><button><i class="fa-regular fa-bar-chart fa-xl"></i>View Progress</button></a>
              </div>
              <div class="week-container">
                <?php
                  $statusTasks = ['To-Do', 'In Progress', 'Completed'];

                  foreach ($statusTasks as $status) {
                    echo '<div class="status-list">
                            <div class="board">
                              <div class="column col-sm">
                                <h3>'; 
                    if ($status === 'To-Do') {
                      echo '<span class="badge rounded-pill bg-dark">' . $status . '</span>';
                    } elseif ($status === 'In Progress') {
                      echo '<span class="badge rounded-pill bg-secondary">' . $status . '</span>';
                    } elseif ($status === 'Completed') {
                      echo '<span class="badge rounded-pill bg-success">' . $status . '</span>';
                    }
                    echo '</h3>';
                    if (isset($_SESSION['id'])) {
                      $user_id = $_SESSION['id'];
                      $sql = "SELECT * FROM `tasks` WHERE `user_id` = '".$_SESSION['id']."' ORDER BY `datetime` ASC";
                      $result = mysqli_query($conn, $sql);
    
                      while ($row = mysqli_fetch_array($result)) {
                      $categoryClass = "";
                      $statusClass = "";
                      $dateComponent = DateTime::createFromFormat('Y-m-d H:i:s', $row['datetime'])->format('D, j M, g:i a');
        
                      if ($row['status'] === "To-Do") {
                        $statusClass = "badge bg-dark";
                      } else if ($row['status'] === "In Progress") {
                        $statusClass = "badge bg-secondary";
                      } else if ($row['status'] === "Completed") {
                        $statusClass = "badge bg-success";
                      }
        
                      if ($row['category'] === "Priority 1") {
                        $categoryClass = "badge bg-danger";
                      } else if ($row['category'] === "Priority 2") {
                        $categoryClass = "badge bg-info";
                      } else if ($row['category'] === "Priority 3") {
                        $categoryClass = "badge bg-light text-dark";
                      } else if ($row['category'] === "Deadline") {
                        $categoryClass = "badge bg-warning";
                      }
        
                      if ($row['status'] === $status) {
                        echo '<button type="button" class="weeklist" data-bs-toggle="modal" data-bs-target="#editTask'.$row['id'].'">';
                              if ($status === 'To-Do' || $status === 'In Progress') {
                                echo '<h5>'. $row['taskname'] . '</h5>';
                              } elseif ($status === 'Completed') {
                                echo '<h5><s>'. $row['taskname'] . '</s></h5>';
                              }
                              echo '<h6 class="prioritydate" style="display: inline-block;">'.$dateComponent.'</h6>
                              <div class="badges">
                                <p class="'.$categoryClass.'">'.$row['category'].'</p>
                                <p class="'.$statusClass.'">'.$row['status'].'</p>
                              </div>
                              </button>';
                      }
                    }} else {
                      // Handle the case when the user ID is not available in the session
                      echo "<h1>User ID not found in the session.</h1>";
                  }
    
                    echo '<button data-bs-toggle="modal" data-bs-target="#modalPopup" type="button" class="tasks">
                          <i class="fa-regular fa-plus fa-xl" style="color: gray; display: inline-block;"></i>
                          <label class="add mx-3" style="display: inline-block;">Add Task</label>
                          </button>
                        </div>
                      </div>
                    </div>';
                  }
                ?>
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