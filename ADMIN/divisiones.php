<?php
require 'files/conexion.php';
require 'files/session_start.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>DIVISIONES | POSGRADOS UPVM</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        localStorage.setItem('isC', true);
        localStorage.setItem('active', 'Academia');
        localStorage.setItem('subactive', 'Divisiones');
    </script>
</head>

<body id="body" class='bodypd'>
    <main>
        <?php
        require 'files/sidebar.php';

        // refresh - Manda a llamar el contenido de la carpeta reload, para que no se recargue la pagina a la hora de hacer acciones 
        // page - Es necesario para cargar el contenido en la pagina 1
        ?>
        <div id="refresh">
            <input type="text" id="page" value="1" hidden>
        </div>
    </main>

    <?php
    require 'files/loader.php';
    require 'files/scriptJS.php';
    ?>

    <script src="js/division.js"></script>

</body>

</html>