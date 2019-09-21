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
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Usuarios
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?ruta=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar usuarios</li>
      </ol>
    </section>

    <section class="content">

      <div class="box">

        <div class="box-header with-border">

          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
            Agregar usuario
          </button>

        </div>
        <div class="box-body">
        
          <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

            <thead>
              <tr>
                <th style="width: 10px">N°</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Foto</th>
                <th>Perfil</th>
                <th>Estado</th>
                <th>Última Conexión</th>
                <th>Acciones</th>
              </tr>
            </thead>

            <tbody>

              <?php

                $item = null;
                $valor = null;

                $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

                foreach($usuarios as $key => $value)
                {
                  echo "<tr>
                          <td>".($key+1)."</td>
                          <td>".$value["nombre"]."</td>
                          <td>".$value["usuario"]."</td>";

                          if($value["foto"] != "")
                          {
                            echo "<td><img src='".$value["foto"]."' class='img-thumbnail' width='40px'></td>";
                          }
                          else
                          {
                            echo "<td><img src='vistas/img/usuarios/default/anonymous.png' class='img-thumbnail' width='40px'></td>";
                          }
                          
                          echo "<td>".$value["perfil"]."</td>";

                          if($value["estado"] != 0)/* Si el usuario está activado */
                          {
                            echo "<td><button class='btn btn-success btn-xs btnActivar' idUsuario='".$value["id"]."' estadoUsuario='0'>Activado</button></td>";
                          }
                          else
                          {
                            echo "<td><button class='btn btn-danger btn-xs btnActivar' idUsuario='".$value["id"]."' estadoUsuario='1'>Desactivado</button></td>";
                          }

                          echo "<td>".$value["ultimo_login"]."</td>
                                <td>
                                  
                                  <div class='btn-group'>
                
                                    <button class='btn btn-warning btnEditarUsuario' idUsuario='".$value["id"]."' data-toggle='modal' data-target='#modalEditarUsuario'><i class='fa fa-pencil'></i></button>
                                    <button class='btn btn-danger btnEliminarUsuario' idUsuario='".$value["id"]."' fotoUsuario='".$value["foto"]."' usuario='".$value["usuario"]."' ><i class='fa fa-times'></i></button>
                
                                  </div>
                
                                </td>
                        </tr>";
                }

              ?>
              
            </tbody>

          </table>
        </div>
      </div>
    </section>
  </div>

  <!-- 
    ==== MODAL AGREGAR USUARIO ====
  -->
  <div id="modalAgregarUsuario" class="modal fade" role="dialog">

    <div class="modal-dialog">

      <div class="modal-content">

        <form role="form" method="post" enctype="multipart/form-data"><!-- enctype="multipart/form-data" nos sirve porque subiremos archivos -->

          <!-- Cabecera del modal -->
          <div class="modal-header" style="background:#3c8dbc; color: white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Agregar Usuario</h4>

          </div>

          <!-- Cuerpo del modal -->
          <div class="modal-body">
            
            <div class="box-body">

              <!-- entrada para nombre -->
              <div class="form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required autocomplete="off">

                </div>

              </div>

              <!-- entrada para usuario -->
              <div class="form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                  <input type="text" class="form-control input-lg" name="nuevoUsuario" id="nuevoUsuario" placeholder="Ingresar usuario" required autocomplete="off">
                  
                </div>

              </div>

              <!-- entrada para contraseña -->
              <div class="form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                  <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar contraseña" required>
                  
                </div>

              </div>

              <!-- entrada para seleccionar perfil -->
              <div class="form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-users"></i></span>

                  <select class="form-control input-lg" name="nuevoPerfil">

                    <option value="">Seleccionar perfil</option>
                    <option value="Administrador">Administrador</option>
                    <option value="Especial">Especial</option>
                    <option value="Vendedor">Vendedor</option>

                  </select>
                  
                </div>

              </div>

              <!-- entrada para subir foto -->
              <div class="form-group">

                <div class="panel">Subir foto</div>
                <input type="file" class="nuevaFoto" name="nuevaFoto">
                <p class="help-block">Peso máximo de la foto: 2 MB</p>
                <img src="vistas/img/usuarios/default/anonymous.png" alt="imagen-perfil" class="img-thumbnail previsualizar" width="100px">

              </div>

            </div>

          </div>

          <!-- Footer del modal -->
          <div class="modal-footer">
            
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Guardar usuario</button>
            <!-- El botón que sirve para enviar los datos del formulario al servidor debe ser de tipo 'submit' 
                los demás botones genéricos serán de tipo 'button'
            -->

          </div>

          <?php

            $crearUsuario = new ControladorUsuarios();
            $crearUsuario-> ctrCrearUsuario();
 
          ?>

        </form>
      </div>
    </div>
  </div>

  <!-- 
    ==== MODAL EDITAR USUARIO ====
  -->
  <div id="modalEditarUsuario" class="modal fade" role="dialog">

    <div class="modal-dialog">

      <div class="modal-content">

        <form role="form" method="post" enctype="multipart/form-data"><!-- enctype="multipart/form-data" nos sirve porque subiremos archivos -->

          <!-- Cabecera del modal -->
          <div class="modal-header" style="background:#3c8dbc; color: white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Editar Usuario</h4>

          </div>

          <!-- Cuerpo del modal -->
          <div class="modal-body">
            
            <div class="box-body">

              <!-- entrada para actualizar nombre -->
              <div class="form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required autocomplete="off">

                </div>

              </div>

              <!-- entrada para actualizar usuario -->
              <div class="form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                  <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" readonly autocomplete="off">
                  
                </div>

              </div>

              <!-- entrada para actualizar contraseña -->
              <div class="form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                  <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Escriba la nueva contraseña">
                  <input type="hidden" id="passwordActual" name="passwordActual">

                </div>

              </div>

              <!-- entrada para actualizar el perfil -->
              <div class="form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-users"></i></span>

                  <select class="form-control input-lg" name="editarPerfil">

                    <option value="" id="editarPerfil"></option>
                    <option value="Administrador">Administrador</option>
                    <option value="Especial">Especial</option>
                    <option value="Vendedor">Vendedor</option>

                  </select>
                  
                </div>

              </div>

              <!-- entrada para actualizar la foto -->
              <div class="form-group">

                <div class="panel">Subir foto</div>
                <input type="file" class="nuevaFoto" name="editarFoto">
                <p class="help-block">Peso máximo de la foto: 2 MB</p>
                <img src="vistas/img/usuarios/default/anonymous.png" alt="imagen-perfil" class="img-thumbnail previsualizar" width="100px">
                <input type="hidden" id="fotoActual" name="fotoActual">

              </div>

            </div>

          </div>

          <!-- Footer del modal -->
          <div class="modal-footer">
            
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
            <!-- El botón que sirve para enviar los datos del formulario al servidor debe ser de tipo 'submit' 
                los demás botones genéricos serán de tipo 'button'
            -->

          </div>

          <?php

            $editarUsuario = new ControladorUsuarios();
            $editarUsuario-> ctrEditarUsuario();
 
          ?>

        </form>
      </div>
    </div>
  </div>

  <!-- BORRAR UN USUARIO -->
  <?php

    $borrarUsuario = new ControladorUsuarios();
    $borrarUsuario -> ctrBorrarUsuario();

  ?>