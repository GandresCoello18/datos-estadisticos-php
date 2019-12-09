<?php 
    include('model/general.php');
    $title_page = 'Sugerencia';
    $dato = sugerencia();
?>


    <?php include('componentes/header.php'); ?>
    <section class="container-fluid">
        <div class="row justify-content-center">

            <?php include('componentes/menu_vertical.php'); ?>    

            <div class="col-12 col-md-10 contenido-derecho">
                <div class="row p-4 mt-2 fila_uno_diagrama">
                    <div class="col-12">
                        <?php 
                            foreach($dato as $item){
                                echo "<strong>El mes  <code> " .$item['mes'] ."</code> se ah considerado como mas peligroso de: le sugiero trabajar en <code>". $item['causa'] ."</code> </strong>";
                            }
                        ?>
                    </div>   
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