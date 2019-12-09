<?php 
    include('model/general.php');
    $title_page = 'Todas las multas';
    $dato = all_multas();
?>


    <?php include('componentes/header.php'); ?>

    <section class="container-fluid">
        <div class="row justify-content-center">

            <?php include('componentes/menu_vertical.php'); ?>    

            <div class="col-12 col-md-10 contenido-derecho">
                <div class="row mt-2 p-4 fila_dos_diagrama">
                    <form class="row" action="resultados.php" method="GET">
                        <div class="col-8">
                            <input type="search" placeholder="Buscar por matricula" name="buscar" class="form-control" />
                        </div>
                        <div class="col">
                            <input type="submit" value="Buscar" class="btn btn-info form-control" />
                        </div>
                    </form>                    
                </div>
                <div class="row p-4 mt-2 fila_uno_diagrama">
                    <div class="col-12 table-responsive-sm">
                        <table class="table table-striped table-sm table-dark">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre y Apellido</th>
                                    <th scope="col">Matricula</th>
                                    <th scope="col">Modelo</th>
                                    <th scope="col">Causa</th>
                                    <th scope="col">Puntos -</th>
                                    <th scope="col">Mes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($dato as $item){
                                        
                                         echo "<tr>"."<th>".$item['unir_name']."</th>"."<td>".$item['matricula']."</td>"."<td>".$item['modelo']."</td>"."<td>".$item['causa']."</td>"."<td>"."- ".$item['puntos_restados']."</td>"."<td>".$item['mes']."</td>"."</tr>";   
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row p-4 mt-2 fila_uno_diagrama">
                    <div class="col-12">
                        <canvas id="diagrama_personal">  </canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
        $title_modal = 'Registrar Vehiculo';
        include('componentes/modal.php');
        include('componentes/form-multa.php');
        include('componentes/footer.php');
        $dato_personal = cantidad_de_multa_user();

        function colocar_user_diagrama(){
            $dato_personal = cantidad_de_multa_user();
            $reserva = "";
            foreach($dato_personal as $item){
                $concat = $item['Nombre'];
                $reserva = $reserva."'$concat',";
            }
            return $reserva;
        }

        function colocar_data_diagrama(){
            $dato_personal = cantidad_de_multa_user();
            $reserva = "";
            foreach($dato_personal as $item){
                $concat = $item['COUNT(usuario.unir_name)'];
                $reserva = $reserva."'$concat',";
            }
            return $reserva;
        }
    ?>

    <?php 
        echo "
        <script>
            var ctx_2 = document.getElementById('diagrama_personal').getContext('2d');
            var myPieChart = new Chart(ctx_2, {
                type: 'pie',
                data: {
                    labels: [". colocar_user_diagrama() ."],
                    datasets: [{
                        label: 'Multas de usuarios',
                        backgroundColor: ['rgba(220, 30, 210)', 'rgba(120, 130, 210)', 'rgba(20, 180, 90)', 'rgba(20, 230, 10)', 'rgba(80, 130, 110)'],
                        borderColor: '',
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
        </script>
        ";
    ?>

    </body>
</html>