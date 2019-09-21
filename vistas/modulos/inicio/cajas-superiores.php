<?php

    $item = null;
    $valor = null;
    $orden = "id";

    $ventas = ControladorVentas::ctrSumaTotalVentas();

    $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
    $totalCategorias = count($categorias);

    $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
    $totalUsuarios = count($usuarios);

    $productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);
    $totalProductos = count($productos);

?>


<div class="col-lg-3 col-xs-6">

    <div class="small-box bg-aqua">

        <div class="inner">

            <h3>S/. <?php echo number_format($ventas["total"],2); ?></h3>
            <p>Ventas</p>

        </div>

        <div class="icon">

            <i class="ion ion-social-usd"></i>

        </div>

        <a href="index.php?ruta=ventas" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>

    </div>

</div>

<div class="col-lg-3 col-xs-6">

    <div class="small-box bg-green">

        <div class="inner">

            <h3><?php echo $totalCategorias; ?></h3>
            <p>Categorías</p>

        </div>

        <div class="icon">

            <i class="ion ion-clipboard"></i>

        </div>

        <a href="index.php?ruta=categorias" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>

    </div>

</div>

<div class="col-lg-3 col-xs-6">

    <div class="small-box bg-yellow">

        <div class="inner">

              <h3><?php echo $totalUsuarios; ?></h3>
              <p>Usuarios</p>

        </div>

        <div class="icon">

            <i class="ion ion-person-add"></i>

        </div>

        <a href="index.php?ruta=usuarios" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>

    </div>

</div>

<div class="col-lg-3 col-xs-6">

    <div class="small-box bg-red">

        <div class="inner">

            <h3><?php echo $totalProductos; ?></h3>
            <p>Productos</p>

        </div>

        <div class="icon">

            <i class="ion ion-ios-cart"></i>

        </div>

        <a href="index.php?ruta=productos" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>

    </div>

</div>