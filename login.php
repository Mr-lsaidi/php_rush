<?php
    include("config.php");
    session_start();
    if(isset($_POST))
    {
        if ($_POST['username'] && $_POST['password'])
        {
            $connection = connect();
            if ($connection)
            {
                $username = $_POST['username'];
                $password = hash("whirlpool", $_POST['password']);;
                $query = "SELECT `password`, login, prevelige FROM users WHERE login = '$username' && password = '$password'";
                $result = mysqli_query($connection, $query);
                if (mysqli_num_rows($result) == 1)
                {
                    $_SESSION['user'] = $username;
                    $_SESSION['prev'] = mysqli_fetch_assoc($result)['prevelige'];
                    header("Location: index.php");
                }
                else
                    header("Location: login.html?message=error");
            }
            mysqli_close($connection);
        }
    }
?>