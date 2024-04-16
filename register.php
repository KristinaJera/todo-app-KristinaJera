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
        <h1>Regjister on ToDo App!</h1>
    </div>
    <div class="container">
        <?php
        if (isset($_POST["register"])) {
           $fullName = $_POST["fullname"];
           $email = $_POST["email"];
           $password = $_POST["password"];
           $passwordRepeat = $_POST["repeat_password"];
           
           $passwordHash = password_hash($password, PASSWORD_DEFAULT);

           $errors = array();
           
        if (empty($fullName) || empty($email) || empty($password) || empty($passwordRepeat)) {
            array_push($errors, "All fields are required");
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
        } elseif (strlen($password) < 8) {
            array_push($errors, "Password must be at least 8 characters long");
        } elseif ($password !== $passwordRepeat) {
            array_push($errors, "Password does not match");
        }
        //    require_once "db.php";
           $sql = "SELECT * FROM users WHERE email = :email";
           $stmt = $conn->prepare($sql);
           $stmt->bindParam(':email', $email, PDO::PARAM_STR);
           $stmt->execute();
           // Fetch the number of rows
             $rowCount = $stmt->rowCount();

           if ($rowCount>0) {
            array_push($errors,"Email already exists!");
           }
           if (count($errors)>0) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
           }else{
            
             // Insert new user
        $sql = "INSERT INTO users (full_name, email, pass) VALUES (:full_name, :email, :pass)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':full_name', $fullName, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':pass', $passwordHash, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>You are registered successfully.</div>";
        } else {
            die("Something went wrong");
        }
    }
}
?>
        <form action="register.php" method="POST">
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="Full Name:">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password:">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn-2 btn-primary" value="Register" name="register">
            </div>
        </form>
        <div>
        <div><p>Already Registered <a href="index.php" class="login-register">Login Here</a></p></div>
      </div>
    </div>
</body>
</html>