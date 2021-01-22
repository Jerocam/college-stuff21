<?php

    function dbConnect() {
        
        $username='username';
        $password= 'password';
        $localhost = 'localhost';
        $db_name = "u824372461_collegestuff";

        $connection = mysqli_connect($localhost, $username, $password, $db_name);

        if(!$connection){
            die("connection failed: ".mysqli_connect_error());
        }

        return $connection;
    }

    function dbClose($connection){
        $connection -> close();
    }

?>
