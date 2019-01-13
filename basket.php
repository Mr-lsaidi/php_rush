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
        $username = $loginOrusername = $_SESSION['user'];
        $registerOrlogout = "Logout";
        $connection = connect();
        
        if ($connection && $_GET['action'] === 'del' && $_GET['p_id'])
        {
            $get_id = $getID = mysqli_fetch_assoc(mysqli_query($connection, "SELECT id FROM users WHERE login = '$username'"));
            $user_id = $get_id['id']; 
            $p_id = $_GET['p_id'];
            $query = "DELETE FROM basket WHERE u_id = '$user_id' && p_id = '$p_id'";
            if (mysqli_query($connection, $query))
            {
                echo '<script language="javascript">';
                echo 'alert("Deleted successfully");';
                echo 'window.location = "basket.php"';
                echo '</script>';
                
            }else
                die(mysqli_error($connection));
        }
        $get_id = $getID = mysqli_fetch_assoc(mysqli_query($connection, "SELECT id FROM users WHERE login = '$username'"));
        $user_id = $get_id['id'];  
        if ($connection && $_GET['id'])
        {
            $p_id = $_GET['id'];
            $query = "SELECT * FROM basket INNSER JOIN users as u ON u_id = u.id WHERE u.login = '$username' && p_id = '$p_id'";
            $result = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) == 1)
            {
                echo '<script language="javascript">';
                echo 'alert("This products is already in your basket");';
                echo 'window.location = "index.php"';
                echo '</script>';
                
            }
            else
            {                                
                $query = "INSERT INTO basket(u_id, p_id) VALUES ('$user_id', '$p_id')";
                $result = mysqli_query($connection, $query);
                if ($result === TRUE)
                {
                    echo '<script language="javascript">';
                    echo 'alert("Has been added successfully to your basket");';
                    echo 'window.location = "basket.php"';
                    echo '</script>'; 
                }
            }
        }
        $query = "SELECT b.id, p_id, p.name, p.price, u.login FROM basket AS b INNER JOIN products as p ON p_id = p.id";
        $query .= " INNER JOIN users as u ON u_id = u.id";
        $query .= " WHERE u.login = '$username'";
        $basket = mysqli_query($connection, $query);
        if (!$basket)
            die(mysqli_error($connection));
        $total = mysqli_fetch_assoc(mysqli_query($connection, "SELECT SUM(p.price) as total FROM basket INNER JOIN products p ON p_id = p.id WHERE u_id = '$user_id'"));
        if (!$total)
            die(mysqli_error($connection));
        $basket_total = $total['total']; 
        mysqli_close($connection);
        
    }else
    {
         $loginOrusername = "Login";
        $registerOrlogout = "Register";
    }

?>

<!DOCTYPE HTML>
<html>

<head>
    <title>My basket</title>
    <link rel="stylesheet" type="text/css" href="assets/styles.css">
</head>

<body>
    <?php include ("header.php");  ?>
    <div class="container">

        <table id="users">
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Price</th>
                <th>Operation</th>
            </tr>
            <?php
        if ($basket)
        {
            while ($row = mysqli_fetch_assoc($basket))
            {             
?>
            <tr>
                <td>
                    <?php echo $row['id']; ?>
                </td>
                <td>
                    <?php echo $row['name']; ?>
                </td>
                <td>
                    <?php echo "$" . $row['price']; ?>
                </td>
                <td><a href="?action=del&p_id=<?php echo $row['p_id']; ?>">Deleted</a></td>
            </tr>
            <?               
            }
        }
            
    ?>
        <tr>
            <td colspan="2">Total</td>
            <td colspan="2">$ <?php echo $basket_total; ?></td> 
        </tr>
        </table>
        <a class="button" href="validate.php?validate=true">Validate</a>

    </div>
    <?php include ("footer.php"); ?>
</body>

</html>
