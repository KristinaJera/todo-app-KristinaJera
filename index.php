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
    <div class="header" id="header title">
        <a href="#"></a>
        <h1>Welcome to ToDo App!</h1>
        <h1>Log in and enjoy!</h1>
    </div>
    <?php

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
  
    // Use $conn to prepare the SQL query
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($sql);
  
    if ($stmt) {
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

      // Fetch the user data
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($stmt->rowCount() > 0) {
        if (password_verify($password, $user["pass"])) {
            $_SESSION["user"] = "yes";
            $_SESSION['user_id'] = $user['user_id'];

        } else {
         echo "<div class='alert alert-danger'>Password does not match</div>";
            
        }
    } else {
        echo "<div class='alert alert-danger'>Email is not registered</div>";
    }
} else {
    echo "<div class='alert alert-danger'>Email does not match</div>";
}
}
        ?>
    <div class="container">
      <form action="index.php" method="post">
        <div class="form-group">
            <input type="email" placeholder="Enter Email:" name="email" class="form-control">
        </div>
        <div class="form-group">
            <input type="password" placeholder="Enter Password:" name="password" class="form-control">
        </div>
        <div class="form-btn">
            <input type="submit" value="Login" name="login" class="btn-2 btn-primary">
        </div>
      </form>
     <div><p>Not registered yet <a href="register.php" class="login-register">Register Here</a></p></div>
    </div>
</body>
</html>