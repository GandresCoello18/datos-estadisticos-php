<?php
    $dato = consulta('usuario');

    if(isset($_POST['N_enviar'])){
        $datos_from = [$_POST['N_user'], $_POST['N_matricula'], $_POST['N_modelo'], $_POST['N_color'], $_POST['N_ano'],];
        $status = true;
        for($i = 0; $i < count($datos_from); $i++){
            if($datos_from[$i] == ''){
                $status = false;
                break;
            }else{
                $datos_from[$i] = filter_var($datos_from[$i], FILTER_SANITIZE_STRING);
            }
        }
        
        if($status == true){
            $obtener_ID_USER = abtraer_ID('usuario', 'id_user', 'unir_name', $datos_from[0] );
            registrar_vehiculo($obtener_ID_USER[0]['id_user'], $datos_from[1], $datos_from[2], $datos_from[3], $datos_from[4]);
        }else{
            echo "<script>alert('campos vacios, vuelva a intentarlo')</script>";
        }
    }
?>

<form action="" method="POST">
    <div class="form-group">
        <label for="ced"># de Cedula:</label>
        <select id="ced" class="form-control" name="N_user">
            <?php 
                foreach($dato as $item){
                    echo "<option>".$item['unir_name']."</option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="matr"># de Matricula:</label>
        <input type="text" id="matri" class="form-control" name="N_matricula" placeholder="Ingrese el numero de la matricula" />
    </div>
    <div class="form-group">
        <label for="model">Modelo:</label>
        <input type="text" id="model" class="form-control" name="N_modelo" placeholder="Ingrese el modelo del vehiculo" />
    </div>
    <div class="form-group">
        <label for="col">Color:</label>
        <select id="col" class="form-control" name="N_color">
            <option>Rojo</option>
            <option>Negro</option>
            <option>Azul - oscuro</option>
        </select>
    </div>
    <div class="form-group">
        <label for="ano">Año:</label>
        <input type="date" id="ano" class="form-control" name="N_ano" placeholder="Ingrese el Año del vehiculo" />
    </div>
    <div class="form-group">
        <input type="submit" class="form-control btn btn-success" name="N_enviar" value="Registrar" />
    </div>
</form>