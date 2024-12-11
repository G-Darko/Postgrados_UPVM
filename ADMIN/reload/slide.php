<?php
require '../files/conexion.php';

$queryPag = "SELECT COUNT(*) as total FROM slider";
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

$query = "SELECT * FROM slider LIMIT $desde, $xPage";
$res = $con->query($query);
?>

<section class="main">
    <div class='container'>
        <div class='title'>
            <h2>Slider</h2>
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
                        <span>Imagen</span>
                        <span>Link</span>
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
                            <img src="<?php echo $row['img']; ?>" alt="">
                        </div>
                        <span><?php echo $row['redir']; ?></span>
                    </div>
                    <div class="btns col">
                        <button title="Editar" onclick="edit(<?php echo $row['id_sli']; ?>)"><box-icon name='edit' size='md'></box-icon></button>
                        <button title="Eliminar" class='delete' onclick="deleteI(<?php echo $row['id_sli']; ?>)"><box-icon name='trash' size='md'></box-icon></button>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <?php
    // Esta funcion esta en la conexion
    paginador('reload/slide.php', $page, $tPags);
    ?>
</section>

<div id="mNew" class="modal">
    <div class="body">
        <header>
            <h2><box-icon name='plus' size='md'></box-icon> Nueva imagen</h1>
                <button class='close' onclick="modal(this.parentNode.parentNode.parentNode.getAttribute('id'), false)"><box-icon name='x' size='md'></box-icon></button>
        </header>
        <div class="form">

            <div class="inputBox imgBox">
                <img id="cn-img" src="img/pre.png" alt="No image, imagen predeterminada" onclick="subir('n-img')">
                <input type="file" required id='n-img' hidden onchange="imagenChange('n-img', 'cn-img', 'img/pre.png')">
                <span>Imagen</span>
                <i></i>
            </div>

            <div class="inputBox">
                <input type="text" required id='n-re' autocomplete="off">
                <span>Link*</span>
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
            <h2><box-icon name='edit' size='md'></box-icon> Editar imagen</h1>
                <button class='close' onclick="modal(this.parentNode.parentNode.parentNode.getAttribute('id'), false)"><box-icon name='x' size='md'></box-icon></button>
        </header>
        <div class="form">

            <div class="inputBox imgBox">
                <input type="text" hidden id='id'>
                <img id="ce-img" src="img/pre.png" alt="No image, imagen predeterminada" onclick="subir('e-img')">
                <input type="file" required id='e-img' hidden onchange="imagenChange('e-img', 'ce-img', document.getElementById('e-img').src)">
                <span>Imagen</span>
                <i></i>
            </div>

            <div class="inputBox">
                <input type="text" required id='e-re' autocomplete="off">
                <span>Link*</span>
                <i></i>
            </div>

            <button onclick="update()">Guardar</button>
        </div>
    </div>
    <div class="closeM" onclick="modal(this.parentNode.getAttribute('id'), false)"></div>
</div>