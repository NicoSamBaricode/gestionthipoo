<nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>

        <ul class="nav navbar-nav flex-nowrap ml-auto">
            <div class="d-none d-sm-block topbar-divider"></div>
            <li class="nav-item dropdown no-arrow" role="presentation">
                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small"><?php echo $row['nombre']; ?></span><img class="border rounded-circle img-profile" src="/GestionThi/gestionthipoo/assets/img/logo-cnea2.png"></a>
                    <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu"><a class="dropdown-item" role="presentation" href="detalle_usuario.php"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Editar perfil</a><a class="dropdown-item" role="presentation" href=""><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Settings</a>
                        <?php if (('Admin' == $row["rol"])) { ?>
                            <a class="dropdown-item" role="presentation" href="backupAutomatico.php"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Backup de base de datos</a>
                            <a class="dropdown-item" role="presentation" href="lista_logs.php"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logs general</a>

                        <?php } ?>
                        <div class="dropdown-divider"></div><a class="dropdown-item" role="presentation" href="cerrar_sesion.php"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Cerrar Sesion</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>