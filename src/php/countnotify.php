<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
    if (isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];
        $sql = "SELECT * FROM `tasks` WHERE `user_id` = '".$_SESSION['id']."' ORDER BY `datetime` ASC";
        include("config.php");
        $result = mysqli_query($conn, $sql);
        $count = 0;

        while ($row = mysqli_fetch_array($result)) {
            $dateComponent = DateTime::createFromFormat('Y-m-d H:i:s', $row['datetime'])->format('D, j M, g:i a');
            $dueDateTime = strtotime($row['datetime']);
            $currentDateTime = time();
            date_default_timezone_set('Asia/Kuala_Lumpur'); // Set the timezone to Kuala Lumpur
            $isCompleted = $row['status'] === 'Completed';
            if (!$isCompleted) {
                $timeDifference = $dueDateTime - $currentDateTime;
                if ($row['category'] === 'Priority 1' && $timeDifference < 259200) {
                    $count++;
                } 
                if ($row['category'] === 'Priority 2' && $timeDifference < 172800) {
                    $count++;
                } 
                if ($row['category'] === 'Priority 3' && $timeDifference < 43200) {
                    $count++;
                } 
                if ($row['category'] === 'Deadline' && $timeDifference < 86400) {
                    $count++;
                }
            }
        }
        if($count != 0){
            echo '<sup><span class="badge rounded-pill bg-danger">'.$count.'</span></sup>';
        }
    }
?>
