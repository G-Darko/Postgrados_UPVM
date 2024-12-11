<?php
require 'files/conexion.php';
require 'files/session_start.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>DASHBOARD | POSGRADOS UPVM</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        localStorage.setItem('isC', false);
        localStorage.setItem('active', 'Inicio');
        localStorage.setItem('subactive', '');
    </script>
</head>

<body id="body" class='bodypd'>
    <main>
        <?php
        require 'files/sidebar.php';
        ?>

        <section class="main">
            <h1>hola</h1>
        </section>
    </main>

    <script>
        console.log('<?php echo $msgCon ?>');
    </script>
    <script src="js/main.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

</body>

</html>