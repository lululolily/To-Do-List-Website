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
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
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
                  <li>
                    <a class="dropdown-item" href="status.php">Status</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="category.php">Category</a>
                  </li>
                  <li class="active">
                    <a class="dropdown-item" href="progress.php">Progress</a>
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
            <div class="container">
              <header id="header">
                <h2><b>TO-DO Progress</b></h2>
              </header>
              <div class="tab">
                <div class="btn-box">
                    <a href="summary.php"><button><i class="fa-regular fa-clipboard fa-xl"></i>Tasks Summary</button></a>
                    <a href="status.php"><button><i class="fa-regular fa-clipboard fa-xl"></i>By Status</button></a>
                    <a href="category.php"><button><i class="fa-regular fa-clipboard fa-xl"></i>By Category</button></a>
                    <a href="progress.php"><button class="active"><i class="fa-regular fa-bar-chart fa-xl"></i>View Progress</button></a>
                  </div>

              <!--page content-->
              
              <div class = "containerchart">
                    <div class = "text">Tasks completed on time for the past 7 days</div>
                    <div class="chartMenu">
                    </div>
                    <div class="chartCard">
                      <div class="chartBox">
                        <canvas id="myChart"></canvas>
                      </div>
                    </div>

                    <?php
                    
                    if (isset($_SESSION['id'])) {
                        $user_id = $_SESSION['id'];
                        $sql = "SELECT * FROM `tasks` WHERE `user_id` = '".$_SESSION['id']."' ORDER BY `datetime` ASC";
                        $result = mysqli_query($conn, $sql);

                        if ($result) {
                            $completedByDay = array_fill(1, 7, 0); // Initialize an array to store completed tasks count for each day of the week

                            while ($row = mysqli_fetch_assoc($result)) {
                                $date = new DateTime($row["datetime"]);
                                $dayOfWeek = $date->format('N'); // Get the day of the week (1-7)
                                $status = $row["status"];

                                if ($status === "Completed") {
                                    $completedByDay[$dayOfWeek]++;
                                }
                            }
                            mysqli_free_result($result);
                        } else {
                            echo "Error: " . mysqli_error($conn);
                        }
                    } 
                    else {
                      // Handle the case when the user ID is not available in the session
                      echo "<h1>User ID not found in the session.</h1>";
                  }

                    ?>

                    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
                    <script>
                        const daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

                        // setup 
                        const data = {
                            labels: daysOfWeek,
                            datasets: [{
                                label: 'Finished tasks',
                                data: <?php echo json_encode(array_values($completedByDay)); ?>,
                                backgroundColor: 'rgba(0, 0, 0, 0.2)',
                                borderColor: 'rgba(0, 0, 0, 1)',
                                borderWidth: 1
                            }]
                        };

                
                    // config 
                    const config = {
                      type: 'bar',
                      data,
                      options: {
                        indexAxis: 'y',
                        plugins: {
                          legend: {
                            display: false
                          }
                        },
                        scales: {
                          x: {
                            grid: {
                              display: false,
                              drawBorder: false
                            },
                            ticks: {
                              display: false
                            },
                          y: {
                            beginAtZero: true,
                            grid: {
                              display: false,
                              drawBorder: false
                            },
                            ticks: {
                              display: false
                            }
                          }
                        }
                      }
                    }};
                
                    // render init block
                    const myChart = new Chart(
                      document.getElementById('myChart'),
                      config
                    );
                
                    // Instantly assign Chart.js version
                    const chartVersion = document.getElementById('chartVersion');
                    chartVersion.innerText = Chart.version;
                    </script>

                </div>

                <?php
                try {
                  // Fetch user tasks
                  if (isset($_SESSION['id'])) {
                    $user_id = $_SESSION['id'];
                    $sql = "SELECT * FROM `tasks` WHERE `user_id` = '" . $_SESSION['id'] . "' ORDER BY `datetime` ASC";
                    $result = mysqli_query($conn, $sql);
                    
                    // Count completed priority tasks
                    $sqlPriority = "SELECT COUNT(*) FROM tasks WHERE status = 'Completed' AND category LIKE 'priority%' AND user_id = '" . $_SESSION['id'] . "'";
                    $resultPriority = mysqli_query($conn, $sqlPriority);
                    $completedPriorityCount = mysqli_fetch_row($resultPriority)[0];

                    // Count completed deadline tasks
                    $sqlDeadline = "SELECT COUNT(*) FROM tasks WHERE status = 'Completed' AND category = 'deadline' AND user_id = '" . $_SESSION['id'] . "'";
                    $resultDeadline = mysqli_query($conn, $sqlDeadline);
                    $completedDeadlineCount = mysqli_fetch_row($resultDeadline)[0];

                    // Count total priority tasks
                    $sqlTotalPriority = "SELECT COUNT(*) FROM tasks WHERE category LIKE 'priority%' AND user_id = '" . $_SESSION['id'] . "'";
                    $resultTotalPriority = mysqli_query($conn, $sqlTotalPriority);
                    $totalPriorityCount = mysqli_fetch_row($resultTotalPriority)[0];

                    // Count total deadline tasks
                    $sqlTotalDeadline = "SELECT COUNT(*) FROM tasks WHERE category = 'deadline' AND user_id = '" . $_SESSION['id'] . "'";
                    $resultTotalDeadline = mysqli_query($conn, $sqlTotalDeadline);
                    $totalDeadlineCount = mysqli_fetch_row($resultTotalDeadline)[0];

                    $completionPercentagePriority = 0;
                    $completionPercentageDeadline = 0;

                    if ($totalPriorityCount > 0) {
                      $completionPercentagePriority = ($completedPriorityCount / $totalPriorityCount) * 100;
                    }

                    if ($totalDeadlineCount > 0) {
                      $completionPercentageDeadline = ($completedDeadlineCount / $totalDeadlineCount) * 100;
                    }
                  }
                } catch (Exception $e) {
                  // Handle the exception (e.g., display an error message or log the error)
                  echo "An error occurred: " . $e->getMessage();
                }
                ?>

                <div class="containers">
                      <div class="row">
                          <div class="col-md-6">
                              <div class="progress-circular-priority">
                                  <span class="value"><?php echo $completedPriorityCount . '/' . $totalPriorityCount; ?></span>
                              </div>
                              <div class="text">Completed Priority Tasks</div>
                          </div>

                          <div class="col-md-6">
                              <div class="progress-circular-deadline">
                                  <span class="value"><?php echo $completedDeadlineCount . '/' . $totalDeadlineCount; ?></span>
                              </div>
                              <div class="text">Completed Deadline Tasks</div>
                          </div>
                      </div>
                  </div>

                  </div>

                  <script>

                    // Get completion percentages from PHP variables
                    var completionPercentagePriority = <?php echo $completionPercentagePriority; ?>;
                    var completionPercentageDeadline = <?php echo $completionPercentageDeadline; ?>;

                    console.log('Completion Percentage (Priority):', completionPercentagePriority);
                    console.log('Completion Percentage (Deadline):', completionPercentageDeadline);


                    // Circular progress animation for priority
                    let circularProgressPriority = document.querySelector(".progress-circular-priority");
                    let circularProgressDeadline = document.querySelector(".progress-circular-deadline");

                    let priorityStartValue = 0;
                    let priorityEndValue = completionPercentagePriority;
                    let deadlineStartValue = 0;
                    let deadlineEndValue = completionPercentageDeadline;
                    let speed = 10;

                    let priorityProgress = setInterval(() => {
                      priorityStartValue++;
                      circularProgressPriority.style.background = `conic-gradient(#A6FFAF ${priorityStartValue * 3.6}deg, #cfcdcd 0deg)`;

                      if (priorityStartValue >= priorityEndValue) {
                        clearInterval(priorityProgress);
                      }
                    }, speed);

                    let deadlineProgress = setInterval(() => {
                      deadlineStartValue++;
                      circularProgressDeadline.style.background = `conic-gradient(#A6FFAF ${deadlineStartValue * 3.6}deg, #cfcdcd 0deg)`;

                      if (deadlineStartValue >= deadlineEndValue) {
                        clearInterval(deadlineProgress);
                      }
                    }, speed);

                  </script>


              

              </div>
              <!--page content-->
              <div id="popup" class="popup">
                <div class="reminder-form">
                  <div class="header">
                    <h2>Set Task</h2>
                  </div>
                  <div class="dialog">
                  <form id="form" onsubmit="saveReminder(event)">
                    <label for="task-name">Task Name:</label>
                    <input type="text" id="task-name" name="task-name" required>
              
                    <label for="due-date">Set Due Date:</label>
                    <input type="datetime-local" class="date-time" id="date-time" name="date-time" required>
              
                    <label for="category">Category:</label><br>
                    <select class="custom-select" id="category" name="category" required>
                      <option value="">--Select--</option>
                      <option value="Priority" data-icon="fa-solid fa-circle">Priority</option>
                      <option value="Deadline" data-icon="fa-solid fa-circle">Deadline</option>
                    </select><br>
              
                    <label for="status">Status:</label><br>
                    <select class="custom-select" id="status" name="status"  required>
                      <option value="">--Select--</option>
                      <option value="To-Do" data-icon="fa-solid fa-circle">To-Do</option>
                      <option value="In Progress" data-icon="fa-solid fa-circle">In Progress</option>
                      <option value="Completed" data-icon="fa-solid fa-circle">Completed</option>
                    </select><br>
              
                    <button type="button" onclick="closePopup()" class="button">Cancel</button>
                    <button type="submit" class="button">Save</button>
                  </form>
                  </div>
                </div>
              </div>

              <!-- Link to jQuery and Bootstrap JavaScript -->
              <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
              <script type="text/javascript" src="scripts/index.js"></script>
            
              <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
              <script>
                $(document).ready(function() {
                  $('.custom-select').select2({
                    minimumResultsForSearch: Infinity,
                    templateResult: function(data) {
                      var $icon = $(data.element).data('icon');
                      var $text = $(data.element).text();
                      if (!$icon) {
                        return $text;
                      } else {
                        return $('<span><i class="' + $icon + '"></i> ' + $text + '</span>');
                      }
                    },
                    templateSelection: function(data) {
                      var $icon = $(data.element).data('icon');
                      var $text = $(data.element).text();
                      if (!$icon) {
                        return $text;
                      } else {
                        return $('<span><i class="' + $icon + '"></i> ' + $text + '</span>');
                      }
                    }
                  });
                });
            </script>
    </body>

</html>