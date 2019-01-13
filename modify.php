<?php
    include ("config.php");
    session_start();

    if (!isset($_GET))
        header("Location: index.php");
    $connection = connect();
    if ($connection)
    {
        if (isset($_POST) && $_POST['username'])
        {
            $prev = $_POST['prev'];
            $username = str_replace("'", "''", $_POST['username']);
            $id = $_POST['identity'];
            $query = "UPDATE users SET login = '$username', prevelige = '$prev' WHERE id = '$id'";
            $result = mysqli_query($connection, $query);
            if ($result === TRUE)
                header("Location: index.php");
            else
                die("Faild " . mysqli_error());
        }
    }
    mysqli_close($connection);
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>ft_minishop</title>
    <link rel="stylesheet" type="text/css" href="assets/styles.css">
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="container">
                <a href="index.php">Ft_minishop</a>
                <a href="#Products">Products</a>
                <a href="#Products">Basket</a>
                <div class="dropdown">
                    <button class="dropbtn">Categories
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content">
                        <?php
                            if ($category)
                            {
                                while ($row = mysqli_fetch_assoc($category))
                                {
                                    echo "<a href=\"#\">" . $row['c_name'] . "</a>";
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="right">
                    <a href="<?php
                             if ($loginOrusername === 'Login')
                                echo " login.html"; else echo "#" ; ?>">
                        <?php echo $loginOrusername ?></a>
                    <a href="<?php 
                                 if ($loginOrusername == " Login") echo "rgister.php" ; else echo "index.php?logout=" . $loginOrusername; ?>">
                        <?php echo $registerOrlogout ?></a>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        <form action="modify.php" method="post">
            <div class="row">
                <h2 style="text-align:center">Mdify user</h2>
                <div class="col1">
                    <input type="text" name="identity" value="<?php echo $_GET['id'] ?>" readonly required>
                    <input type="text" name="username" placeholder="Username" value="<?php echo $_GET['username'] ?>"  required>
                    <select name="prev">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                    <input type="submit" value="Modify">
                </div>

            </div>
        </form>
    </div>
    <?php include ("footer.php"); ?>
</body>

</html>
