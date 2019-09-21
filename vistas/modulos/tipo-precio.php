<?php

  if ($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor")
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
      
      Tipo de Precio, según la hora
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="index.php?ruta=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Tipo de Precio</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalActivarPrecioNoche">
          
          Activar Precio de Noche

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">N°</th>
           <th>Función</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $precioNoche = ControladorPrecioNoche::ctrMostrarPrecioNoche($item, $valor);

          foreach ($precioNoche as $key => $value) {
           
            echo ' <tr>

                    <td>'.($key+1).'</td>

                    <td>'.$value["funcion"].'</td>

                    <td>

                      <div class="btn-group">

                        <button class="btn btn-danger btnEliminarPrecioNoche" idPrecioNoche="'.$value["id"].'"><i class="fa fa-times"></i></button>

                      </div>  

                    </td>

                  </tr>';
          }

        ?>

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL ACTIVAR PRECIO DE NOCHE
======================================-->

<div id="modalActivarPrecioNoche" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Activar Precio de Noche</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoPrecioNoche" id="nuevoPrecioNoche" placeholder="Ingresar: noche" required autocomplete="off">

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Activar Precio de Noche</button>

        </div>

        <?php

          $crearPrecioNoche = new ControladorPrecioNoche();
          $crearPrecioNoche -> ctrCrearPrecioNoche();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

  $borrarPrecioNoche = new ControladorPrecioNoche();
  $borrarPrecioNoche -> ctrBorrarPrecioNoche();

?>
