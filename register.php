<?php
    include ("config.php");
    session_start();
    if(isset($_POST))
    {
        if ($_POST['username'] && $_POST['password'])
        {
            $connection = connect();
            if ($connection)
            {
                $username = str_replace("'", "''", $_POST['username']);
                $password = hash("whirlpool", $_POST['password']);
                $query = "SELECT login password FROM users WHERE login = '$username'";
                $result = mysqli_query($connection, $query);
                if (mysqli_num_rows($result) >= 1)
                    header("Location: register.php?message=error");
                else
                {
                    $query = "INSERT INTO users(login, password, prevelige) VALUES ('$username' ,'$password', 'user')";
                    $result = mysqli_query($connection, $query);
                    if ($result)
                    {
                        $_SESSION['user'] = $username;
                        header("Location: index.php");
                    }else
                        die(mysqli_error($connection));
                }

            }
            mysqli_close($connection);
        }
    }
    $error;
    $alert;
    if (isset($_GET['message']))
    {
        $error = "This user already exits";
        $alert = "alert";
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ft_minishop</title>
<link rel="stylesheet" type="text/css" href="assets/styles.css">
</head>
<body>
<?php include ("header.php") ?>
<div class="container">
  <form action="register.php" method="post">
    <div class="row">
      <h2 style="text-align:center">Just a few steps and you're one of us</h2>
      <div class="col1">
        <div class="hide-md-lg">
          <p>Or sign in manually:</p>
        </div>

        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Sign up">
        <div class="<?php echo $alert; ?>">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
          <?php echo $error; ?>
        </div>
      </div>

    </div>
  </form>
</div>
<div class="container bottom-container">
  <div class="row">
    <div class="column">
      <a href="login.html" style="color:white" class="btn">Login</a>
    </div>
    <div class="column">
      <a href="#" style="color:white" class="btn">Forgot password?</a>
    </div>
  </div>
</div>
<?php include ("footer.php"); ?>
</body>
</html>
