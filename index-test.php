<?php
$host_name = 'db742256669.db.1and1.com';
$database = 'db742256669';
$user_name = 'dbo742256669';
$password = 'superpassword';



$mysqli = new mysqli($host_name, $user_name, $password, $database);
$mysqli->set_charset("utf8");

if ($mysqli) {
    die('<p>Error al conectar con servidor MySQL: '.mysql_error().'</p>');
} else {
    echo '<p>Se ha establecido la conexión al servidor MySQL con éxito.</p >';
}
?> 