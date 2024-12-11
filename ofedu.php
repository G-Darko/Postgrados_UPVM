<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>OFERTA EDUCATIVA | POSGRADOS UPVM</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    require 'ADMIN/files/conexion.php';
    require_once 'files/header.php';
    $query = "SELECT m.*, d.nombre AS nomdiv FROM maestria m INNER JOIN division d ON d.id_div = m.id_div ORDER BY id_tipo";
    $res = $con->query($query);
    $con->close();
    ?>
    <main>
        <div class="cards">
            <?php
            while ($row = $res->fetch_assoc()) {
            ?>
                <article class="card" id="maestria<?php echo $row['id_ma'] ?>">
                    <div class="preview" onclick="get_data(<?php echo $row['id_ma'] ?>)">
                        <img src="ADMIN/<?php echo $row['img'] ?>" alt="<?php echo $row['nomdiv'] . ' UPVM, ' . $row['nombre'] ?>">
                    </div>
                    <div class="content">
                        <h4 class="title"><?php echo $row['nombre'] ?></h4>
                        <div class="bottom">
                            <div class="propieties" title="<?php echo $row['nomdiv'] ?>"><?php echo $row['nomdiv'] ?></div>
                            <button class="btn" onclick="get_data(<?php echo $row['id_ma'] ?>)">Saber más</button>
                        </div>
                    </div>
                </article>
            <?php
            }
            ?>
        </div>
    </main>

    <div id="mView" class="modal">
        <div class="body">
            <header>
                <h2 id="mae">Nombre</h2>
                <button class='close' onclick="modal(this.parentNode.parentNode.parentNode.getAttribute('id'), false)"><box-icon name='x' size='md'></box-icon></button>
            </header>
            <div class="main">
                <section>
                    <div class="img">
                        <img id="img" src="ADMIN/img/pre.png" alt="">
                    </div>
                    <div class="info" id="info">

                    </div>
                </section>
            </div>
        </div>
        <div class="closeM" onclick="modal(this.parentNode.getAttribute('id'), false)"></div>
    </div>

    <?php
    require_once 'files/footer.php';
    require_once 'files/scriptJS.php';
    ?>
    <script src="js/ofedu.js"></script>

</body>


</html>