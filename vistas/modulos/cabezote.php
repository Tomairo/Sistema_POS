<header class="main-header">
    <!-- ===== LOGOTIPO ===== -->
    <a href="index.php?ruta=inicio" class="logo">
        <!-- logo mini -->
        <span class="logo-mini">
            <img src="vistas/img/plantilla/icono-blanco.png" class="img-responsive" style="padding:10px"><img>
        </span>
         <!-- logo normal -->
         <span class="logo-ñg">
            <img src="vistas/img/plantilla/logo-blanco-lineal.png" class="img-responsive" style="padding:10px 0px"><img>
        </span>
    </a>

    <!-- ===== SIDEBAR ===== -->
    <nav class="navbar navbar-static-top" role="navigation">

        <!-- Botón de navegación -->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"> 
            <span class="sr-only">Toggle Navigation</span>
        </a>

        <!-- Perfil de Usuario -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav"> 
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php 

                            if($_SESSION["foto"] != "")
                            {
                                echo "<img src='".$_SESSION["foto"]."' class='user-image'>";
                            }
                            else
                            {
                                echo "<img src='vistas/img/usuarios/default/anonymous.png' class='user-image'>";
                            }
                         
                        ?>
                        
                        <span class="hidden-xs"><?php echo $_SESSION["nombre"]; ?></span>
                    </a>

                    <!-- Dropdown-toggle -->
                    <ul class="dropdown-menu">
                        <li class="user-body">
                            <div class="pull-right">
                                <a href="index.php?ruta=salir" class="btn btn-default btn-flat">Salir</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        
    </nav>
</header>