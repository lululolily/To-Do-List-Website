<?php
?>

<!DOCTYPE html>
<html>
    <body>
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
              name="date-time" min="<?php echo date('Y-m-d'); ?>"  required>
      
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
    </body>
</html>
<?php
?>