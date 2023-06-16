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
    <script>
      function updateDate() {
        var currentDate = new Date();
      
        var dayOptions = { weekday: 'long' };
        var day = currentDate.toLocaleDateString('en-MY', dayOptions);

        var dateOptions = { day: 'numeric', month: 'long' };
        var date = currentDate.toLocaleDateString('en-MY', dateOptions);

        var dayElement = document.getElementById("day");
        dayElement.innerHTML = day;

        var dateElement = document.getElementById("date");
        dateElement.innerHTML = date;
      }
      setInterval(updateDate, 10);
    </script>
  </head>

    <div class="wrapper">
      <nav id="sidebar">
        <div class="sidebar-header">
            <h3>Minni<br>TO-DO List</h3>
        </div>

        <ul class="list-unstyled components">
          <li class="active">
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
                  <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modalPopup">
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
                  <div class="dropdown-profile">
                    <button type="button" class="btn">
                      <span class="navbar-text">
                        <i class="fas fa-user-circle fa-lg" style="color: orange;"></i>
                      </span>
                      <div class="dropdown-content-profile">
                        <a href="profile.php">Manage Profile</a>
                        <a href="logout.html">Logout</a>
                      </div>
                    </button>
                    
                  </div>               
                  
              </div>
          </nav>

          <body>
            <img src="assets\background.png" class="bg-image">
            <div class="container mx-5">
              <header id="header">
                <h1 style="display: inline-block;"><b>Today</b></h1>
                <h6 class=date style="display: inline-block;">&nbsp <span id="date"></span></h6>
              </header>
              <div class="board">
                <h3><span id="day"></span></h3>

                <div class="column col-sm">
                <?php
                if (isset($_SESSION['id'])) {
                    $user_id = $_SESSION['id'];
                    $sql = "SELECT * FROM `tasks` WHERE `user_id` = '".$_SESSION['id']."' ORDER BY `datetime` ASC";
                    $result = mysqli_query($conn, $sql);
                    $tasks = array();                    
                    
                    while ($row = mysqli_fetch_array($result)) {
                        $categoryClass = "";
                        $statusClass = "";
                        $dateComponent = DateTime::createFromFormat('Y-m-d H:i:s', $row['datetime'])->format('Y-m-d');
                        $dayComponent = DateTime::createFromFormat('Y-m-d H:i:s', $row['datetime'])->format('D, j M, g:i a');
                        date_default_timezone_set('Asia/Kuala_Lumpur');
                        $today = date("Y-m-d"); 
                    
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
                    
                        if ($dateComponent === $today) {
                            $task = array(
                                'taskname' => $row['taskname'],
                                'dayComponent' => $dayComponent,
                                'categoryClass' => $categoryClass,
                                'statusClass' => $statusClass,
                                'category' => $row['category'],
                                'status' => $row['status'],
                                'id' => $row['id']
                            );
                            $tasks[] = $task;
                        }
                    }
                    
                    // Sort tasks based on completion status (non-completed tasks above completed tasks)
                    usort($tasks, function($a, $b) {
                        if ($a['status'] === 'Completed' && $b['status'] !== 'Completed') {
                            return 1;
                        } else if ($a['status'] !== 'Completed' && $b['status'] === 'Completed') {
                            return -1;
                        }
                        return 0;
                    });
                    
                    // Display the sorted tasks
                    foreach ($tasks as $task) {
                        echo '<div class="task d-flex flex-column">';
                        if ($task['status'] === 'Completed') {
                            echo '<h5><s>' . $task['taskname'] . '</s></h5>';
                        } else {
                            echo '<h5>' . $task['taskname'] . '</h5>';
                        }
                        echo '<h6 class="prioritydate">' . $task['dayComponent'] . '</h6>
                                  <div>
                                    <p class="' . $task['categoryClass'] . '">' . $task['category'] . '</p>
                                    <p class="' . $task['statusClass'] . '">' . $task['status'] . '</p>
                                  </div>
                                  <button type="button" class="edit-button" data-bs-toggle="modal" data-bs-target="#editTask' . $task['id'] . '">
                                    <i class="fa-solid fa-pen fa-sm"></i>
                                  </button>
                              </div>';
                    }} else {
                      // Handle the case when the user ID is not available in the session
                      echo "<h1>User ID not found in the session.</h1>";
                  }
                    
                  ?>
                  <button data-bs-toggle="modal" data-bs-target="#modalPopup" type="button" class="add-task">
                      <i class="fa-regular fa-plus fa-xl" style="color: gray; display: inline-block;"></i>
                      <label class="add mx-3" style="display: inline-block;">Add Task</label>
                  </button>
                </div>
              </div>
            </div>

            <?php
              $sql = "SELECT * FROM `tasks`";
              $result = mysqli_query($conn, $sql);
              while($row = mysqli_fetch_array($result)){
            ?>
            <div class="modal fade" id="editTask<?php echo $row['id'];?>" tabindex="-1" aria-labelledby="editTask" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-3" id="editTask">Manage task</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="update.php" method="post">
                  <div class="modal-body">
                    <label for="task-name">Task Name:</label>
                    <input type="text" id="task-name" name="task-name" value="<?php echo $row['taskname']; ?>" required>
            
                    <label for="due-date">Set Due Date:</label>
                    <input type="datetime-local" class="date-time" id="date-time" value="<?php echo $row['datetime']; ?>"
                    name="date-time" min="<?php echo date('Y-m-d\TH:i'); ?>"  required>
            
                    <label for="category">Category:</label><br>
                    <select class="form-select" id="category" name="category" required>
                      <option selected value="<?php echo $row['category'];?>"><?php echo $row['category'];?></option>
                      <option value="" disabled>--Select--</option>
                      <option value="Priority 1">Priority 1</option>
                      <option value="Priority 2">Priority 2</option>
                      <option value="Priority 3">Priority 3</option>
                      <option value="Deadline">Deadline</option>
                    </select>
            
                    <label for="status">Status:</label><br>
                    <select class="form-select" id="status" name="status" required>
                      <option selected value="<?php echo $row['status'];?>"><?php echo $row['status'];?></option>
                      <option value="" disabled>--Select--</option>
                      <option value="To-Do">To-Do</option>
                      <option value="In Progress">In Progress</option>
                      <option value="Completed">Completed</option>
                    </select>
                  </div>
                  <div class="modal-footer">
                    <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                    <button type="submit" class="btn btn-success" name="update">Save changes</button>
                    </form>
                    <form action="delete.php" method="post">
                      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                      <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <?php
              }
            ?>
            <div class="modal fade" id="modalPopup" tabindex="-1" aria-labelledby="addTask" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-3" id="addTask">Set task</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                  <form action="task.php" method="post">
                    <label for="task-name">Task Name:</label>
                    <input type="text" id="task-name" name="task-name" required>
            
                    <label for="due-date">Set Due Date:</label>
                    <input type="datetime-local" class="date-time" id="date-time" name="date-time" min="<?php echo date('Y-m-d\TH:i'); ?>" required>

                    <label for="category">Category:</label><br>
                    <select class="form-select" id="category" name="category" required>
                      <option value="" disabled selected>--Select--</option>
                      <option value="Priority 1">Priority 1</option>
                      <option value="Priority 2">Priority 2</option>
                      <option value="Priority 3">Priority 3</option>
                      <option value="Deadline">Deadline</option>
                    </select>
            
                    <label for="status">Status:</label><br>
                    <select class="form-select" id="status" name="status" required>
                      <option value="" disabled selected>--Select--</option>
                      <option value="To-Do">To-Do</option>
                      <option value="In Progress">In Progress</option>
                      <option value="Completed">Completed</option>
                    </select>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="add">Save</button>
                  </div>
                </div>
              </div>
            </div>
            
    <!-- Link to jQuery and Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script type="text/javascript" src="scripts/index.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
  </body>
</html>
