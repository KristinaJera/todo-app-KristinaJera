<?php
include ('db.php') ;

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
    <div class="header" id="header title">
       <div class="logout">
        <h1>Here are Your Tasks!</h1> 
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

<div class="all_tasks">
<table>
    <tr>
    <th class=" h3">ID</th>
        <th class=" h3">Task</th>
        <th class=" h3">Status</th>
        <th class=" h3">Priority</th>
        <th class=" h3">Due Date</th>
    </tr>
    <?php
// Update your SQL query to include a WHERE clause to filter tasks based on user_id
$sql = "SELECT * FROM table_task WHERE user_id = :user_id";
$stmt = $conn->prepare($sql);

 // Check if preparing the statement was successful
 $No = 1;
if ($stmt) {
    // Bind the user_id parameter
    $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        // Execute the query and insert into the database
        $stmt->execute();
        // Check if there is data in the database
        if ($stmt->rowCount() > 0) {
            // There is data in the database, display in a table
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Getting the data from the database
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
                 </tr>

                <?php
        }
    } else {
        // No Data in Database
        echo '<tr><td colspan="6">No tasks found</td></tr>';
    }
} else {
    // Error in preparing the statement
    echo "Error in preparing the SQL statement.";
}
?>
    </table>
</div>

</body>
</html>

<?php
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