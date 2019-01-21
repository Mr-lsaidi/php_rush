
<?php
    include ("config.php");
    session_start();
$connection = connect();
    $loginOrusername = "Login";
    $registerOrlogout = "Register";

    if(isset($_GET['logout']))
        {
            $_SESSION['user'] = null;
            $_SESSION['prev']  = null;
        }

    if (isset($_SESSION['user']))
    {
        $loginOrusername = $_SESSION['user'];
        $registerOrlogout = "Logout";
        if ($connection && isset($_POST['name']) && $_POST['submit'] === 'ADD')
        {
            $name = str_replace("'", "''", $_POST['name']);
            $query= "INSERT INTO `categories`(`c_name`) VALUES ('$name')";
            if (!mysqli_query($connection, $query))
                die(mysqli_error($connection));
            else
            {
                echo '<script language="javascript">';
                echo 'alert("Added successfully");';
                echo 'window.location = "category.php"';
                echo '</script>';
            }
        }
        else if ($connection && isset($_POST['name']) && $_POST['submit'] === 'UPDATE')
        {
            $name = str_replace("'", "''", $_POST['name']);
            $id = $_POST['id'];
            $query= "UPDATE `categories` SET `c_name`= '$name' WHERE id = '$id'";
            if (!mysqli_query($connection, $query))
                die(mysqli_error($connection));
            else
            {
                echo '<script language="javascript">';
                echo 'alert("Updated successfully");';
                echo 'window.location = "category.php"';
                echo '</script>';
            }
        }
        
    }
    else
    {
         $loginOrusername = "Login";
        $registerOrlogout = "Register";
    }

    $categories = mysqli_query($connection, "SELECT * FROM `categories`");
    mysqli_close($connection);

?>

<!DOCTYPE HTML>
<html>

<head>
    <title>ft_minishop</title>
    <link rel="stylesheet" type="text/css" href="assets/styles.css">
</head>

<body>
<?php include ("header.php");  ?>
    
<div class="container">
    <table id="users">
            <tr>
                <th>ID</th>
                <th>name</th>
                <th>Operation</th>
            </tr>
<?php
    if ($categories)
    {
            while ($row = mysqli_fetch_assoc($categories))
            {             
?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['c_name']; ?></td>
                    <td><a href="?action=del&id=<?php echo $row['id']; ?>">Deleted</a> | <a href="category.php?id=<?php echo $row['id']; ?>&name=<?php echo $row['c_name']; ?>">Modify</a></td>
                </tr>
<?               
            }
    }
            
    ?>
        </table>
    
  <form action="category.php" method="post">
    <div class="row">
      <h2 style="text-align:center">ADD A NEW CATEGORY</h2>
      <div class="col1">
        <div class="hide-md-lg">
          <p>Or sign in manually:</p>
        </div>
          <input type="text" name="id" value="<?php echo $_GET['id']; ?>" placeholder="IDENTITY GENERATED AUTOMATICLY" readonly required>
        <input type="text" name="name" value="<?php echo $_GET['name']; ?>" placeholder="Category name" required>
                <input type="submit" name="submit" value="<?php
                                                    if (isset($_GET['id']))
                                                        echo "UPDATE";
                                                    else
                                                        echo "ADD";
                                                  ?>">
      </div>
      
    </div>
  </form>
</div>
    <?php include ("footer.php"); ?>
</body>
</html>
