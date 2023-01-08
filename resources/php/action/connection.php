<?php
const SERVER_NAME = "laradock_mysql_1";
const USER = "root";
const PASSWORD = "root";
const DATABASE = "sistema_escolar";
function connect (): mysqli {
    return $con = new mysqli(SERVER_NAME, USER, PASSWORD, DATABASE);
}
$connection = connect();
?>