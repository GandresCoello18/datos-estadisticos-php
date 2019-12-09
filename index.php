<?php 
    include('model/general.php');
    $title_page = 'Principal';
    $tabla_mes_causa = mes_causa(3);
    $tabla_user_puntos_quitados = tabla_user_puntos_restantes();
?>


    <?php include('componentes/header.php'); ?>
    <section class="container-fluid">
        <div class="row justify-content-center">

            <?php include('componentes/menu_vertical.php'); ?>    

            <div class="col-12 col-md-10 contenido-derecho">
                <div class="row p-4 mt-2 fila_uno_diagrama">
                    <div class="col-12 col-md-6">
                        <canvas id="primero">

                        </canvas>
                    </div>
                    <div class="col-12 col-md-6">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Mes</th>
                                    <th scope="col">Causa</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                foreach($tabla_mes_causa as $item){
                                    echo "
                                        <tr>
                                            <td>".$item['mes']."</td>
                                            <td>".$item['causa']."</td>
                                        </tr>
                                    ";
                                }
                            ?>
                            </tbody>
                        </table>        
                    </div>
                    <!--<a href="#" class="btn btn-success">Ver estadisticas completas</a>-->
                </div>
                <div class="row mt-2 p-4 fila_dos_diagrama">
                    <div class="col-12 col-md-6">
                        <canvas id="segundo">

                        </canvas>
                    </div>
                    <div class="col-12 col-md-6">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Usuarios</th>
                                    <th scope="col">Puntos Quitados</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach($tabla_user_puntos_quitados as $item){
                                        echo "
                                            <tr>
                                                <td>".$item['unir_name']."</td>
                                                <td>".$item['SUM(multa.puntos_restados)']."</td>
                                            </tr>
                                        ";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!--<a href="#" class="btn btn-success">Ver estadisticas completas</a>-->
                </div>
            </div>
        </div>
    </section>

    <?php
        $title_modal = 'Registrar Vehiculo';
        include('componentes/modal.php');
        include('componentes/form-multa.php');
        include('componentes/footer.php');

        function colocar_data_diagrama(){
            $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
            $reserva = "";
            for($i = 0; $i < count($meses); $i++){
                $dato_mes = valor_mes($meses[$i]);
                foreach($dato_mes as $item){
                    $concat = $item['COUNT(mes)'];
                    $reserva = $reserva."'$concat',";
                }
            }
            return $reserva;
        }

        function colocar_nombre_mes(){
            $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
            $reserva = "";
            for($i = 0; $i < count($meses); $i++){
                $dato_mes = mes_name($meses[$i]);
                foreach($dato_mes as $item){
                    $concat = $item['mes'];
                    $reserva = $reserva."'$concat',";
                }
            }
            return $reserva;
        }

        function colocar_nombre_ultimo_diagrama($tipo){
            $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
            $reserva = "";
            $reserva_2 = "";
                $dato_mes = tabla_user_puntos_restantes();;
                foreach($dato_mes as $item){
                    $concat = $item['unir_name'];
                    $reserva = $reserva."'$concat',";
                    //////////////////////
                    $concat_2 = $item['SUM(multa.puntos_restados)'];
                    $reserva_2 = $reserva_2."'$concat_2',";
                }
            if($tipo == 'nombres'){
                return $reserva;
            }else{
                return $reserva_2;
            }
        }

    ?>

    <?php 
        echo "
            <script>
                var ctx = document.getElementById('primero').getContext('2d');
                var myBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [". colocar_nombre_mes() ."],
                        datasets: [{
                            label: 'Multas por mes',
                            backgroundColor: ['rgb(255, 99, 132)', 'rgb(235, 9, 37)', 'rgb(183, 199, 132)', 'rgb(72, 39, 132)', 'rgb(25, 199, 232)', 'rgb(25, 99, 132)', 'rgb(250, 190, 13)', 'rgb(200, 89, 232)', 'rgb(255, 99, 132)', 'rgb(255, 99, 232)', 'rgb(25, 99, 12)', 'rgb(255, 99, 132)'],
                            borderColor: 'rgb(255, 99, 132)',
                            data: [". colocar_data_diagrama() ."]
                        }]
                    },
                    options:{
                        scales: {
                            xAxes: [{
                                gridLines: {
                                    offsetGridLines: true
                                }
                            }]
                        }
                    }
                });
            ///////////////////////////////////
            var ctx_2 = document.getElementById('segundo').getContext('2d');
            var myPieChart = new Chart(ctx_2, {
                type: 'doughnut',
                data: {
                    labels: [".colocar_nombre_ultimo_diagrama('nombres')."],
                    datasets: [{
                        label: 'Datos por año',
                        backgroundColor: ['rgba(220, 30, 210)', 'rgba(120, 130, 210)', 'rgba(20, 180, 90)', 'rgba(20, 230, 10)'],
                        borderColor: '',
                        data: [".colocar_nombre_ultimo_diagrama('datos')."]
                    }]
                },
                options:{
                    scales: {
                        xAxes: [{
                            gridLines: {
                                offsetGridLines: true
                            }
                        }]
                    }
                }
            });

            </script>
        ";
    ?>


    </body>
</html>