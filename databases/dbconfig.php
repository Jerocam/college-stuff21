<?php

    function dbConnect() {
        
        // $username='root';
        // $password='O85AU3rMFd1ep9Z1';
        // $localhost = 'localhost';
        // $db_name = "collegestuff";

        $username='u824372461_jerocam';
        $password= 'Vy99S6f;?';
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