<?php
require_once 'ConexionSQL.php';
//CONSULTA A LA TABLA EMPLEADOS

$query = $conn->prepare("SELECT * FROM Usuarios");

$query->execute();
$data = $query->fetchAll();

foreach ($data as $row) {

   echo $row['IdUsuario'] . " " . $row['NombreUsuario'] . "<br>";
}
