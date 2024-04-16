<?php
session_start();
define('DB_SERVER', 'db');
define('DB_USERNAME', 'mariadb');
define('DB_PASSWORD', 'mariadb');
define('DB_NAME', 'mariadb');
define('SITEURL', 'http://localhost/');
try {
  $conn = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  error_log("Connection failed: " . $e->getMessage());
  // Redirect to an error page or display a generic error message
  exit;
}

// Check if form is submitted
if (isset($_POST['submit'])) {

  // Using the ternary operator to set $task_id or null
  $task_id = isset($_POST['task_id']) ? $_POST['task_id'] : null; 
  // countinue get form data 
  $task_name = $_POST['task_name'];
  $task_status = $_POST['task_status'];
  $task_priority = $_POST['task_priority'];
  $task_duedate = $_POST['task_duedate'];
  $taskuser_id = $_SESSION['user_id'];

 
 // SQL Query to insert data into the database
 $sql = "INSERT INTO table_task (task_name, task_status, task_priority, task_duedate, user_id) 
         VALUES (:task_name, :task_status, :task_priority, :task_duedate, :user_id)";


  // Prepare the statement
  $stmt = $conn->prepare($sql);

  // Bind parameters

  $stmt->bindParam(':task_name', $task_name, PDO::PARAM_STR);
  $stmt->bindParam(':task_status', $task_status, PDO::PARAM_STR);
  $stmt->bindParam(':task_priority', $task_priority, PDO::PARAM_STR);
  $stmt->bindParam(':task_duedate', $task_duedate, PDO::PARAM_STR);
  $stmt->bindParam(':user_id', $taskuser_id, PDO::PARAM_INT);

  // Execute the query and insert into the database
  $stmt->execute();
  
  if ($stmt->rowCount() > 0) {
      //    Create a SESSION Variable to Display message
      $_SESSION['add'] = "List Added Successfully";
      //     // Redirect to Update Page  
       header('location: ' . SITEURL . 'manage.php');
        exit; // Make sure to exit after a header redirect
  
  } else {
      //    Create a SESSION Variable to Display message
      $_SESSION['add_fail'] = "Failed to Add List";
      //  // Redirect to Update Page
      header('location: ' . SITEURL . 'add.php');
     exit; // Make sure to exit after a header redirect
  }
}
else {
// Handle the case where task_name is NULL
// echo "Task name cannot be NULL";
}

// Check whether the Update is Clickes or not
if(isset($_POST['update'])){
    // Using the ternary operator to set $task_id or null
    $task_id = isset($_POST['task_id']) ? $_POST['task_id'] : null; 
  // Get the Updated Values from our form 
  $task_name = $_POST['task_name'];
  $task_status = $_POST['task_status'];
  $task_priority = $_POST['task_priority'];
  $task_duedate = $_POST['task_duedate'];

   // SQL Query to update data into database
  $sql = "UPDATE table_task SET
              task_name = :task_name,
              task_status = :task_status,
              task_priority = :task_priority,
              task_duedate = :task_duedate
              WHERE task_id = :task_id";

// Prepare the statement
$stmt2 = $conn->prepare($sql);

  // Bind parameters
  $stmt2->bindParam(':task_id', $task_id, PDO::PARAM_INT);
  $stmt2->bindParam(':task_name', $task_name, PDO::PARAM_STR);
  $stmt2->bindParam(':task_status', $task_status, PDO::PARAM_STR);
  $stmt2->bindParam(':task_priority', $task_priority, PDO::PARAM_STR);
  $stmt2->bindParam(':task_duedate', $task_duedate, PDO::PARAM_STR);  
  //   Execute The Query
// Execute the query and insert into the database
$stmt2->execute();
// Check if the delete operation was successful
if ($stmt2->rowCount() > 0) {  
  
  // Create a SESSION Variable to Display message 
  $_SESSION['update'] = "Task Updated Successfully";
  // Redirect to Manage Page with JS
   header('location: ' . SITEURL . 'manage.php');
   exit; // Make sure to exit after a header redirect
 
} else {
  // Create a SESSION Variable to Display message
  $_SESSION['update_fail'] = "Failed to update Task";
  // Redirect to Update Page
   header('location: ' . SITEURL . 'update.php');
  exit; // Make sure to exit after a header redirect
}
}
// Login PHP PAGE
if (isset($_POST["login"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];

  // Use $conn to prepare the SQL query
  $sql = "SELECT * FROM users WHERE email = :email";
  $stmt = $conn->prepare($sql);

  // Check if prepare was successful
  if ($stmt) {
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->execute();

      // Fetch the user data
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($stmt->rowCount() > 0) {
          if (password_verify($password, $user["pass"])) {
              $_SESSION["user"] = "yes";
              $_SESSION['user_id'] = $user['user_id'];
              header('location: ' . SITEURL . 'home.php');
              exit;
          } else {
              // echo "<div class='alert alert-danger'>Password does not match</div>";
          }
      } else {
          // echo "<div class='alert alert-danger'>Email is not registered</div>";
      }
  } else {
      // echo "<div class='alert alert-danger'>Email does not match</div>";
  }
}

?>