<?php
    include ("config.php");
    session_start();
    if (isset($_SESSION['user']) && isset($_GET['validate']))
    {
        if ($_GET['validate'] === 'true')
        {
            $username = $_SESSION['user'];
            $connection = connect();
            $query = "INSERT INTO purchase(p_id, u_id) SELECT p_id, u_id FROM basket AS b ";
            $query .= "INNER JOIN users AS u ON u.id = b.u_id ";
            $query .= "WHERE u.login = '$username'";
            $result = mysqli_query($connection, $query);
            if ($result)
            {
                $get_id = $getID = mysqli_fetch_assoc(mysqli_query($connection, "SELECT id FROM users WHERE login = '$username'"));
                $user_id = $get_id['id']; 
                $query = "DELETE FROM basket WHERE u_id = '$user_id'";
                $result = mysqli_query($connection, $query);
                if ($result)
                {
                    echo '<script language="javascript">';
                    echo 'alert("Thank you for buying from us!");';
                    echo 'window.location = "index.php"';
                    echo '</script>';
                }
            }else
                die(mysqli_error($connection));
            mysqli_close($connection);
        }
    }
?>