<?php
$IdUsuario = isset($_POST["txtId"]);
$usuario = isset($_POST["txtusuario"]);
$cont = isset($_POST["txtpass"]);
function Login()
{
   include "Conexiones/ConexionSQL.php";
   session_start();
   $usuario = $_POST["txtusuario"];
   $cont = $_POST["txtpass"];
   $cmd = $conn->prepare("SELECT * FROM Usuarios WHERE NombreUsuario =:par1 and Contrasena =:par2");
   $cmd->bindParam("par1", $usuario, PDO::PARAM_STR);
   $cmd->bindParam("par2", $cont, PDO::PARAM_STR);
   $cmd->execute();
   $fila = $cmd->rowCount();
   $data = $cmd->fetch(PDO::FETCH_OBJ);

   if ($fila) {
      echo '<script>window.alert("Bienvenido "+"' . $data->NombreUsuario . '");</script>';
      $_SESSION['user'] = $data->NombreUsuario;
      header("refresh:1; url=http://localhost/PHPSQL/datos_usuario.php");
   } else {
      if (!isset($_SESSION["cont"])) {
         $_SESSION["cont"] = 0;
         echo '<script>window.alert("Intento 1");</script>';
         header("refresh:1; url=http://localhost/PHPSQL/login.php");
      }
      $_SESSION["cont"] += 1;
      if ($_SESSION["cont"] === 2) {
         echo '<script>window.alert("Intento 2");</script>';
         header("refresh:1; url=http://localhost/PHPSQL/login.php");
      } elseif ($_SESSION["cont"] === 3) {
         echo '<script>window.alert("Intentos Maximos");</script>';
         session_destroy();
         header("refresh:1; url=http://localhost/PHPSQL/login.php");
      } else {
         return;
      }
   }
}


function Ingresar()
{
   $usuario = $_POST["txtusuario"];
   $cont = $_POST["txtpass"];
   include "Conexiones/ConexionSQL.php";
   $query = $conn->prepare("SELECT ISNULL((select max(IdUsuario) FROM Usuarios),0)+1");
   $query->execute();
   $data = $query->fetch();
   $Id = $data[0];
   $query = "INSERT INTO Usuarios(IdUsuario,NombreUsuario,Contrasena)VALUES(?,?,?)";
   $cmd = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY, PDO::SQLSRV_ATTR_QUERY_TIMEOUT => 1));
   $cmd->execute(array($Id, $usuario, $cont));
   $fila = $cmd->rowCount();
   if ($fila > 0) {
      echo '<script>window.alert("Datos Guardados!")</script>';
      header("refresh:2; url=http://localhost/phpsql/datos_usuario.php");
   } else {
      echo "<h1>Datos Incorrectos</h1>";
      header("refresh:2; url=http://localhost/phpsql/datos_usuario.php");
   }
}
function Actualizar()
{
   $IdUsuario = $_POST["txtId"];
   $usuario = $_POST["txtusuario"];
   $cont = $_POST["txtpass"];
   try {
      include "Conexiones/ConexionSQL.php";
      $query = "UPDATE Usuarios SET NombreUsuario = ?, Contrasena = ? WHERE IdUSuario  = ?";
      $cmd = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY, PDO::SQLSRV_ATTR_QUERY_TIMEOUT => 1));
      $cmd->execute(array($usuario, $cont, $IdUsuario));
      echo '<script>window.alert("Datos Actualizados!")</script>';
      header("refresh:2; url=http://localhost/phpsql/datos_usuario.php");
   } catch (Exception $e) {
      echo "<h1>Datos Incorrectos</h1>" . $e->getMessage();
      header("refresh:2; url=http://localhost/phpsql/datos_usuario.php");
   }
}
function Eliminar($Id)
{
   include "Conexiones/ConexionSQL.php";
   $query = "DELETE Usuarios WHERE IdUSuario  = ?";
   $cmd = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY, PDO::SQLSRV_ATTR_QUERY_TIMEOUT => 1));
   $cmd->execute(array($Id));
   $fila = $cmd->rowCount();
   if ($fila > 0) {
      echo '<script>window.alert("Datos Eliminados!")</script>';
      header("refresh:2; url=http://localhost/1periodoII/eliminar_usuario.php");
   } else {
      echo "<h1>Datos Incorrectos</h1>";
      header("refresh:2; url=http://localhost/1periodoII/eliminar_usuario.php");
   }
}
function Guardar_spUsuario()
{
   include "Conexiones/ConexionSQL.php";
   $null = "";
   $Nombre = ($_POST["txtusuario"]);
   $Contrasena = ($_POST["txtpass"]);

   $sql = "{ CALL sp_Usuarios (1,?,?,?)}";
   $cmd = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY, PDO::SQLSRV_ATTR_QUERY_TIMEOUT => 1));
   $cmd->bindParam(1, $null);
   $cmd->bindParam(2, $Nombre);
   $cmd->bindParam(3, $Contrasena);
   $cmd->execute(array($null, $Nombre, $Contrasena));

   if ($cmd == true) {
      echo '<script>window.alert("Datos Guardados!")</script>';
      header("refresh:2; url=http://localhost/phpsql/datos_usuario.php");
   } else {
      echo "<h1>Datos Incorrectos</h1>";
      header("refresh:2; url=http://localhost/phpsql/datos_usuario.php");
   }
}

if (isset($_POST["btniniciar"])) {
   Login();
} elseif (isset($_POST["btningresar"])) {
   Guardar_spUsuario();
} elseif (isset($_POST["btnactualizar"])) {
   Actualizar();
} else {
   return;
}
