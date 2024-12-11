<?php
require '../files/conexion.php';

$queryPag = "SELECT COUNT(*) as total FROM maestria";
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

// $query = "SELECT * FROM maestria LIMIT $desde, $xPage";
$query = "SELECT m.*, d.nombre AS nomdiv FROM maestria m INNER JOIN division d ON d.id_div = m.id_div LIMIT $desde, $xPage";
$res = $con->query($query);
?>

<section class="main">
    <div class='container'>
        <div class='title'>
            <h2>Maestrias</h2>
            <button title="Agregar" onclick="modal('mNew', true), quillsN()"><box-icon name='plus' size='md'></box-icon></button>
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
                        <button title="Agregar" onclick="modal('mNew', true), quillsN()"><box-icon name='plus' size='md'></box-icon></button>
                    </div>
                </div>
                ;
            <?php
            } else {
            ?>
                <div class="row head">
                    <div class="infoBD col">
                        <span>Maestria</span>
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
                        <div class="nomImg">
                            <span><?php echo $row['nombre']; ?></span>
                            <img src="<?php echo $row['img']; ?>" alt="">
                        </div>
                        <span><?php echo $row['nomdiv']; ?></span>
                    </div>
                    <div class="btns col">
                        <button title="Editar" onclick="edit(<?php echo $row['id_ma']; ?>, quillsE())"><box-icon name='edit' size='md'></box-icon></button>
                        <button title="Eliminar" class='delete' onclick="deleteI(<?php echo $row['id_ma']; ?>)"><box-icon name='trash' size='md'></box-icon></button>
                    </div>
                </div>

            <?php
            }
            ?>

        </div>
    </div>

    <?php 
    // Esta funcion esta en la conexion
    paginador('reload/maestria.php', $page, $tPags); 
    ?>

</section>

<div id="mNew" class="modal">
    <div class="body">
        <header>
            <h2><box-icon name='plus' size='md'></box-icon> Nueva maestria</h1>
                <button class='close' onclick="modal(this.parentNode.parentNode.parentNode.getAttribute('id'), false)"><box-icon name='x' size='md'></box-icon></button>
        </header>
        <div class="form">
            <div class="inputBox">
                <input type="text" required id='n-name' autocomplete="off">
                <span>Nombre*</span>
                <i></i>
            </div>

            <span class="nameQuill">Objetivo*</span>
            <div id="n-ob" class='quill'>
            </div>

            <span class="nameQuill">Perfil de Ingreso*</span>
            <div id="n-pi" class='quill'>
            </div>

            <span class="nameQuill">Requisitos de Ingreso*</span>
            <div id="n-req" class='quill'>
            </div>

            <span class="nameQuill">Perfil de Egreso*</span>
            <div id="n-pe" class='quill'>
            </div>

            <span class="nameQuill">Campo de trabajo*</span>
            <div id="n-campo" class='quill'>
            </div>

            <span class="nameQuill">Competencias profecionales*</span>
            <div id="n-compe" class='quill'>
            </div>

            <div class="inputBox imgBox">
                <img id="cn-img" src="img/pre.png" alt="No image, imagen predeterminada" onclick="subir('n-img')">
                <input type="file" required id='n-img' hidden onchange="imagenChange('n-img', 'cn-img', 'img/pre.png')">
                <span>Imagen</span>
                <i></i>
            </div>

            <div class="inputBox">
                <select id="n-tipo" required>
                    <?php
                    $query = "SELECT * FROM tipo";
                    $res = $con->query($query);
                    while ($row = $res->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $row['id_tipo']; ?>"><?php echo $row['nombre']; ?></option>
                    <?php } ?>
                </select>
                <span>Tipo*</span>
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

            <span class="nameQuill">Opciones de Tiulacion</span>
            <div id="n-op" class='quill'>
            </div>

            <button onclick="newI()">Agregar</button>
        </div>
    </div>
    <div class="closeM" onclick="modal(this.parentNode.getAttribute('id'), false)"></div>
</div>

<div id="mEdit" class="modal">
    <div class="body">
        <header>
            <h2><box-icon name='edit' size='md'></box-icon> Editar maestria</h1>
                <button class='close' onclick="modal(this.parentNode.parentNode.parentNode.getAttribute('id'), false)"><box-icon name='x' size='md'></box-icon></button>
        </header>
        <div class="form">
            <div class="inputBox">
                <input type="text" hidden id='id'>
                <input type="text" required id='e-name'>
                <span>Nombre</span>
                <i></i>
            </div>

            <span class="nameQuill">Objetivo*</span>
            <div id="e-ob" class='quill'>
            </div>

            <span class="nameQuill">Perfil de Ingreso*</span>
            <div id="e-pi" class='quill'>
            </div>

            <span class="nameQuill">Requisitos de Ingreso*</span>
            <div id="e-req" class='quill'>
            </div>

            <span class="nameQuill">Perfil de Egreso*</span>
            <div id="e-pe" class='quill'>
            </div>

            <span class="nameQuill">Campo de trabajo*</span>
            <div id="e-campo" class='quill'>
            </div>

            <span class="nameQuill">Competencias profecionales*</span>
            <div id="e-compe" class='quill'>
            </div>

            <div class="inputBox imgBox">
                <img id="ce-img" src="img/pre.png" alt="No image, imagen predeterminada" onclick="subir('e-img')">
                <input type="file" required id='e-img' hidden onchange="imagenChange('e-img', 'ce-img', document.getElementById('e-img').src)">
                <span>Imagen</span>
                <i></i>
            </div>

            <div class="inputBox">
                <select id="e-tipo" required>
                    <?php
                    $query = "SELECT * FROM tipo";
                    $res = $con->query($query);
                    while ($row = $res->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $row['id_tipo']; ?>"><?php echo $row['nombre']; ?></option>
                    <?php } ?>
                </select>
                <span>Tipo*</span>
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

            <span class="nameQuill">Opciones de Tiulacion</span>
            <div id="e-op" class='quill'>
            </div>

            <button onclick="update()">Guardar</button>
        </div>
    </div>
    <div class="closeM" onclick="modal(this.parentNode.getAttribute('id'), false)"></div>
</div>