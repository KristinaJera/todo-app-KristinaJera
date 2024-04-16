<?php
include ('db.php') ;
// Check whether the task_is is assigned or not 
   if(isset($_GET['task_id'])){
    // UPDATE the task from database
    // Get the list from Database
    $task_id = $_GET['task_id'];
 try{  
    // Write the Query to DELETE a task from Database
  $sql = "SELECT * FROM table_task WHERE task_id= :task_id";
  // Prepare the statement
   $stmt = $conn->prepare($sql);
     // Bind parameters
     $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);
//   Execute The Query
  // Execute the query and insert into the database
  $stmt->execute();

   // Fetch all rows as an associative array
 $task = $stmt->fetch(PDO::FETCH_ASSOC); 
     
} catch (PDOException $e) {
    // Handle PDO exceptions
    echo "Error: " . $e->getMessage();
}
} else {
// Redirect to Update Page
// header('location.href = "update.php";</script>');
// exit; // Make sure to exit after a header redirect
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Indie+Flower&display=swap" rel="stylesheet">
     <title>To Do List!</title>
    </head>
<body > 
      <div class="body-add">
      <div class="logout">
            <h1 class="header-add" id="header title">
           Update easier your list with ToDo App!</h1>
             <a href="logout.php" class="btn-1 btn-warning ">Logout</a>
 </div>  
        <div class="menu">
            <a href="<?php echo SITEURL; ?>home.php">
                <h1>Home</h1>
            </a>
            <a href="<?php echo SITEURL; ?>add.php">
                <h1>Add Task</h1>
            </a>
            <a href="<?php echo SITEURL; ?>manage.php">
                <h1>Manage Tasks</h1>
            </a>
        </div>
        <p class="session-msg-n">
    <?php
    if(isset($_SESSION['update_fail']))
    {
        // Display the session message 
        echo $_SESSION['update_fail'];
        // Remove the message after displaying once
        unset($_SESSION['update_fail']);
        }
        ?>
     </p>
     <form method="POST" action="db.php" class="tasks">
            <div class="task">
                <h3 id="task_id" name="task_id"></h3>
                <input type="hidden" name="task_id" value="<?php echo $task_id; ?>">

           </div>
            <div class="task">
                <h3 class="task-name h3">Task Name</h3>
                <input id="task_name" class="input" value="<?php echo $task['task_name']; ?>" name="task_name" type="text" placeholder="Enter a task here" required>
                  
            </div>
            <div class="task">
                <h3 class="task-status h3">Task Status</h3>
                <select id="task_status"  class="input-select" name="task_status" placeholder="" required>
                            <option value="">Status</option>
                            <option value="not_started" <?php if ($task['task_status'] === 'not_started') echo 'selected'; ?>>Not started</option>
                            <option value="in_progress" <?php if ($task['task_status'] === 'in_progress') echo 'selected'; ?>>In progress</option>
                            <option value="completed" <?php if ($task['task_status'] === 'completed') echo 'selected'; ?>>Completed</option>
                        </select>
            </div>
            <div class="task">
                <h3 class="task-priority h3">Task Priority</h3>
                <select id="task_priority"  class="input-select" name="task_priority" placeholder="" required>
                            <option value="">Priority</option>
                            <option value="high" <?php if ($task['task_priority'] === 'high') echo 'selected'; ?>>High</option>
                            <option value="medium" <?php if ($task['task_priority'] === 'medium') echo 'selected'; ?>>Medium</option>
                            <option value="low" <?php if ($task['task_priority'] === 'low') echo 'selected'; ?>>Low</option>
                        </select>
            </div>
            <div class="task">
                <h3 class="task-duedate h3" > Task Due Date</h3>
                <input id="task_duedate" class="input-date" value="<?php echo $task['task_duedate']; ?>" name="task_duedate" type="date" placeholder="" required>
                    </div>
        <div class="task">
        <input class="submit" type="submit" name="update" value="Save Changes">
       </div> 
    </form>
</body>
</html>