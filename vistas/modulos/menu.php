<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">

            <?php
            
                if ($_SESSION["perfil"] == "Administrador") 
                {
                    echo    '<li class="active">
                                <a href="index.php?ruta=inicio">
                                    <i class="fa fa-home"></i>
                                    <span>Inicio</span>
                                </a>
                            </li>

                            <li>
                                <a href="index.php?ruta=usuarios">
                                    <i class="fa fa-user"></i>
                                    <span>Usuarios</span>
                                </a>
                            </li>

                            <li>
                                <a href="index.php?ruta=tipo-precio">
                                    <i class="fa fa-clock-o"></i>
                                    <span>Tipo de Precio</span>
                                </a>
                            </li>';
                }

                if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial") 
                {
                    echo    '<li>
                                <a href="index.php?ruta=categorias">
                                    <i class="fa fa-th"></i>
                                    <span>Categorías</span>
                                </a>
                            </li>

                            <li>
                                <a href="index.php?ruta=productos">
                                    <i class="fa fa-product-hunt"></i>
                                    <span>Productos</span>
                                </a>
                            </li>';
                }

                if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor")
                {
                    echo    '<li>
                                <a href="index.php?ruta=clientes">
                                    <i class="fa fa-users"></i>
                                    <span>Clientes</span>
                                </a>
                            </li>';
                }

                if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor")
                {
                    echo    '<li class="treeview">
                                <a href="#">
                                    <i class="fa fa-usd"></i>
                                    <span>Ventas</span>
                
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li>
                                        <a href="index.php?ruta=ventas">
                                            <i class="fa fa-briefcase"></i>
                                            <span>Administrar Ventas</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index.php?ruta=crear-venta">
                                            <i class="fa fa-money"></i>
                                            <span>Crear Ventas</span>
                                        </a>
                                    </li>';
                }

                if ($_SESSION["perfil"] == "Administrador")
                {
                    echo            '<li>
                                        <a href="index.php?ruta=reportes">
                                            <i class="fa fa-bar-chart"></i>
                                            <span>Reporte de Ventas</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>';
                }

                if ($_SESSION["perfil"] == "Administrador")
                {
                    echo '<li>
                            <a href="index.php?ruta=ranking-productos">
                                <i class="fa fa-line-chart"></i>
                                <span>Ranking de Productos</span>
                            </a>
                        </li>';
                }

            ?>
                      
        </ul>
    </section>
</aside>