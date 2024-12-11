<?php
require '../files/conexion.php';

$queryPag = "SELECT COUNT(*) as total FROM directores";
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

$query = "SELECT di.*, d.nombre AS nomdiv FROM directores di INNER JOIN division d ON d.id_div = di.id_div LIMIT $desde, $xPage";
$res = $con->query($query);
?>

<section class="main">
    <div class='container'>
        <div class='title'>
            <h2>Directores</h2>
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
                        <span>Director</span>
                        <span>Division</span>
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
                        <span><?php echo $row['nomdiv']; ?></span>
                    </div>
                    <div class="btns col">
                        <button title="Editar" onclick="edit(<?php echo $row['id_direc']; ?>)"><box-icon name='edit' size='md'></box-icon></button>
                        <button title="Eliminar" class='delete' onclick="deleteI(<?php echo $row['id_direc']; ?>)"><box-icon name='trash' size='md'></box-icon></button>
                    </div>
                </div>

            <?php
            }
            ?>
        </div>
    </div>

    <?php 
    // Esta funcion esta en la conexion
    paginador('reload/director.php', $page, $tPags); 
    ?>
</section>

<div id="mNew" class="modal">
    <div class="body">
        <header>
            <h2><box-icon name='plus' size='md'></box-icon> Nuevo director</h1>
                <button class='close' onclick="modal(this.parentNode.parentNode.parentNode.getAttribute('id'), false)"><box-icon name='x' size='md'></box-icon></button>
        </header>
        <div class="form">

            <div class="inputBox">
                <input type="text" required id='n-name' autocomplete="off">
                <span>Nombre*</span>
                <i></i>
            </div>
            
            <div class="inputBox">
                <input type="text" required id='n-co' autocomplete="off">
                <span>Correo*</span>
                <i></i>
            </div>

            <div class="inputBox">
                <select id="n-div" required>
                    <?php
                    $query = "SELECT * FROM division";
                    $res = $con->query($query);
                    while ($row = $res->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $row['id_div']; ?>"><?php echo $row['nombre']; ?></option>
                    <?php } ?>
                </select>
                <span>Division*</span>
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
            <h2><box-icon name='edit' size='md'></box-icon> Editar director</h1>
                <button class='close' onclick="modal(this.parentNode.parentNode.parentNode.getAttribute('id'), false)"><box-icon name='x' size='md'></box-icon></button>
        </header>
        <div class="form">

            <div class="inputBox">
                <input type="text" hidden id='id'>
                <input type="text" required id='e-name' autocomplete="off">
                <span>Nombre</span>
                <i></i>
            </div>

            <div class="inputBox">
                <input type="text" required id='e-co' autocomplete="off">
                <span>Correo*</span>
                <i></i>
            </div>

            <div class="inputBox">
                <select id="e-div" required>
                    <?php
                    $query = "SELECT * FROM division";
                    $res = $con->query($query);
                    while ($row = $res->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $row['id_div']; ?>"><?php echo $row['nombre']; ?></option>
                    <?php } ?>
                </select>
                <span>Division*</span>
                <i></i>
            </div>

            <button onclick="update()">Guardar</button>
        </div>
    </div>
    <div class="closeM" onclick="modal(this.parentNode.getAttribute('id'), false)"></div>
</div>