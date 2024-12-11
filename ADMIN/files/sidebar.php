<aside class="sidebar expand" id="side">
    <nav class="nav">
        <div class='mC'>
            <div class="brand">
                <box-icon name='menu' size='md' id='toggle'></box-icon>
                <a href="#" class='logo'>UPVM</a>
            </div>
            <div class="list">
                <a href="dashboard.php" class="link">
                    <box-icon name='home' type='solid'></box-icon>
                    <span class="name">Inicio</span>
                </a>
                <div class="item">
                    <div class="link collapse">
                        <box-icon type='solid' name='graduation'></box-icon>
                        <span class="name">Academia</span>

                        <box-icon type='solid' name='chevron-down' class="arrow"></box-icon>

                    </div>
                    <ul class="menu">
                        <a href="divisiones.php" class="sublink">
                            <box-icon type='solid' name='institution'></box-icon>
                            <span class="name">Divisiones</span>
                        </a>
                        <a href="maestrias.php" class="sublink">
                            <box-icon type='solid' name='book'></box-icon>
                            <span class="name">Maestrias</span>
                        </a>
                    </ul>
                </div>
                <div class="item">
                    <div class="link collapse">
                        <box-icon type='solid' name='group'></box-icon>
                        <span class="name">Docentes</span>

                        <box-icon type='solid' name='chevron-down' class="arrow"></box-icon>

                    </div>
                    <ul class="menu">
                        <a href="Investigadores.php" class="sublink">
                            <box-icon type='solid' name='user-voice'></box-icon>
                            <span class="name">Investigadores</span>
                        </a>
                        <a href="directores.php" class="sublink">
                            <box-icon type='solid' name='user'></box-icon>
                            <span class="name">Directores</span>
                        </a>
                    </ul>
                </div>
                <div class="item">
                    <div class="link collapse">
                        <box-icon name='list-ol'></box-icon>
                        <span class="name">Niveles</span>

                        <box-icon type='solid' name='chevron-down' class="arrow"></box-icon>

                    </div>
                    <ul class="menu">
                        <a href="tipos.php" class="sublink">
                            <box-icon type='solid' name='book-add'></box-icon>
                            <span class="name">Tipo de posgrado</span>
                        </a>
                        <a href="niveles.php" class="sublink">
                            <box-icon type='solid' name='watch'></box-icon>
                            <span class="name">Nivel de maestro</span>
                        </a>
                    </ul>
                </div>
                <div class="item">
                    <div class="link collapse">
                        <box-icon type='solid' name='dashboard'></box-icon>
                        <span class="name">Contenido</span>

                        <box-icon type='solid' name='chevron-down' class="arrow"></box-icon>

                    </div>
                    <ul class="menu">
                        <a href="slider.php" class="sublink">
                            <box-icon name='image' type='solid' ></box-icon>
                            <span class="name">Slider</span>
                        </a>
                        <a href="wrapper.php" class="sublink">
                            <box-icon name='info-circle' type='solid' ></box-icon>
                            <span class="name">Informacion</span>
                        </a>
                    </ul>
                </div>
                <a href="admins.php" class="link">
                    <box-icon type='solid' name='check-shield'></box-icon>
                    <span class="name">Administradores</span>
                </a>
            </div>
        </div>
        <a target="_blank" href="../" class="link no">
            <box-icon name='world'></box-icon>
            <span class="name">Página pública</span>
        </a>
        <a href="files/logout.php" class="link no">
            <box-icon name='log-out'></box-icon>
            <span class="name">Cerrar sesion</span>
        </a>
    </nav>
</aside>

<nav class='topBar'>
    <span>Admin: <?php echo $user; ?></span>
    <span>Correo: <?php echo $correo; ?></span>
</nav>