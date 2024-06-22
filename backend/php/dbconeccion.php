<?php 

$con = mysqli_connect("localhost", "root", "", "appbomberos");

 if(mysqli_connect_errno()){
     echo "conexion fallida" . mysqli_connect_errno();
 }

?>