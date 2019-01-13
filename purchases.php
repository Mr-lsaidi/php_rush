<?php
    include ("config.php");
    session_start();

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
    }else
    {
         $loginOrusername = "Login";
        $registerOrlogout = "Register";
    }

    $connection = connect();
    $purchases = mysqli_query($connection, "SELECT pu.id, p.name, p.price, pu.date_time, u.login FROM `purchase` as pu INNER JOIN products p ON p.id = p_id INNER JOIN users u ON u.id = u_id");
    mysqli_close($connection);

?>
<html>
    <head>
        <title>Purchases</title>
        <link rel="stylesheet" type="text/css" href="assets/styles.css">
    </head>
    <body>
        <?php include ("header.php"); ?>
        <div class="container">
            <table id="users">
            <tr>
                <th>ID</th>
                <th>Product name</th>
                <th>Price</th>
                <th>Purchase Date</th>
                <th>Customer</th>
            </tr>
<?php
            while ($row = mysqli_fetch_assoc($purchases))
            {             
?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['date_time']; ?></td>
                    <td><?php echo $row['login']; ?></td>
                </tr>
<?               
            }
            
    ?>
        </table>
        </div>
        <?php include ("footer.php"); ?>
    </body>
</html>