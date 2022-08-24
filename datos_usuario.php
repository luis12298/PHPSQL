<?php
require_once 'Conexiones/ConexionSQL.php';
session_start();
if (!isset($_SESSION['user'])) {
   header("Location: login.php");
}
// $query = $conn->prepare("SELECT * FROM Usuarios");

// $query->execute();
// $data = $query->fetchAll(PDO::FETCH_OBJ);
$sql = "{ CALL sp_Usuarios (4,?,?,?)}";
$null = null;
$cmd = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY, PDO::SQLSRV_ATTR_QUERY_TIMEOUT => 1));
$cmd->bindParam(1, $null);
$cmd->bindParam(2, $null);
$cmd->bindParam(3, $null);
$cmd->execute(array($null, $null, $null));
$data = $cmd->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Lista de usuarios</title>
   <style>
      tr:hover {
         background-color: #ddd;
      }

      a {
         text-decoration: none;
         border-radius: 4px;
         border: solid 1px #20538D;
         background: #DFDFDF;
         padding: 1px 2px;
         color: black;
      }

      .fila {
         cursor: pointer;
      }

      .selected {
         background-color: #003d42 !important;
         font-weight: bold;
         color: white;
      }
   </style>
   </style>
</head>

<body>
   <h1>Listado de usuarios ingresados</h1>
   <div>
      <?php

      $user = $_SESSION['user'];
      ?>
   </div>
   <h3>Usuario Conectado:<?php echo " " . $user; ?> </h3>
   <input style="display: none;" type="text" id="txtId" name="txtId" value="">
   <strong>Buscar datos</strong>
   <input type="search" name="txtbuscar" id="txtbuscar"><br><br>
   <a href="ingresar_usuario.php">Agregar Nuevo</a>
   <a href="" onclick="actualizar();" id="url1">Actualizar</a>
   <a href="" onclick="eliminar();" id="url2">Eliminar</a>
   <br><br>
   <table id="dgvDatos" style="border-collapse: collapse;
         width: 35%;">
      <thead id="quitar">
         <tr>
            <th>No</th>
            <th>Nombre de Usuario</th>
            <th>Contrasena</th>
         </tr>
      </thead>
      <?php
      foreach ($data as $dato) {
      ?>
         <tbody class="busqueda">
            <tr class="fila">
               <td style="text-align: center;"><?php echo $dato->No; ?></td>
               <td style=" text-align: center;"><?php echo $dato->Usuario; ?></td>
               <td style="text-align: center;"><?php echo $dato->Contrasena; ?></td>
            </tr>
         </tbody>
      <?php
      }
      ?>
   </table>
   <div id="resultado"></div>
   <br>
   <a href="login.php?close" onclick="close_window();return false;">Salir</a>

   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
   <script src="main.js">
   </script>
   <script type="text/javascript">
      var index,
         table = document.getElementById("dgvDatos");

      for (var i = 1; i < table.rows.length; i++) {
         table.rows[i].onclick = function() {
            if (typeof index !== "undefined") {
               table.rows[index].classList.toggle("selected");
            }
            index = this.rowIndex;
            this.classList.toggle("selected");
         };
      }
   </script>
</body>

</html>