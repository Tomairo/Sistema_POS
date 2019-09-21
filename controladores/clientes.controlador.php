<?php

class ControladorClientes
{
    /* Crear clientes */
    static public function ctrCrearCliente()
    {
        if(isset($_POST["nuevoCliente"]))
        {
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCliente"]) &&
               preg_match('/^[0-9]+$/', $_POST["nuevoDNI"]) &&
               preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoEmail"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevaDireccion"]))
            {
                $tabla = "clientes";

                $datos = array("nombre"=>$_POST["nuevoCliente"],
					           "documento"=>$_POST["nuevoDNI"],
					           "email"=>$_POST["nuevoEmail"],
					           "telefono"=>$_POST["nuevoTelefono"],
					           "direccion"=>$_POST["nuevaDireccion"],
                               "fecha_nacimiento"=>$_POST["nuevaFechaNacimiento"]);
                
                $respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);

                if($respuesta == "ok")
                {
                    echo'<script>

					swal({
						  type: "success",
						  title: "El cliente ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "index.php?ruta=clientes";

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
						  title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "index.php?ruta=clientes";

							}
						})

			  	</script>';
            }
        }
    }

    /* Mostrar clientes */
    static public function ctrMostrarClientes($item, $valor)
    {
        $tabla = "clientes";

        $respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);

        return $respuesta;
    }

    /* Editar cliente */
    static public function ctrEditarCliente()
    {
        if(isset($_POST["editarCliente"]))
        {
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCliente"]) &&
               preg_match('/^[0-9]+$/', $_POST["editarDNI"]) &&
               preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarEmail"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefono"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editarDireccion"]))
            {
                $tabla = "clientes";

                $datos = array("id"=>$_POST["idCliente"],
                               "nombre"=>$_POST["editarCliente"],
					           "documento"=>$_POST["editarDNI"],
					           "email"=>$_POST["editarEmail"],
					           "telefono"=>$_POST["editarTelefono"],
					           "direccion"=>$_POST["editarDireccion"],
                               "fecha_nacimiento"=>$_POST["editarFechaNacimiento"]);
                
                $respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);

                if($respuesta == "ok")
                {
                    echo'<script>

					swal({
						  type: "success",
						  title: "El cliente ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "index.php?ruta=clientes";

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
						  title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "index.php?ruta=clientes";

							}
						})

			  	</script>';
            }
        }
    }

    /* Eliminar cliente */
    static public function ctrEliminarCliente()
    {

        if(isset($_GET["idCliente"]))
        {

			$tabla ="clientes";
			$datos = $_GET["idCliente"];

			$respuesta = ModeloClientes::mdlEliminarCliente($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El cliente ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "index.php?ruta=clientes";

								}
							})

				</script>';

			}		
		}
	}
}
