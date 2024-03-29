<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="newstyle.css">
</head>
<body>

<form action="login.php" method="post">
    <h2>LOGIN</h2>
    <hr>
    <?php
    if(isset($_GET['error'])) { ?>
    <p class="error"><?php echo $_GET['error']; ?></p>
    <?php }?>
    <label>User Name</label>
    <input type="text" name="uname" placeholder="Username"><br>

    <label>Password</label>
    <input type="password" name="password" placeholder="Password"><br><hr>

    <button class="btnl" type="submit">Login</button>
    <button class="btnr" type="button" onclick="redirectToSignup()">Signup</button>
</form>

<script>
  function redirectToSignup() {
    window.location.href = "signup.php";
  }
</script>
    
</body>
</html>