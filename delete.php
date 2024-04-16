<?php
include ('db.php') ;
// Check whether the task_is is assigned or not 
if(isset($_GET['task_id'])){
    // Delete the task from database
    // Get the list from Database
    $task_id = $_GET['task_id'];
 try{  
     $sql = "SELECT * FROM table_task";
    // Write the Query to DELETE a task from Database
  $sql = "DELETE FROM table_task WHERE task_id = :task_id";
 
  // Prepare the statement
   $stmt = $conn->prepare($sql);
    // Bind parameters
     $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);

   //   Execute The Query
  // Execute the query and insert into the database
  $stmt->execute();

    
    // Check if the delete operation was successful
    if ($stmt->rowCount() > 0) {
        // Create a SESSION Variable to Display message
        $_SESSION['delete'] = "Task Deleted Successfully";
        // Redirect to another page after successful deletion
        header('location: ' . SITEURL . 'manage.php');
     exit; // Make sure to exit after a header redirect
    } else {
        // Create a SESSION Variable to Display message
        $_SESSION['delete_fail'] = "Failed to delete Task";
        // Redirect to Update Page
       header('location: ' . SITEURL . 'manage.php');
        exit; // Make sure to exit after a header redirect
    }
} catch (PDOException $e) {
    // Handle PDO exceptions
    echo "Error: " . $e->getMessage();
}
//   header('location: ' . SITEURL . 'manage.php');
//    exit;
} else {
// Redirect to Update Page
// header('location: ' . SITEURL . 'update.php');
// exit;
}

?>
