<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SignUp</title>
  <link rel="stylesheet" type="text/css" href="newstyle.css">
</head>
<body>

<form action="signupphp.php" method="post">
  <h2>Sign Up</h2>
  <hr>
  <?php
    if(isset($_GET['error'])) { ?>
    <p class="error"><?php echo $_GET['error']; ?></p>
    <?php }?>
  <label>User Name</label>
  <input type="text" name="username" placeholder="Username"><br>

  <label>Password</label>
  <input type="password" name="password" placeholder="Password"><br>

  <label>Confirm Password</label>
  <input type="password" name="confirm_password" placeholder="Confirm Password"><br><hr>

  <button class="btnsl" type="submit">Signup</button>
</form>

</body>
</html>
