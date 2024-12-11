<?php
require '../files/conexion.php';

$queryPag = "SELECT COUNT(*) as total FROM usuarios";
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
$query = "SELECT u.*, r.nombre AS nomrol FROM usuarios u INNER JOIN rol r ON r.id_rol = u.id_rol LIMIT $desde, $xPage";
$res = $con->query($query);
?>

<section class="main">
    <div class='container'>
        <div class='title'>
            <h2>Administradores</h2>
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
                        <span>Usuario</span>
                        <span>Correo</span>
                        <span>Rol</span>
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
                        <span><?php echo $row['usuario']; ?></span>
                        <span><?php echo $row['correo']; ?></span>
                        <span><?php echo $row['nomrol']; ?></span>
                    </div>
                    <div class="btns col">
                        <button title="Editar" onclick="edit(<?php echo $row['id_usu']; ?>)"><box-icon name='edit' size='md'></box-icon></button>
                        <button title="Eliminar" class='delete' onclick="deleteI(<?php echo $row['id_usu']; ?>)"><box-icon name='trash' size='md'></box-icon></button>
                    </div>
                </div>

            <?php
            }
            ?>

        </div>
    </div>

    <?php
    // Esta funcion esta en la conexion
    paginador('reload/admin.php', $page, $tPags);
    ?>

</section>

<div id="mNew" class="modal">
    <div class="body">
        <header>
            <h2><box-icon name='plus' size='md'></box-icon> Nuevo usuario</h1>
                <button class='close' onclick="modal(this.parentNode.parentNode.parentNode.getAttribute('id'), false)"><box-icon name='x' size='md'></box-icon></button>
        </header>
        <div class="form">

            <div class="inputBox">
                <input type="text" required id='n-usu' autocomplete="off">
                <span>Usuario*</span>
                <i></i>
            </div>

            <div class="inputBox">
                <input type="text" required id='n-co' autocomplete="off">
                <span>Correo*</span>
                <i></i>
            </div>

            <div class="inputBox">
                <input type="password" required id='n-pass' autocomplete="off" class='pass'>
                <span>Contraseña*</span>
                <i></i>
                <button class="sP" id="n-sp" title='Mostrar Contraseña' onclick="btnPass('n-sp', 'n-pass', 'n-bxP')">
                    <box-icon name='show-alt' id='n-bxP' size='md' color='#2ecc71'></box-icon>
                </button>
            </div>

            <div class="inputBox">
                <input type="password" required id='n-cpass' autocomplete="off" class='pass'>
                <span>Confirmar contraseña*</span>
                <i></i>
                <button class="sP" id="n-spc" title='Mostrar Contraseña' onclick="btnPass('n-spc', 'n-cpass', 'n-bxC')">
                    <box-icon name='show-alt' id='n-bxC' size='md' color='#2ecc71'></box-icon>
                </button>
            </div>

            <div class="inputBox">
                <select id="n-rol" required>
                    <?php
                    $query = "SELECT * FROM rol";
                    $res = $con->query($query);
                    while ($row = $res->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $row['id_rol']; ?>"><?php echo $row['nombre']; ?></option>
                    <?php } ?>
                </select>
                <span>Rol*</span>
                <i></i>
            </div>

            <button onclick="newI()">Agregar</button>
        </div>
    </div>
    <div class="closeM" onclick="modal(this.parentNode.getAttribute('id'), false)"></div>
</div>

<div id="mEdit" class="modal change">
    <div class="body">
        <header>
            <h2><box-icon name='edit' size='md'></box-icon> Editar usuario</h1>
                <button class='close' onclick="modal(this.parentNode.parentNode.parentNode.getAttribute('id'), false)"><box-icon name='x' size='md'></box-icon></button>
        </header>
        <div class="form">

            <div class="inputBox">
                <input type="text" hidden id='id'>
                <input type="text" required id='e-usu' autocomplete="off">
                <span>Usuario*</span>
                <i></i>
            </div>

            <div class="inputBox">
                <input type="text" required id='e-co' autocomplete="off">
                <span>Correo*</span>
                <i></i>
            </div>

            <div class="inputBox">
                <select id="e-rol" required>
                    <?php
                    $query = "SELECT * FROM rol";
                    $res = $con->query($query);
                    while ($row = $res->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $row['id_rol']; ?>"><?php echo $row['nombre']; ?></option>
                    <?php } ?>
                </select>
                <span>Rol*</span>
                <i></i>
            </div>

            <button onclick="modal('mPass', true)">Cambiar contraseña</button> <br>

            <button onclick="update()">Guardar</button>
        </div>
    </div>
    <div class="closeM" onclick="modal(this.parentNode.getAttribute('id'), false)"></div>
</div>

<div id="mPass" class="modal">
    <div class="body">
        <header>
            <h2><box-icon name='edit' size='md'></box-icon> Cambiar contraseña</h1>
                <button class='close' onclick="modal(this.parentNode.parentNode.parentNode.getAttribute('id'), false)"><box-icon name='x' size='md'></box-icon></button>
        </header>
        <div class="form">

            <div class="inputBox">
                <input type="password" required id='e-pact' autocomplete="off" class='pass'>
                <span>Contraseña actual*</span>
                <i></i>
                <button class="sP" id="e-spa" title='Mostrar Contraseña' onclick="btnPass('e-spa', 'e-pact', 'e-bxPa')">
                    <box-icon name='show-alt' id='e-bxPa' size='md' color='#2ecc71'></box-icon>
                </button>
            </div>

            <div class="inputBox">
                <input type="password" required id='e-pass' autocomplete="off" class='pass'>
                <span>Nueva Contraseña*</span>
                <i></i>
                <button class="sP" id="e-sp" title='Mostrar Contraseña' onclick="btnPass('e-sp', 'e-pass', 'e-bxP')">
                    <box-icon name='show-alt' id='e-bxP' size='md' color='#2ecc71'></box-icon>
                </button>
            </div>

            <div class="inputBox">
                <input type="password" required id='e-cpass' autocomplete="off" class='pass'>
                <span>Confirmar contraseña*</span>
                <i></i>
                <button class="sP" id="e-spc" title='Mostrar Contraseña' onclick="btnPass('e-spc', 'e-cpass', 'e-bxC')">
                    <box-icon name='show-alt' id='e-bxC' size='md' color='#2ecc71'></box-icon>
                </button>
            </div>

            <button onclick="changeP()">Guardar</button>
        </div>
    </div>
    <div class="closeM" onclick="modal(this.parentNode.getAttribute('id'), false)"></div>
</div>