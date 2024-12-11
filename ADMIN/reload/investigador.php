<?php
require '../files/conexion.php';

$queryPag = "SELECT COUNT(*) as total FROM investigadores";
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
$query = "SELECT i.*, d.nombre AS nomdiv, n.nombre AS nomNiv FROM investigadores i INNER JOIN division d ON d.id_div = i.id_div INNER JOIN nivel n ON n.id_niv = i.id_niv LIMIT $desde, $xPage";
$res = $con->query($query);
?>

<section class="main">
    <div class='container'>
        <div class='title'>
            <h2>Investigadores</h2>
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
                        <span>Investigador</span>
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
                        <button title="Editar" onclick="edit(<?php echo $row['id_in']; ?>, quillsE())"><box-icon name='edit' size='md'></box-icon></button>
                        <button title="Eliminar" class='delete' onclick="deleteI(<?php echo $row['id_in']; ?>)"><box-icon name='trash' size='md'></box-icon></button>
                    </div>
                </div>

            <?php
            }
            ?>

        </div>
    </div>

    <?php
    // Esta funcion esta en la conexion
    paginador('reload/investigador.php', $page, $tPags);
    ?>

</section>

<div id="mNew" class="modal">
    <div class="body">
        <header>
            <h2><box-icon name='plus' size='md'></box-icon> Nuevo investigador</h1>
                <button class='close' onclick="modal(this.parentNode.parentNode.parentNode.getAttribute('id'), false)"><box-icon name='x' size='md'></box-icon></button>
        </header>
        <div class="form">
            <div class="inputBox">
                <input type="text" required id='n-name' autocomplete="off">
                <span>Nombre*</span>
                <i></i>
            </div>

            <div class="inputBox">
                <input type="text" required id='n-lic' autocomplete="off">
                <span>Licenciatura*</span>
                <i></i>
            </div>

            <div class="inputBox">
                <input type="text" required id='n-mae' autocomplete="off">
                <span>Maestria*</span>
                <i></i>
            </div>

            <div class="inputBox">
                <input type="text" required id='n-doc' autocomplete="off">
                <span>Doctorado</span>
                <i></i>
            </div>

            <div class="inputBox">
                <input type="text" required id='n-co' autocomplete="off">
                <span>Correo</span>
                <i></i>
            </div>

            <span class="nameQuill">Semblanza*</span>
            <div id="n-sam" class='quill'>
            </div>

            <div class="inputBox imgBox">
                <img id="cn-img" src="img/pre.png" alt="No image, imagen predeterminada" onclick="subir('n-img')">
                <input type="file" required id='n-img' hidden onchange="imagenChange('n-img', 'cn-img', 'img/pre.png')">
                <span>Imagen</span>
                <i></i>
            </div>

            <div class="inputBox">
                <select id="n-niv" required>
                    <?php
                    $query = "SELECT * FROM nivel";
                    $res = $con->query($query);
                    while ($row = $res->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $row['id_niv']; ?>"><?php echo $row['nombre']; ?></option>
                    <?php } ?>
                </select>
                <span>Nivel*</span>
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
            <h2><box-icon name='edit' size='md'></box-icon> Editar investigador</h1>
                <button class='close' onclick="modal(this.parentNode.parentNode.parentNode.getAttribute('id'), false)"><box-icon name='x' size='md'></box-icon></button>
        </header>
        <div class="form">
            <div class="inputBox">
                <input type="text" hidden id='id'>
                <input type="text" required id='e-name'>
                <span>Nombre</span>
                <i></i>
            </div>

            <div class="inputBox">
                <input type="text" required id='e-lic' autocomplete="off">
                <span>Licenciatura*</span>
                <i></i>
            </div>

            <div class="inputBox">
                <input type="text" required id='e-mae' autocomplete="off">
                <span>Maestria*</span>
                <i></i>
            </div>

            <div class="inputBox">
                <input type="text" required id='e-doc' autocomplete="off">
                <span>Doctorado</span>
                <i></i>
            </div>

            <div class="inputBox">
                <input type="text" required id='e-co' autocomplete="off">
                <span>Correo</span>
                <i></i>
            </div>

            <span class="nameQuill">Samblanza*</span>
            <div id="e-sam" class='quill'>
            </div>

            <div class="inputBox imgBox">
                <img id="ce-img" src="img/pre.png" alt="No image, imagen predeterminada" onclick="subir('e-img')">
                <input type="file" required id='e-img' hidden onchange="imagenChange('e-img', 'ce-img', document.getElementById('e-img').src)">
                <span>Imagen</span>
                <i></i>
            </div>

            <div class="inputBox">
                <select id="e-niv" required>
                    <?php
                    $query = "SELECT * FROM nivel";
                    $res = $con->query($query);
                    while ($row = $res->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $row['id_niv']; ?>"><?php echo $row['nombre']; ?></option>
                    <?php } ?>
                </select>
                <span>Nivel*</span>
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