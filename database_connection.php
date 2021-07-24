<?php
    function connect(){
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $dbName = 'seat_planner';

        $con = new mysqli($host,$user,$pass,$dbName);
        return $con;
    }
?>
