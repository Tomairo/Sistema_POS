<?php

class ControladorProductos
{
    /* Mostrar Productos */
    static public function ctrMostrarProductos($item, $valor, $orden)
    {
        $tabla = "productos";

        $respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor, $orden);

        return $respuesta;
    }

    /* Mostrar Ranking de Productos */
    static public function ctrMostrarRankingProductos($item, $valor, $cantidad_ventas)
    {
        $tabla = "productos";

        $respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor, $cantidad_ventas);

        return $respuesta;

    }

    /* Crear Productos */
    static public function ctrCrearProducto()
    {
        if(isset($_POST["nuevaDescripcion"]))
        {
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcion"]) && 
               preg_match('/^[0-9]+$/', $_POST["nuevoStock"]) &&
               preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioCompra"]) &&
               preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioVenta"]))
               {
                   $ruta = "vistas/img/productos/default/anonymous.png";

                   /* Validar imagen */

                   if(isset($_FILES["nuevaImagen"]["tmp_name"]))
                   {
                        list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);

                        $nuevoAlto = 500;
                        $nuevoAncho = 500;

                        /* Creamos el directorio donde vamos a guardar las fotos del usuario */

                        $directorio = "vistas/img/productos/".$_POST["nuevoCodigo"];

                        mkdir($directorio, 0755);/* creamos el directorio, 0755 son los permisos de lectura y escritura */

                        /* De acuerdo al tipo de imagen aplicamos las funciones por defecto de PHP */

                        if($_FILES["nuevaImagen"]["type"] == "image/jpeg")
                        {
                            /* Guardamos la imagen en el directorio */

                            $aleatorio = mt_rand(100,900); /* será el nombre de la imagen (es aleatorio para que no se repite el nombre) */
                            
                            $ruta = "vistas/img/productos/".$_POST["nuevoCodigo"]."/".$aleatorio.".jpg";

                            $origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);

                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                            imagejpeg($destino, $ruta);
                        }

                        if($_FILES["nuevaImagen"]["type"] == "image/png")
                        {
                            /* Guardamos la imagen en el directorio */

                            $aleatorio = mt_rand(100,900); /* será el nombre de la imagen (es aleatorio para que no se repite el nombre) */
                            
                            $ruta = "vistas/img/productos/".$_POST["nuevoCodigo"]."/".$aleatorio.".png";

                            $origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);

                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                            imagepng($destino, $ruta);
                        }
                    }

                   $tabla = "productos";

                   $datos = array("id_categoria" => $_POST["nuevaCategoria"],
                                  "codigo" => $_POST["nuevoCodigo"],
                                  "descripcion" => $_POST["nuevaDescripcion"],
                                  "stock" => $_POST["nuevoStock"],
                                  "precio_compra" => $_POST["nuevoPrecioCompra"],
                                  "precio_venta" => $_POST["nuevoPrecioVenta"],
                                  "imagen" => $ruta);

                    $respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);

                    if($respuesta == "ok")
                    {
                        echo'<script>

                                swal({
                                    type: "success",
                                    title: "¡El producto ha sido guardado correctamente!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                    }).then(function(result){
                                        if (result.value) {

                                        window.location = "index.php?ruta=productos";

                                        }
                                    })

			  	            </script>';
                    }

               }
               else
               {
                echo'<script>

                        swal({
                            type: "error",
                            title: "¡El producto no puede ir con los campos o llevar caracteres especiales!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if (result.value) {

                                window.location = "index.php?ruta=productos";

                                }
                            })

                    </script>';
               }
        }
    }

    /* Editar Productos */
    static public function ctrEditarProducto()
    {
        if(isset($_POST["editarDescripcion"]))
        {
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcion"]) && 
               preg_match('/^[0-9]+$/', $_POST["editarStock"]) &&
               preg_match('/^[0-9.]+$/', $_POST["editarPrecioCompra"]) &&
               preg_match('/^[0-9.]+$/', $_POST["editarPrecioVenta"]))
               {
                   $ruta = $_POST["imagenActual"];

                   /* Validar imagen */

                   if(isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"]))
                   {
                        list($ancho, $alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]);

                        $nuevoAlto = 500;
                        $nuevoAncho = 500;

                        /* Creamos el directorio donde vamos a guardar las fotos del usuario */

                        $directorio = "vistas/img/productos/".$_POST["editarCodigo"];

                        /* Preguntamos si existe otra imagen en la base de datos */

                        if(!empty($_POST["imagenActual"]) && $_POST["imagenActual"] != "vistas/img/productos/default/anonymous.png")
                        {/* Si ya hay una ruta de imagen en la BD y dicha ruta no es la de imagen anónima */

                            unlink($_POST["imagenActual"]);/* borramos dicha ruta de imagen */

                        }
                        else
                        {
                            mkdir($directorio, 0755);/* creamos el directorio, 0755 son los permisos de lectura y escritura */
                        }

                       

                        /* De acuerdo al tipo de imagen aplicamos las funciones por defecto de PHP */

                        if($_FILES["editarImagen"]["type"] == "image/jpeg")
                        {
                            /* Guardamos la imagen en el directorio */

                            $aleatorio = mt_rand(100,900); /* será el nombre de la imagen (es aleatorio para que no se repite el nombre) */
                            
                            $ruta = "vistas/img/productos/".$_POST["editarCodigo"]."/".$aleatorio.".jpg";

                            $origen = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);

                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                            imagejpeg($destino, $ruta);
                        }

                        if($_FILES["editarImagen"]["type"] == "image/png")
                        {
                            /* Guardamos la imagen en el directorio */

                            $aleatorio = mt_rand(100,900); /* será el nombre de la imagen (es aleatorio para que no se repite el nombre) */
                            
                            $ruta = "vistas/img/productos/".$_POST["editarCodigo"]."/".$aleatorio.".png";

                            $origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);

                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                            imagepng($destino, $ruta);
                        }
                    }

                   $tabla = "productos";

                   $datos = array("id_categoria" => $_POST["editarCategoria"],
                                  "codigo" => $_POST["editarCodigo"],
                                  "descripcion" => $_POST["editarDescripcion"],
                                  "stock" => $_POST["editarStock"],
                                  "precio_compra" => $_POST["editarPrecioCompra"],
                                  "precio_venta" => $_POST["editarPrecioVenta"],
                                  "imagen" => $ruta);

                    $respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);

                    if($respuesta == "ok")
                    {
                        echo'<script>

                                swal({
                                    type: "success",
                                    title: "¡El producto ha sido editado correctamente!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                    }).then(function(result){
                                        if (result.value) {

                                        window.location = "index.php?ruta=productos";

                                        }
                                    })

			  	        </script>';
                    }

               }
               else
               {
                    echo'<script>

                        swal({
                            type: "error",
                            title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if (result.value) {

                                window.location = "index.php?ruta=productos";

                                }
                            })

                    </script>';
               }
        }
    }

    /* Eliminar Productos */
    static public function ctrEliminarProducto()
    {
        if(isset($_GET["idProducto"]))
        {
            $tabla = "productos";
            $datos = $_GET["idProducto"];

            if($_GET["imagen"] != "" && $_GET["imagen"] != "vistas/img/productos/default/anonymous.png")
            {
                unlink($_GET["imagen"]);
                rmdir("vistas/img/productos/".$_GET["codigo"]);
            }

            $respuesta = ModeloProductos::mdlEliminarProducto($tabla, $datos);

            if($respuesta == "ok")
            {
                echo'<script>
                        swal({
                            type: "success",
                            title: "¡El producto ha sido borrado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if (result.value) {

                                window.location = "index.php?ruta=productos";

                                }
                            })
			  	    </script>';
            }
        }
    }

    /* Mostrar Suma Ventas */
    static public function ctrMostrarSumaVentas()
    {
        $tabla = "productos";

        $respuesta = ModeloProductos::mdlMostrarSumaVentas($tabla);

        return $respuesta;
    }
}

