<?php
session_start();
if (!isset($_SESSION['user'])) {
   header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Ingresar usuario</title>
</head>

<body>
   <form action="procesos.php" method="post">
      <table>
         <td colspan="2" style="text-align: center;">
            <h3>Ingresar nuevo usuario</h3>
         </td>
         <tr>
            <td>Nuevo Usuario:</td>
            <td><input type="text" name="txtusuario" placeholder="Usuario" id=""></td>
         </tr>
         <tr>
            <td>Nueva Contraseña:</td>
            <td><input type="password" name="txtpass" id="" placeholder="Contraseña"></td>
         </tr>
         <tr>
            <td colspan="2" style="text-align: center;"><input type="submit" name="btningresar" value="Ingresar Nuevo"></td>
         </tr>
      </table>
   </form>
</body>

</html>