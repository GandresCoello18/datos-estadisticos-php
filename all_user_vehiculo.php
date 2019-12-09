<?php 
    include('model/general.php');
    $title_page = 'Todo los usuarios y vehiculos';
    $dato = all_user_vehiculo();
?>


    <?php include('componentes/header.php'); ?>
    <section class="container-fluid">
        <div class="row justify-content-center">

            <?php include('componentes/menu_vertical.php'); ?>    

            <div class="col-12 col-md-10 contenido-derecho">
                <div class="row p-4 mt-2 fila_uno_diagrama">
                    <table class="table table-striped table-sm table-dark">
                        <thead>
                            <tr>
                                <th scope="col">Nombre y Apellido</th>
                                <th scope="col">Puntos</th>
                                <th scope="col">Matricula</th>
                                <th scope="col">Modelo</th>
                                <th scope="col">Color</th>
                            </tr>
                        </thead>
                        <tbody id="filas_resultados">
                            <?php
                                foreach($dato as $item){   
                                    echo "<tr>"."<th>".$item['unir_name']."</th>"."<td>".$item['puntos']."</td>"."<td>".$item['matricula']."</td>"."<td>".$item['modelo']."</td>"."<td>".$item['color']."</td>"."</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="row mt-2 p-4 fila_dos_diagrama">
                    
                </div>
            </div>
        </div>
    </section>

    <?php
        $title_modal = 'Registrar Vehiculo';
        include('componentes/modal.php');
        include('componentes/form-multa.php');
        include('componentes/footer.php');
    ?>

    </body>
</html>