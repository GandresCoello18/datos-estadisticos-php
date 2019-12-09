<?php 
include('database/db.php');

    $con = connectDatabase();

    function consulta($tabla){
        global $con;
        $query = $con->query("SELECT * FROM $tabla ");
        while($row = $query->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    function registrar_vehiculo($id_user, $matricula, $modelo, $color, $ano){
        global $con;
        $con->query("INSERT INTO vehiculos (id_user, matricula, modelo, color, ano) VALUES ('$id_user', '$matricula', '$modelo', '$color', '$ano') ");
    }

    function registrar_multa($id_vehicul, $mes, $causa, $puntos){
        global $con;
        $con->query("INSERT INTO multa (id_vehiculo, mes, causa, puntos_restados) VALUES ( $id_vehicul, '$mes', '$causa', '$puntos' ) ");
        
        //obtener id user para cambiar el campo puntos de usuario
        $ID_USER = $con->query("SELECT vehiculos.id_user FROM multa INNER JOIN vehiculos ON multa.id_vehiculo = vehiculos.id_vehiculo WHERE vehiculos.id_vehiculo = $id_vehicul ");
        while($row = $ID_USER->fetch_assoc()) {
            $rows[] = $row;
        }
        $tras_id_user = intval($rows[0]['id_user']);

        //consultar usuario
        $data = abtraer_valor_puntos($tras_id_user);
        foreach($data as $item){
            $antes_de_actualizar = $item['puntos'];
        }
        $nuevo_puntos = $antes_de_actualizar - intval($puntos);
        $nuevo_puntos_int = intval($nuevo_puntos);

    
        //update de puntos en usuario
        $con->query("UPDATE usuario SET puntos = $nuevo_puntos_int WHERE id_user = $tras_id_user ");
    
    }

    function abtraer_valor_puntos($valor){
        global $con;
        $query = $con->query("SELECT puntos FROM usuario WHERE id_user = $valor ");
        while($row = $query->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    function abtraer_ID($tabla, $retornar, $campo, $valor){
        global $con;
        $query = $con->query("SELECT $retornar FROM $tabla WHERE $campo = '$valor' ");
        while($row = $query->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    function all_multas(){
        global $con;
        $rows = [];
        $query = $con->query("SELECT usuario.unir_name, vehiculos.matricula, vehiculos.modelo, multa.causa, multa.puntos_restados, multa.mes FROM multa INNER JOIN vehiculos ON multa.id_vehiculo = vehiculos.id_vehiculo INNER JOIN usuario ON usuario.id_user = vehiculos.id_user;");
        while($row = $query->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    function buscar_multa($name){
        global $con;
        $rows = [];
        $query = $con->query("SELECT usuario.unir_name, vehiculos.matricula, vehiculos.modelo, multa.causa, multa.puntos_restados, multa.mes FROM multa INNER JOIN vehiculos ON multa.id_vehiculo = vehiculos.id_vehiculo INNER JOIN usuario ON usuario.id_user = vehiculos.id_user WHERE usuario.unir_name = '$name' ");
        while($row = $query->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }     

    function cantidad_de_multa_user(){
        global $con;
        $rows = [];
        $query = $con->query("SELECT COUNT(usuario.unir_name), usuario.Nombre FROM multa INNER JOIN vehiculos ON multa.id_vehiculo = vehiculos.id_vehiculo INNER JOIN usuario ON usuario.id_user = vehiculos.id_user GROUP BY usuario.id_user ASC;");
        while($row = $query->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    function all_user_vehiculo(){
        global $con;
        $rows = [];
        $query = $con->query("SELECT usuario.unir_name, usuario.puntos, vehiculos.matricula, vehiculos.modelo, vehiculos.color FROM vehiculos INNER JOIN usuario ON vehiculos.id_user = usuario.id_user;");
        while($row = $query->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    function sugerencia(){
        global $con;
        $rows = [];
        $query = $con->query("SELECT mes, causa FROM multa GROUP BY mes, causa HAVING COUNT(mes) = ( SELECT MAX(multa.mes) FROM ( SELECT COUNT(mes) as mes FROM multa GROUP BY mes ) multa );");
        while($row = $query->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    function valor_mes($nombre_mes){
        global $con;
        $rows = [];
        $query = $con->query("SELECT COUNT(mes) FROM multa WHERE mes = '$nombre_mes' GROUP BY mes;");
        while($row = $query->fetch_assoc()){
            $rows[] = $row;
        }
        return $rows;
    }

    function mes_name($nombre_mes){
        global $con;
        $rows = [];
        $query = $con->query("SELECT mes FROM multa WHERE mes = '$nombre_mes' GROUP BY mes;");
        while($row = $query->fetch_assoc()){
            $rows[] = $row;
        }
        return $rows;
    }

    function mes_causa($limit){
        global $con;
        $rows = [];
        if($limit == null){
            $query = $con->query("SELECT mes, causa FROM multa;");
        }else{
            $query = $con->query("SELECT mes, causa FROM multa limit 3;");
        }
        while($row = $query->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    function tabla_user_puntos_restantes(){
        global $con;
        $rows = [];
        $query = $con->query("SELECT usuario.unir_name, SUM(multa.puntos_restados) FROM multa INNER JOIN vehiculos ON vehiculos.id_vehiculo = multa.id_vehiculo INNER JOIN usuario ON usuario.id_user = vehiculos.id_user  GROUP BY usuario.unir_name;");
        while($row = $query->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }
?>