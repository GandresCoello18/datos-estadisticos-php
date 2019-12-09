<?php 
    include('model/general.php');
    $title_page = 'Resultados';
    $name = $_GET['buscar'];
    if(!$_GET['buscar'] || $name == ''){
        header('location: index.php');
    }
    $dato = buscar_multa($name);
    if($dato == null){
        $dato = [];
    }
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
                                <th scope="col">Matricula</th>
                                <th scope="col">Modelo</th>
                                <th scope="col">Causa</th>
                                <th scope="col">Puntos -</th>
                                <th scope="col">Mes</th>
                            </tr>
                        </thead>
                        <tbody id="filas_resultados">
                            <?php
                                foreach($dato as $item){
                                    
                                        echo "<tr>"."<th>".$item['unir_name']."</th>"."<td>".$item['matricula']."</td>"."<td>".$item['modelo']."</td>"."<td>".$item['causa']."</td>"."<td>"."- ".$item['puntos_restados']."</td>"."<td>".$item['mes']."</td>"."</tr>";   
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="row mt-2 p-4 fila_dos_diagrama">
                    
                    <a href="/all_multas.php" class="btn btn-success">Volver</a>
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

    <script>  
        let area = document.querySelector('#filas_resultados tr');
        if(area == null){
            let sms = document.createElement("div");
            sms.classList = 'alert alert-danger';
            sms.innerHTML = 'No encontramos el usuario, vuelva a intentarlo';
            document.getElementById('filas_resultados').appendChild(sms);
        }
    </script>

    </body>
</html>