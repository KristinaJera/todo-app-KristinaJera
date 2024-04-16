<?php
include ('db.php');
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
   <style>
       .body {
            /* Other styles */
            box-shadow: 0px 0px <?php echo calculateBoxShadowLength(); ?>px 10px rgba(0, 0, 0, 0.5);
       }
   </style>
</head> 
<body style="height: <?php echo calculateBodyHeightH(); ?>vh;">
<div class="body" >
    <div class="header" id="header title">
    <div class="logout">
         <h1>Manage your tasks easier with ToDo App!</h1>
        <a href="logout.php" class="btn-1 btn-warning ">Logout</a>
   </div>  
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
    
<p class="session-msg-p">
<?php
$No = 1; // Add this line to initialize $No
    // Check whether the session is created or not 
    if(isset($_SESSION['add']))
    {
        // Display the session message 
        echo $_SESSION['add'];
        // Remove the message after displaying once
        unset($_SESSION['add']);
        }
        // Check the Session for Delete
        if(isset($_SESSION['delete'])){
            // Display the session message 
        echo $_SESSION['delete'];
        // Remove the message after displaying once
        unset($_SESSION['delete']);
        }

        if(isset($_SESSION['update']))
        {
            // Display the session message 
            echo $_SESSION['update'];
            // Remove the message after displaying once
            unset($_SESSION['update']);
            }
            ?>
            </p>
            <p class="session-msg-n">
<?php
        // Check the Session for Delete Fail
        if(isset($_SESSION['delete_fail'])){
            // Display the session message 
        echo $_SESSION['delete_fail'];
        // Remove the message after displaying once
        unset($_SESSION['delete_fail']);
        
        }
        ?>
   </p>
   <div class="all_tasks">
    <table>
        <!-- Your table header -->
        <tr>
        <th class=" h3">ID</th>
        <th class=" h3">Task</th>
        <th class=" h3">Status</th>
        <th class=" h3">Priority</th>
        <th class=" h3">Due Date</th>
    <th class=" h3">Action</th>
    </tr>
        <?php
      // Update your SQL query in manage.php to include a WHERE clause to filter tasks based on user_id
$sql = "SELECT * FROM table_task WHERE user_id = :user_id";
$stmt = $conn->prepare($sql);

   
// Check if preparing the statement was successful
if ($stmt) {
    // Bind the user_id parameter
    $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);

    // Execute the query and insert into the database
    $stmt->execute();

            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $task_id = $row['task_id'];
                    $task_name = $row['task_name'];
                    $task_status = $row['task_status'];
                    $task_priority = $row['task_priority'];
                    $task_duedate = $row['task_duedate'];
                    ?>

                    <tr>
                        <td><?php echo $No++; ?></td>
                        <td><?php echo $task_name; ?></td>
                        <td><?php echo $task_status; ?></td>
                        <td><?php echo $task_priority; ?></td>
                        <td><?php echo $task_duedate; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>update.php?task_id=<?php echo $task_id; ?>" class="update">Update</a>
                            <a href="<?php echo SITEURL; ?>delete.php?task_id=<?php echo $task_id; ?>" class="delete">Delete</a>
                        </td>
                    </tr>

                    <?php
                }
            } else {
                echo '<tr><td colspan="6">No tasks found</td></tr>';
            }
        } else {
            echo "Error in preparing the SQL statement.";
        }
        ?>
    </table>
</div>

</body>
</html>

<?php
// Function to calculate the height of the .body container based on the number of tasks
function calculateBoxShadowLength() {
    global $conn;
    
    $sql = "SELECT COUNT(*) as task_count FROM table_task";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Calculate box shadow length based on the number of tasks
        $taskCount = $result['task_count'];
    } else {
        // Handle the error if needed
        return 0; // Default box shadow length if there is an error
    }
}


function calculateBodyHeightH() {
    global $conn;
    
    $sql = "SELECT COUNT(*) as task_count FROM table_task";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Calculate height based on the number of tasks
        $taskCount = $result['task_count'];
    } else {
        // Handle the error if needed
        return 0; // Default height if there is an error
    }
}
// Check if the form is submited or not.
if(isset($_POST['submit'])){
   
}
else{
   
}
// Check if there is data in the result set
        if ($stmt->rowCount() > 0) {
     // Count the rows of data in database
       $count_rows = $stmt->rowCount();
// Check whether there is data in database or not
if($count_rows>0){
// There is a data in database, Display in table
}}
else{
    // No Data in Database
}
?> 