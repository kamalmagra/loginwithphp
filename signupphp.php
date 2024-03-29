<?php
session_start();
include "db_conn.php"; // Include database connection file

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm_password'])){

  function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $username = validate($_POST['username']);
  $pass = validate($_POST['password']);
  $confirm_pass = validate($_POST['confirm_password']);

  // Check if passwords match
  if ($pass !== $confirm_pass) {
    header("Location: signup.php?error=Passwords do not match");
    exit();
  }

  // Hash the password before saving
  $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

  // Check if username already exists
  $sql_check = "SELECT * FROM users WHERE user_name='$username'";
  $result_check = mysqli_query($conn, $sql_check);

  if (mysqli_num_rows($result_check) > 0) {
    header("Location: signup.php?error=Username already exists");
    exit();
  }

  $sql = "INSERT INTO users (user_name, password) VALUES ('$username', '$hashed_password')";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    header("Location: login.php?success=Signup successful! Please login.");
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

}
?>