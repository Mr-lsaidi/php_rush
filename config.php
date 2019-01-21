<?php

    function connect()
    {
		$connection = mysqli_connect("YourIP", "YourUserName", "YourPassword", "TheNameOfDataBase");
		return $connection;
    }
?>
