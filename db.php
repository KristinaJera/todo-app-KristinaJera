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

// Check whether the form is submitted for adding a task
if (isset($_POST['submit'])) {
  // Retrieve task details from the form
  $task_name = $_POST['task_name'];
  $task_status = $_POST['task_status'];
  $task_priority = $_POST['task_priority'];
  $task_duedate = $_POST['task_duedate'];

  // Retrieve user_id from the session
  if (isset($_SESSION['user_id'])) {
      $user_id = $_SESSION['user_id'];

      // SQL query to insert the task into the table_task table
      $sql = "INSERT INTO table_task (task_name, task_status, task_priority, task_duedate, user_id) 
              VALUES (:task_name, :task_status, :task_priority, :task_duedate, :user_id)";

      // Prepare the statement
      $stmt = $conn->prepare($sql);

      // Bind parameters
      $stmt->bindParam(':task_name', $task_name, PDO::PARAM_STR);
      $stmt->bindParam(':task_status', $task_status, PDO::PARAM_STR);
      $stmt->bindParam(':task_priority', $task_priority, PDO::PARAM_STR);
      $stmt->bindParam(':task_duedate', $task_duedate, PDO::PARAM_STR);
      $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

      // Execute the query
      if ($stmt->execute()) {
          // Task added successfully
          $_SESSION['add'] = "List Added Successfully";
          header('location: ' . SITEURL . 'manage.php');
          exit;
      } else {
          // Failed to add task
          $_SESSION['add_fail'] = "Failed to Add List";
          header('location: ' . SITEURL . 'add.php');
          exit;
      }
  } else {
      // User is not logged in
      // Handle this case as needed, maybe redirect to login page
  }
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
              if (isset($user['user_id'])) {     
              $_SESSION['user_id'] = $user['user_id'];
              }
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