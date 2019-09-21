<?php

  if ($_SESSION["perfil"] == "Vendedor" || $_SESSION["perfil"] == "Especial")
  {
    echo '<script>

            window.location = "index.php?ruta=inicio";

          </script>';
    
    return;
  }

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Ranking Productos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="index.php?ruta=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Ranking productos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border"></div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaRankingProductos" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">N°</th>
           <th>Imagen</th>
           <th>Código</th>
           <th>Descripción</th>
           <th>Categoría</th>
           <th>Ventas</th>
           <th>% Ventas</th>
           <th>Precio de compra</th>
           <th>Precio de venta</th>

         </tr> 

        </thead>

        <!-- <tbody>

        <?php

          $item = null;
          $valor = null;
          $cantidad_ventas = "ventas";

          $productos = ControladorProductos::ctrMostrarRankingProductos($item, $valor, $cantidad_ventas);

          foreach($productos as $key => $value)
          {
            echo "<tr>
                    <td>".($key+1)."</td>
                    <td><img src='vistas/img/productos/default/anonymous.png' class='img-thumbnail' width='40px'></td>
                    <td>".$value["codigo"]."</td>
                    <td>".$value["descripcion"]."</td>";

                    $item = "id";
                    $valor = $value["id_categoria"];

                    $categoria = ControladorCategorias::ctrMostrarCategorias($item, $valor);

              echo "<td>".$categoria["categoria"]."</td>
                    <td>".$value["ventas"]."</td>
                    <td>".$value["precio_compra"]."</td>
                    <td>".$value["precio_venta"]."</td>

                  </tr>";
          }

        ?>

        </tbody> -->

       </table>

      </div>

    </div>

  </section>

</div>