<?php
session_start();
if (!isset($_SESSION['user'])) {
   header("Location: login.php");
}
$id = $_GET['id'];
function Eliminar($Id)
{

   include "Conexiones/ConexionSQL.php";
   $query = "DELETE Usuarios WHERE IdUSuario  = ?";
   $cmd = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY, PDO::SQLSRV_ATTR_QUERY_TIMEOUT => 1));
   $cmd->execute(array($Id));
   $fila = $cmd->rowCount();
   if ($fila > 0) {
      echo '<script>window.alert("Datos Eliminados!")</script>';
      header("refresh:2; url=http://localhost/phpsql/datos_usuario.php");
   } else {
      echo "<h1>Datos Incorrectos</h1>";
      header("refresh:2; url=http://localhost/phpsql/datos_usuario.php");
   }
}

Eliminar($id);
