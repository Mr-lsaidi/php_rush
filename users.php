<?php
include("config.php");
    session_start();
    $loginOrusername = "Login";
    $registerOrlogout = "Register";

    if(isset($_GET['logout']))
        {
            $_SESSION['user'] = null;
        }

    if (isset($_SESSION['user']))
    {
        $loginOrusername = $_SESSION['user'];
        $registerOrlogout = "Logout";
    }else
    {
         $loginOrusername = "Login";
        $registerOrlogout = "Register";
    }

    $connection = connect();
    if (isset($_GET))
    {
        if($_GET['action'] === 'del' && $_GET['id'])
        {
            $id = $_GET['id'];
            $query = "DELETE FROM users WHERE id = '$id'";
            $result = mysqli_query($connection, $query);
            if (!$result)
                die(mysqli_error($connection));
            else
                header("Location users.php");
        }
    }

    if ($connection)
    {
        $query = "SELECT * FROM users";
        $users = mysqli_query($connection, $query);
    }
?>

<!DOCTYPE html>
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
                <th>Username</th>
                <th>Previlege</th>
                <th>Operation</th>
            </tr>
<?php
            while ($row = mysqli_fetch_assoc($users))
            {             
?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['login']; ?></td>
                    <td><?php echo $row['prevelige']; ?></td>
                    <td><a href="?action=del&id=<?php echo $row['id']; ?>">Deleted</a> | <a href="modify.php?id=<?php echo $row['id']; ?>&username=<?php echo $row['login']; ?>">Modify</a></td>
                </tr>
<?               
            }
            
    ?>
        </table>

    </div>
    <?php include ("footer.php"); ?>
</body>

</html>
