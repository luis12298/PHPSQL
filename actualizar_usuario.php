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
   <title>Actualizar Usuarios</title>
</head>

<body>
   <form action="procesos.php" method="post">
      <div>
         <?php
         $id = $_GET['id'];
         if ($id == null or $id == 0) {
            echo '<script>window.alert("Seleccione una fila")</script>';
            header("refresh:0; url=http://localhost/phpsql/datos_usuario.php");
         } else {
            require_once 'Conexiones/ConexionSQL.php';
            $query = $conn->prepare("SELECT * FROM Usuarios WHERE IdUsuario = ?");
            $query->execute(array($id));
            $data = $query->fetchAll(PDO::FETCH_OBJ);
            foreach ($data as $dato) {
         ?>
      </div>
      <table>
         <td colspan="2" style="text-align: center;">
            <h3>Actualizar usuario</h3>
         </td>
   <?php
            }
         }
   ?>
   <tr>
      <td>IdUsuario:</td>
      <td><input type="text" name="txtId" placeholder="0" readonly id="txtId" value="<?php echo $dato->IdUsuario ?>"></td>
   </tr>

   <tr>
      <td>Usuario:</td>
      <td><input type="text" name="txtusuario" placeholder="Usuario" id="txtusuario" value="<?php echo $dato->NombreUsuario ?>"></td>
   </tr>
   <tr>
      <td>Contraseña:</td>
      <td><input type="text" name="txtpass" id="" placeholder="Contraseña" value="<?php echo $dato->Contrasena ?>"></td>
   </tr>
   <tr>
      <td colspan="3" style="text-align: center;"><input type="submit" name="btnactualizar" value="Actualizar"></td>
   </tr>
      </table>
   </form>
   <script src="main.js"></script>
</body>

</html>