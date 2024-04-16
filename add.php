<?php
include('db.php');
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

<body>
    <div class="body-add">
    <div class="logout">
            <h1 class="header-add" id="header title">
                Add your tasks easier with ToDo App!</h1>
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
            // Check whether the session is created or not 
            if (isset($_SESSION['add_fail'])) {
                // Display the session message 
                echo $_SESSION['add_fail'];
                // Remove the message after displaying once
                unset($_SESSION['add_fail']);
            }
            ?>
        </p>

        <form method="POST" action="db.php" class="tasks">
            <div class="task">
                <h3 id="task_id" name="task_id"></h3>
            </div>
            <div class="task">
                <h3 class="task-name h3">Task Name</h3>
                <input id="task_name" class="input" name="task_name" type="text" placeholder="Enter a task here" required>

            </div>
            <div class="task">
                <h3 class="task-status h3">Task Status</h3>
                <select id="task_status" class="input-select" name="task_status" placeholder="" required>
                    <option value="">Status</option>
                    <option value="not_started">Not started </option>
                    <option value="in_progress">In progress</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
            <div class="task">
                <h3 class="task-priority h3">Task Priority</h3>
                <select id="task_priority" class="input-select" name="task_priority" placeholder="" required>
                    <option value="">Priority</option>
                    <option value="high">High </option>
                    <option value="medium">Medium</option>
                    <option value="low">Low</option>
                </select>
            </div>
            <div class="task">
                <h3 class="task-duedate h3" > Task Due Date</h3>
                <input id="task_duedate " class="input-date" name="task_duedate" type="date" placeholder="" required>
            </div>
        <div class="task">
             <input class="submit" type="submit" name="submit" value="Save Task">
       </div> 
    </form>
</body>

</html>