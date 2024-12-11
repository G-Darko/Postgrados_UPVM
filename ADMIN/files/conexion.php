<?php
//crear variables conexion
$servername = "localhost";
$bd = "posgrados";
$username = "root";
$password = "";

// $response = new stdClass();
error_reporting(0); //ocultar o mostrar los errores 
//crear la conexion

$con = mysqli_connect($servername, $username, $password, $bd);
$msgCon = "";
//validar nuestra conexion.
if (!$con) {
    $msgCon = die("Conexion Fallida.." . mysqli_connect_error());
} else {
    $msgCon = "--C";
}
//echo $msgCon;
// Fin de la conexcion

// Imprime el paginador en las paginas que sea necesario
function paginador($url, $page, $tPags)
{
?>
    <div class="paginador" id="pag">
        <ul>
            <?php
            if ($page != 1) {
            ?>
                <li><a onclick="(paginador(1, '<?php echo $url; ?>'))">|&#60;&#60;</a>
                </li>
                <li><a onclick="(paginador(<?php echo $page - 1 ?>, '<?php echo $url; ?>'))">&#60;</a>
                </li>
                <?php
            }
            if ($tPags <= 5) {
                for ($i = 1; $i <= $tPags; $i++) {
                    if ($i == $page) {
                        echo '<li class="pageSelect">' . $i . '</li>';
                    } else {
                ?>
                        <li>
                            <a onclick="(paginador(<?php echo $i ?>, '<?php echo $url; ?>'))"><?php echo $i ?>
                            </a>
                        </li>
                    <?php
                    }
                }
            } else {
                for ($i = max(1, min($page, $tPags - 2)); $i < max(3, min($page + 3, $tPags + 1)); $i++) {
                    if ($i == $page) {
                        echo '<li class="pageSelect">' . $i . '</li>';
                    } else {
                    ?>
                        <li>
                            <a onclick="(paginador(<?php echo $i ?>, '<?php echo $url; ?>'))"><?php echo $i ?>
                            </a>
                        </li>
                <?php
                    }
                }
            }
            if ($page != $tPags && $tPags > 0) {
                ?>
                <li><a onclick="(paginador(<?php echo $page + 1 ?>, '<?php echo $url; ?>'))">&#62;</a></li>
                <li><a onclick="(paginador(<?php echo $tPags ?>, '<?php echo $url; ?>'))">&#62;&#62;|</a></li>
            <?php
            }
            ?>
        </ul>
    </div>
    <input type="text" id="page" value="<?php echo $page ?>" hidden>
<?php
}

function comprobar_email($email)
{
    return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? 1 : 0;
}