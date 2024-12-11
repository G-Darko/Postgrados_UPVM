<?php
require 'files/conexion.php';
session_start();
if (isset($_SESSION['id'])) {
    header('Location: dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>ADMIN - Login | POSGRADOS UPVM</title>
    <link rel="stylesheet" href="css/styleLogin.css">
</head>

<body>
    <header>
        <h2>ADMIN | POSGRADOS - UPVM</h2>
    </header>
    <div class="box">
        <span class="boderLine"></span>
        <div class="form">
            <h2>Ingresar</h2>
            <div class="inputBox">
                <input type="text" required id='user'>
                <span><box-icon name='user-circle'></box-icon> Usuario</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input type="password" required id='pass'>
                <span><box-icon name='key' type='solid'></box-icon> Contraseña</span>
                <i></i>
                <button id="sp" title='Mostrar Contraseña'>
                    <box-icon name='show-alt' id='bxIcon' size='md'></box-icon>
                </button>
            </div>
            <button class='btn' id='log'>Entrar</button>
        </div>
    </div>

    <script>
        console.log('<?php echo $msgCon ?>');
    </script>
    <script src="js/login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

</body>

</html>