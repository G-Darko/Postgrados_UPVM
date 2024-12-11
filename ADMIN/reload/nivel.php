<?php
require '../files/conexion.php';

$queryPag = "SELECT COUNT(*) as total FROM nivel";
$resPag = $con->query($queryPag);
$resT = $resPag->fetch_assoc();
$total = $resT['total'];

$xPage = 5;
$page = $_POST['page'];
$tPags = ceil($total / $xPage);
if ($page <= 0 || ($page > $tPags && $page != 1)) {
    $page = $tPags;
}
$desde = ($page - 1) * $xPage;

$query = "SELECT * FROM nivel LIMIT $desde, $xPage";
$res = $con->query($query);
?>

<section class="main">
    <div class='container'>
        <div class='title'>
            <h2>Nivel</h2>
            <button title="Agregar" onclick="modal('mNew', true)"><box-icon name='plus' size='md'></box-icon></button>
        </div>
        <div class="table">
            <?php
            if ($total == 0) {
            ?>
                <div class="row head">
                    <div class="infoBD col">
                        <span>Aún no hay registros, agrega con el icono de más <i>(+)</i></span>
                    </div>
                    <div class="btns col">
                        <button title="Agregar" onclick="modal('mNew', true)"><box-icon name='plus' size='md'></box-icon></button>
                    </div>
                </div>
                ;
            <?php
            } else {


            ?>
                <div class="row head">
                    <div class="infoBD col">
                        <span>Nombre</span>
                    </div>
                    <div class="btns col">
                        <span>Acción</span>
                    </div>
                </div>
            <?php
            }
            while ($row = $res->fetch_assoc()) {
            ?>
                <div class='row'>
                    <div class="infoBD col">
                        <span><?php echo $row['nombre']; ?></span>
                    </div>
                    <div class="btns col">
                        <button title="Editar" onclick="edit(<?php echo $row['id_niv']; ?>)"><box-icon name='edit' size='md'></box-icon></button>
                        <button title="Eliminar" class='delete' onclick="deleteI(<?php echo $row['id_niv']; ?>)"><box-icon name='trash' size='md'></box-icon></button>
                    </div>
                </div>

            <?php
            }
            ?>

        </div>
    </div>

    <?php 
    // Esta funcion esta en la conexion
    paginador('reload/nivel.php', $page, $tPags); 
    ?>

</section>

<div id="mNew" class="modal">
    <div class="body">
        <header>
            <h2><box-icon name='plus' size='md'></box-icon> Nuevo nivel</h1>
                <button class='close' onclick="modal(this.parentNode.parentNode.parentNode.getAttribute('id'), false)"><box-icon name='x' size='md'></box-icon></button>
        </header>
        <div class="form">
            <div class="inputBox">
                <input type="text" required id='n-name' autocomplete="off">
                <span>Nombre*</span>
                <i></i>
            </div>
            <button onclick="newI()">Agregar</button>
        </div>
    </div>
    <div class="closeM" onclick="modal(this.parentNode.getAttribute('id'), false)"></div>
</div>

<div id="mEdit" class="modal">
    <div class="body">
        <header>
            <h2><box-icon name='edit' size='md'></box-icon> Editar nivel</h1>
                <button class='close' onclick="modal(this.parentNode.parentNode.parentNode.getAttribute('id'), false)"><box-icon name='x' size='md'></box-icon></button>
        </header>
        <div class="form">
            <div class="inputBox">
                <input type="text" hidden id='id'>
                <input type="text" required id='e-name' autocomplete="off">
                <span>Nombre*</span>
                <i></i>
            </div>
            <button onclick="update()">Guardar</button>
        </div>
    </div>
    <div class="closeM" onclick="modal(this.parentNode.getAttribute('id'), false)"></div>
</div>