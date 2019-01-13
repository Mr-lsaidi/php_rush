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
    $query = "SELECT * FROM products";
    $result = mysqli_query($connection, $query);
    $category = mysqli_query($connection, "SELECT * FROM `categories`");
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
<?php

    $i = 0;
    while ($row = mysqli_fetch_assoc($result))
    {
        if ($i % 3 == 0)
        {
            echo ("<div class=\"clearfix section group\">");
        }
?>
        <div class="product col span_1_of_3">

<?php
            echo ("<img class=\"center\" src='". $row['image'] ."'>");
                echo ("<h3 class='title'>". $row['name'] ."</h3>");
?>
                <div class="clearfix info">
                <?php
                    echo ("<span class=\"price\"> $" . $row['price'] . "</span>");
                    echo ("<a class=\"details\" href=\"basket.php?id=" . $row['id'] ."\">ADD TO BASKET</a>");
            ?>

                </div>
            </div>
        <?php
        $i++;
        if ($i % 3 == 0)
            echo "</div>";
    }
?>
    </div>
</body>
</html>
