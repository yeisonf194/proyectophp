<?php
require_once "global.php";
//Esta es la conexion  a la base de datos
$conexion = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

mysqli_query( $conexion, 'SET NAMES "'.DB_ENCODE.'"');

//Mostrar error de conexion, en caso de que algo falle 
if (mysqli_connect_errno()) 
{
    printf("Fallo la conexion a la base de datos: %s\n",mysqli_connect_errno());
    exit();    
}