<?php  

function connectDatabase(){
    $host='localhost';
    $user='root@';
    $pass='';
    $db='multas';
    $mysqli = new mysqli($host,$user,$pass,$db);
    if($mysqli->connect_errno){
        $result = "Fallo al conectar a MySQL: " . $mysqli->connect_error;
    }
    return $mysqli;
}

/*
  $servidor = "localhost";
  $usuario = "root@";
  $password = "";
 
  try {
        $conexion = new PDO("mysql:host=$servidor;dbname=multas", $usuario, $password);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Conexión realizada Satisfactoriamente";
      }
 
  catch(PDOException $e){
        echo "La conexión ha fallado: " . $e->getMessage();
      }
 
  $conexion = null;*/