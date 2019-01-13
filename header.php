<?php
    $connection = connect();
    if (isset($_GET['c_id']))
    {
        $c_id = $_GET['c_id'];
        $query = "SELECT p.id, p.name, p.price, p.image FROM `categories` c INNER JOIN categorie_product AS cp on cp.id_c = c.id INNER JOIN products AS p ON p.id = cp.id_p WHERE c.id = '$c_id'";
    }else
        $query = "SELECT * FROM products";
    $result = mysqli_query($connection, $query);
    $category = mysqli_query($connection, "SELECT * FROM `categories`");
    mysqli_close($connection);
?>

    <header>
        <nav class="navbar">
            <div class="container">
                <a href="index.php">Ft_minishop</a>
                <?php
                    if ($_SESSION['prev'] === 'admin')
                    {
                        echo ("<a href=\"product.php\">Add Product</a>");
                        echo ("<a href=\"category.php\">Add Category</a>");
                        echo ("<a href=\"users.php\">Users</a>");
                        echo ("<a href=\"purchases.php\">Purchase</a>");
                    }
                ?>
                <a href="basket.php">Basket</a>
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
                                    echo "<a href=\"index.php?c_id= " . $row['id'] . "\">" . $row['c_name'] . "</a>";
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="right">
                    <a href="<?php
                             if ($loginOrusername === 'Login')
                                echo "login.html";
                             else
                                echo "#";
                             ?>"><?php echo $loginOrusername ?></a>
                    <a href="<?php 
                                 if ($loginOrusername == "Login")
                                     echo "register.php";
                                    else
                                        echo "index.php?logout=" . $loginOrusername;
                             ?>"><?php echo $registerOrlogout ?></a>
                </div>
            </div>
        </nav>
    </header>