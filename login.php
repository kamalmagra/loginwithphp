<?php
session_start();
include "db_conn.php";

if(isset($_POST['uname']) && isset($_POST['password'])){

  function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $uname = validate($_POST['uname']);
  $pass = validate($_POST['password']);

  if(empty($uname)){
    header("Location: index.php?error=Username is required");
    exit();
  }elseif(empty($pass)){
    header("Location: index.php?error=Password is required");
    exit();
  }else{

    $sql = "SELECT * FROM users WHERE user_name=?"; // Prepared statement placeholder

    $stmt = mysqli_prepare($conn, $sql); // Prepare statement

    if ($stmt) { // Check for successful preparation
      mysqli_stmt_bind_param($stmt, "s", $uname); // Bind username parameter
      mysqli_stmt_execute($stmt); // Execute prepared statement

      $result = mysqli_stmt_get_result($stmt); // Get result

      if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);

        $hashed_password = $row['password']; // Hashed password from database

        if (password_verify($pass, $hashed_password)) {
          $_SESSION['user_name'] = $row['user_name'];
          $_SESSION['name'] = $row['name']; // Assuming a 'name' column exists
          $_SESSION['id'] = $row['id'];
          header("Location: home.php");
          exit();
        } else {
          header("Location: index.php?error=Incorrect user name or password");
          exit();
        }
      }else{
        header("Location: index.php?error=Incorrect user name or password");
        exit();
      }

      mysqli_stmt_close($stmt); // Close prepared statement (optional)
    } else {
      // Handle prepared statement error (optional)
    }
  }

}else{
  header("Location: index.php");
  exit();
}

?>
