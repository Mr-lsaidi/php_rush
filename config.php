<?php

    function connect()
    {
        $connection = mysqli_connect("172.19.0.1:3306", "root", "tiger", "ft_minishop");
        return $connection;
    }
?>
