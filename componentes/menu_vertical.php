<?php
    
?>

<div id="barra_mobie" class="p-1">
    <i class="material-icons p-1" style="cursor: pointer" onclick="menu()">menu</i>
</div>

<div class="menu_vertical">
    <ul class="nav flex-column mt-4">
        <li class="nav-item mb-2">
            <a class="nav-link active" href="/"><i class="material-icons">home</i> Inicio</a>
        </li>
        <li class="nav-item mb-2">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#exampleModal"> <i class="material-icons">directions_car</i> Registrar vehiculo</a>
        </li>
        <li class="nav-item mb-2">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#modal_multa"> <i class="material-icons">receipt</i> Registrar Multa</a>
        </li>
        <li class="nav-item mb-2">
            <a class="nav-link" href="/all_multas.php"> <i class="material-icons">assignment</i> Todas las Multas</a>
        </li>
        <li class="nav-item mb-2">
            <a class="nav-link" href="/all_user_vehiculo.php"> <i class="material-icons">assignment_ind</i> Todos Us - Ve</a>
        </li>
        <li class="nav-item mb-2">
            <a class="nav-link" href="/sugerencia.php"> <i class="material-icons">import_contacts</i> Sugerencia</a>
        </li>
        <li class="nav-item mb-2" onclick="cerrar()">
            <a class="nav-link" href="#"> <i class="material-icons">cancel</i> Salir</a>
        </li>
    </ul>
    <div id="logo">
        <img width="100" height="100" src="img/lion.svg" />
    </div>
</div>

<script>
    function cerrar(){
        window.close();
    }

    function menu(){
        const menu_vert = document.querySelector('.menu_vertical');
        if(menu_vert.style.display == 'none'){
            menu_vert.style.display = 'block';
        }else{
            menu_vert.style.display = 'none';
        }
    }
</script>