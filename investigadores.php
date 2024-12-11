<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>INVESTIGADOREs | POSGRADOS UPVM</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    require 'ADMIN/files/conexion.php';
    require_once 'files/header.php';
    $queryD = "SELECT * FROM division";
    $resD = $con->query($queryD);
    $resD2 = $con->query($queryD);
    ?>
    <main>
        <div class="tabs">
            <div class="btns">
                <button class="active" onclick="tab(0)">Todos</button>
                <?php
                while ($rowD = $resD->fetch_assoc()) {
                ?>
                    <button onclick="tab(<?php echo $rowD['id_div'] ?>)"><?php echo $rowD['nombre'] ?></button>
                <?php
                }
                ?>
            </div>
            <div class="tab" id="tab1">
                <h2>Todos los investigadores</h2>
                <div class="profiles">
                    <div class="wrapp">
                        <?php
                        $id_div = $rowD2['id_div'];
                        $query = "SELECT i.*, n.nombre AS nomNiv FROM investigadores i INNER JOIN nivel n ON n.id_niv = i.id_niv ORDER BY id_div";
                        $res = $con->query($query);
                        while ($row = $res->fetch_assoc()) {
                        ?>
                            <div class="profile">
                                <div class="img">
                                    <img src="ADMIN/<?php echo $row['img'] ?>" alt="">
                                    <ul class="icons">
                                        <li>
                                            <button onclick="get_data(<?php echo $row['id_in'] ?>, '<?php echo $row['nomNiv'] ?>')">Más información</button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="name">
                                    <h2><?php echo $row['nombre'] ?></h2>
                                    <div class="bio">
                                        <?php echo $row['samblanza'] ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
            while ($rowD2 = $resD2->fetch_assoc()) {
            ?>
                <div class="tab" id="tab<?php echo ($rowD2['id_div'] + 1) ?>">
                    <h2><?php echo $rowD2['nombre'] ?></h2>
                    <div class="profiles">
                        <div class="wrapp">
                            <?php
                            $id_div = $rowD2['id_div'];
                            $query = "SELECT i.*, n.nombre AS nomNiv FROM investigadores i INNER JOIN nivel n ON n.id_niv = i.id_niv WHERE id_div = $id_div";
                            $res = $con->query($query);
                            $tot = $res->num_rows;
                            if ($tot > 0) {
                                while ($row = $res->fetch_assoc()) {
                            ?>
                                    <div class="profile">
                                        <div class="img">
                                            <img src="ADMIN/<?php echo $row['img'] ?>" alt="">
                                            <ul class="icons">
                                                <li>
                                                    <button onclick="get_data(<?php echo $row['id_in'] ?>, '<?php echo $row['nomNiv'] ?>')">Más información</button>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="name">
                                            <h2><?php echo $row['nombre'] ?></h2>
                                            <div class="bio">
                                                <?php echo $row['samblanza'] ?>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            } else {
                                echo "No hay investigadores registrados";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </main>

    <div id="mView" class="modal profile">
        <div class="body">
            <button class='close' onclick="modal(this.parentNode.parentNode.getAttribute('id'), false)"><box-icon name='x' size='md'></box-icon></button>

            <div class="card">
                <img id="img" src="ADMIN/img/pre.png" alt="">
                <div class="info" id="info">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor ratione, tempora eius animi maxime aliquid praesentium molestias quam tempore, id architecto mollitia, consequatur aut aliquam amet obcaecati repudiandae ducimus sed.
                </div>
            </div>
        </div>
        <div class="closeM" onclick="modal(this.parentNode.getAttribute('id'), false)"></div>
    </div>

    <?php
    $con->close();
    require_once 'files/footer.php';
    require_once 'files/scriptJS.php';
    ?>
    <script src="js/invest.js"></script>

</body>


</html>