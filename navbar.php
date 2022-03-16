<nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="far fa-clipboard"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>THI Gestión</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="nav navbar-nav text-light" id="accordionSidebar">
                    <!-- arranca admin -->
                    <?php if ('admin' == $row["rol"]) { ?>
                        <li class="nav-item" role="presentation"><a class="nav-link active" href="panel.php"><i class="fas fa-tachometer-alt"></i><span>Panel Principal</span></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link " href="Lista_Dedicacion.php"><i class="fas fa-list"></i><span>Mi Dedicación</span></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="Lista_Usuarios.php"><i class="fas fa-user"></i><span>Usuarios</span></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="Lista_Proyectos.php"><i class="fas fa-table"></i><span>Proyectos</span></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="Lista_Tareas.php"><i class="fas fa-list"></i><span>Tareas</span></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="Lista_actividades.php"><i class="fas fa-chart-pie"></i><span>Actividades</span></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="Lista_Recursos.php"><i class="fas fa-warehouse"></i><span>Recursos</span></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link " href="Configuracion.php"><i class="fas fa-cog"></i><span>Configuración</span></a></li>

                        <li class="nav-item" role="presentation"><a class="nav-link" href="cerrar_sesion.php"><i class="fas fa-user-circle"></i><span>Cerrar Sesión</span></a></li>

                        <?php } ?>
                    <!-- termina admin -->
                    <!-- arranca jefe -->
                    <?php if ('jefe' == $row["rol"]) { ?>
                        <li class="nav-item" role="presentation"><a class="nav-link active" href="panel.php"><i class="fas fa-tachometer-alt"></i><span>Panel Principal</span></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="Lista_Proyectos.php"><i class="fas fa-table"></i><span>Proyectos</span></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="Lista_Tareas.php"><i class="fas fa-list"></i><span>Tareas</span></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="Lista_Recursos.php"><i class="fas fa-warehouse"></i><span>Recursos</span></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="cerrar_sesion.php"><i class="fas fa-user-circle"></i><span>Cerrar Sesión</span></a></li>
                    <?php } ?>
                    <!-- termina jefe -->

                    <!-- arranca taller -->
                    <?php if ('Taller' == $row["rol"]) { ?>
                        <li class="nav-item" role="presentation"><a class="nav-link active" href="panel.php"><i class="fas fa-tachometer-alt"></i><span>Panel Principal</span></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="Lista_Proyectos.php"><i class="fas fa-table"></i><span>Proyectos</span></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="Lista_Tareas.php"><i class="fas fa-list"></i><span>Tareas</span></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="Lista_Recursos.php"><i class="fas fa-warehouse"></i><span>Recursos</span></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="cerrar_sesion.php"><i class="fas fa-user-circle"></i><span>Cerrar Sesión</span></a></li>
                    <?php } ?>
                    <!-- termina taller -->

                    <!-- arranca agente -->
                    <?php if ('agente' == $row["rol"]) { ?>
                        <li class="nav-item" role="presentation"><a class="nav-link active" href="panel.php"><i class="fas fa-tachometer-alt"></i><span>Panel Principal</span></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="Lista_Proyectos.php"><i class="fas fa-table"></i><span>Proyectos</span></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="Lista_Tareas.php"><i class="fas fa-list"></i><span>Tareas</span></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="cerrar_sesion.php"><i class="fas fa-user-circle"></i><span>Cerrar Sesión</span></a></li>
                    <?php } ?>
                    <!-- termina agente -->

                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>