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

    if (isset($_SESSION['user']) && $_SESSION['prev'] === 'admin')
    {
        $loginOrusername = $_SESSION['user'];
        $registerOrlogout = "Logout";
        if ($_GET['action'] === 'del' && $_GET['id'])
        {
            $id = $_GET['id'];
            $query = "DELETE FROM products WHERE id = '$id'";
            if (mysqli_query($connection , $query))
            {
                echo '<script language="javascript">';
                echo 'alert("Deleted successfully");';
                echo 'window.location = "product.php"';
                echo '</script>';
            }else
                die(mysqli_error($connection));
        }
        if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['image']) && $_POST['submit'] === 'ADD')
        { 
            $cat = [];
            if ($_POST['_counter'] !== '0')
            {
                $counter = intval($_POST['_counter']);
                while ($counter)
                {
                    $key = "check_" . $counter ."";
                    if(isset($_POST[$key]))
                        $cat[] = $_POST[$key];
                    $counter--;
                }
                $name = str_replace("'", "''", $_POST['name']);
                $price = $_POST['price'];
                $image= $_POST['image'];
                $query = "INSERT INTO products (name, price, image) VALUES ('$name', '$price', '$image')";
                if(!mysqli_query($connection, $query))
                    die(mysqli_error($connection));
                $id = mysqli_insert_id($connection);
                $i = 0;
                while ($i < count($cat))
                {
                    mysqli_query($connection, "INSERT INTO `categorie_product` (id_p, id_c) VALUES('$id', '" . $cat[$i] ."')");
                    $i++;
                }

            }
        }else if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['image']) && $_POST['submit'] === 'UPDATE')
        {
                $name = str_replace("'", "''", $_POST['name']);
                $price = $_POST['price'];
                $image= $_POST['image'];
                $id= $_POST['id'];
                $query = "UPDATE products SET name = '$name', price = '$price', image = '$image' WHERE id = '$id'";
                if(!mysqli_query($connection, $query))
                    die(mysqli_error($connection));
        }
        
        
    }else
    {
         $loginOrusername = "Login";
        $registerOrlogout = "Register";
    }
    $i = 0;
    $query = "SELECT * FROM products";
    $result = mysqli_query($connection, $query);
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
            while ($row = mysqli_fetch_assoc($result))
            {             
?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><a href="?action=del&id=<?php echo $row['id']; ?>">Deleted</a> | <a href="product.php?id=<?php echo $row['id']; ?>&name=<?php echo $row['name']; ?>&image=<?php echo $row['image'] ?>&price=<?php echo $row['price'] ?>">Modify</a></td>
                </tr>
<?               
            }
            
    ?>
        </table>
    <form action="product.php" method="post">
     <div class="row">
      <h2 style="text-align:center"><?php if(isset($_GET['id'])) echo "UDATE PRODUCT"; else echo "ADD A NEW PRODUCT" ?></h2>
      <div class="col1">
          <input type="text" name="id" value="<?php echo $_GET['id']; ?>" readonly required>
        <input type="text" name="name" placeholder="Product's name" value="<?php echo $_GET['name']; ?>" required>
        <input type="text" name="price" placeholder="Price" value="<?php echo $_GET['price']; ?>" required>
          <input type="text" name="image" placeholder="Image url" value="<?php echo $_GET['image']; ?>" required>
            <?php
              if ($category)
              {
                  while ($row = mysqli_fetch_assoc($categories))
                  {
                      $i++;
                      echo("<input type=\"checkbox\" name=\"check_".$row['id']."\" value=\"" . $row['id'] ."\"> ". $row['c_name']."  <br>");
                  }
              }
              ?>
        <input type="hidden" name="_counter" value="<?php echo $i; ?>">
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
