<?php
    $datos = consulta('vehiculos');

    if(isset($_POST['Multa_enviar'])){
        $datos_from_multa = [$_POST['Multa_matr'], $_POST['Multa_caus'] ];
        $status = true;
        for($j = 0; $j < count($datos_from_multa); $j++){
            if($datos_from_multa[$j] == '' || $datos_from_multa[$j] == null){
                $status = false;
                break;
            }else{
                $datos_from_multa[$j] = filter_var($datos_from_multa[$j], FILTER_SANITIZE_STRING);
            }
        }
        
        function calcular_puntos($valor){
            $puntos = 0;
            switch($valor){
                case 'El conductor que use inadecuada y reiteradamente la bocina.':
                    $puntos = 1;
                break;
                case 'Transporte público que permita el ingreso de personas para realizar actividades de comercio.':
                    $puntos = 1;
                break;
                case 'Llevar animales domesticos en los asientos delanteros.':
                    $puntos = 1;
                break;  
                case 'Los conductores que no utilicen el cinturón de seguridad.':
                    $puntos = 1;
                break;
                case 'Peatones que no transiten por las aceras o sitios de seguridad.':
                    $puntos = 1;
                break;
                case 'El conductor que invada con su vehículo las vías exclusivas.':
                    $puntos = 3;
                break;
                case 'Quien estacione un vehículo en los sitios prohibidos.':
                    $puntos = 3;
                break;
                case 'Utilizar teléfono celular mientras conduce y no haga uso del dispositivo homologado de manos libres.':
                    $puntos = 3;
                break;
                case 'El conductor de un taxi, que no utilice el taxímetro':
                    $puntos = 4;
                break;
                case 'El conductor que adelante a un vehículo de transporte escolar mientras éste se encuentre estacionado.':
                    $puntos = 4;
                break;
                case 'El conductor que desobedezca las órdenes de los agentes de tránsito':
                    $puntos = 6;
                break;
                case 'Quien conduzca un automotor sin poseer licencia para conducir.':
                    $puntos = 6;
                break;
                case 'El que conduzca un vehículo con uno o más neumáticos desgastados':
                    $puntos = 6;
                break;
                case 'Transporte material inflamable, explosivo o peligroso en vehículos no acondicionados.':
                    $puntos = 7;
                break;
                case 'El conductor que preste servicio de transporte con un vehículo que no este legalmente autorizado':
                    $puntos = 9;
                break;
                case 'Conducir bajo los efectos de sustancias estupefacientes, drogas o en estado de embriaguez.':
                    $puntos = 10;
                break;
            }
            return $puntos;
        }

        if($status == true){
            $puntos_a_restar = calcular_puntos($datos_from_multa[1]);
            $obtener_ID = abtraer_ID('vehiculos', 'id_vehiculo', 'matricula', $datos_from_multa[0]);
            $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
            registrar_multa( intval($obtener_ID[0]['id_vehiculo']), $meses[rand(0,11)], $datos_from_multa[1], $puntos_a_restar);
        }else{
            echo "<script> alert('Campos vacios, intentelo nuevamente') </script>";
        }
    }
?>

<div class="modal fade" id="modal_multa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $title_modal; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
            <div class="form-group">
                <label for="matr"># de Matricula:</label>
                <select id="matr" class="form-control" name="Multa_matr">
                    <?php 
                        foreach($datos as $item){
                            echo "<option>".$item['matricula']."</option>";
                        }           
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="caus">Causa:</label>
                <select id="caus" name="Multa_caus" class="form-control">
                        <option>El conductor que use inadecuada y reiteradamente la bocina.</option>
                        <option>Transporte público que permita el ingreso de personas para realizar actividades de comercio.</option>
                        <option>Llevar animales domesticos en los asientos delanteros.</option>
                        <option>Los conductores que no utilicen el cinturón de seguridad. </option>
                        <option>Peatones que no transiten por las aceras o sitios de seguridad.</option>
                        <option>El conductor que invada con su vehículo las vías exclusivas.</option>
                        <option>Quien estacione un vehículo en los sitios prohibidos.</option>
                        <option>Utilizar teléfono celular mientras conduce y no haga uso del dispositivo homologado de manos libres.</option>
                        <option>El conductor de un taxi, que no utilice el taxímetro</option>
                        <option>El conductor que adelante a un vehículo de transporte escolar mientras éste se encuentre estacionado.</option>
                        <option>El conductor que desobedezca las órdenes de los agentes de tránsito</option>
                        <option>Quien conduzca un automotor sin poseer licencia para conducir.</option>
                        <option>El que conduzca un vehículo con uno o más neumáticos desgastados</option>
                        <option>Transporte material inflamable, explosivo o peligroso en vehículos no acondicionados.</option>
                        <option>El conductor que preste servicio de transporte con un vehículo que no este legalmente autorizado</option>
                        <option>Conducir bajo los efectos de sustancias estupefacientes, drogas o en estado de embriaguez.</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" class="form-control btn btn-success" name="Multa_enviar" value="Añadir Multa" />
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>