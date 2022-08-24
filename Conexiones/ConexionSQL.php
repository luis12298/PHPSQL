<?php
//CONEXION SQL SERVER
$serverName = "DESKTOP-28D3RFG";
$dbUsername = "sa";
$dbPassword = "Root1234";
$dbName = "DiseñoWebII";
// Crear Conexion a sql
try {
   $conn = new PDO("sqlsrv:Server=$serverName;Database=$dbName", $dbUsername, $dbPassword);
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // echo "Conectado";
} catch (PDOException $e) {
   die("Error Conexion a SQL Server: " . $e->getMessage());
}
