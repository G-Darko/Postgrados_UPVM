<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>INICIO | POSGRADOS UPVM</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    require 'ADMIN/files/conexion.php';
    require_once 'files/header.php';
    ?>
    <main>

        <section class="slider">
            <?php
            $query = "SELECT * FROM slider";
            $res = $con->query($query);
            while ($row = $res->fetch_assoc()) {
            ?>
                <div class="slide">
                    <a target="_blank" href="<?php echo $row['redir'] ?>">
                        <img src="ADMIN/<?php echo $row['img'] ?>" alt="">
                    </a>
                </div>
            <?php
            }
            ?>
            <div class="slider_btn btn-right" id="btn-right"></div>
            <div class="slider_btn btn-left" id="btn-left"></div>

        </section>

        <section class="wrapper">
            <div class="slider_btn btn-left" id="wLeft"></div>
            <ul class="carousel">
                <?php
                $query = "SELECT * FROM wrapper";
                $res = $con->query($query);
                while ($row = $res->fetch_assoc()) {
                ?>
                    <li class="card">
                        <div class="img">
                            <img src="ADMIN/<?php echo $row['img']?>" draggable="false" alt="">
                        </div>
                        <h2><?php echo $row['titulo']?></h2>
                        <span><?php echo $row['descripcion']?></span>
                        <a target="_blank" href="<?php echo $row['redir'] ?>">Ver más</a>
                    </li>
                <?php
                }
                ?>
            </ul>
            <div class="slider_btn btn-right" id="wRight"></div>
        </section>
    </main>

    <?php
    require_once 'files/footer.php';
    require_once 'files/scriptJS.php';
    ?>
    <script src="js/slider.js"></script>
    <script src="js/wrapper.js"></script>
</body>


</html>