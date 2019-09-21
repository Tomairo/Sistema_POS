<?php

    $item = null;
    $valor = null;
    $orden = "id";

    $productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);
    $totalProductos = count($productos);

?>

<div class="box box-primary">

    <div class="box-header with-border">

        <h3 class="box-title">Últimos 10 productos agregados</h3>

        <div class="box-tools pull-right">

                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                </button>

                <button type="button" class="btn btn-box-tool" data-widget="remove">
                    <i class="fa fa-times"></i>
                </button>

        </div>

    </div>

    <div class="box-body">

        <ul class="products-list product-list-in-box">

        <?php

        for($i = 0; $i < 10; $i++)
        {

            echo    '<li class="item">

                        <div class="product-img">
                            <img src="'.$productos[$i]["imagen"].'" alt="Product Image">
                        </div>

                        <div class="product-info">

                            <a href="" class="product-title">

                                '.$productos[$i]["descripcion"].'
                                <span class="label label-success pull-right"> S/. '.number_format($productos[$i]["precio_venta"],2).'</span>

                            </a>

                        </div>

                    </li>';

        }

        ?>

        </ul>

    </div>

    <div class="box-footer text-center">

        <a href="index.php?ruta=productos" class="uppercase">Ver todos los productos</a>

    </div>

</div>