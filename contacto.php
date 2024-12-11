<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>CONTACTO | POSGRADOS UPVM</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    require 'ADMIN/files/conexion.php';
    require_once 'files/header.php';
    ?>
    <main>

        <div class="contact">
            <table>
                <thead>
                    <tr>
                        <th>Division</th>
                        <th>Director</th>
                        <th>Correo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                $query = "SELECT di.*, d.nombre AS nomdiv FROM directores di INNER JOIN division d ON d.id_div = di.id_div";
                $res = $con->query($query);
                while ($row = $res->fetch_assoc()) {
                ?>
                    <tr>
                        <td data-label="Division"><?php echo $row['nomdiv']?></td>
                        <td data-label="Director"><?php echo $row['nombre']?></td>
                        <td data-label="Correo"><?php echo $row['correo']?></td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>

    </main>

    <?php
    require_once 'files/footer.php';
    require_once 'files/scriptJS.php';
    ?>
</body>


</html>