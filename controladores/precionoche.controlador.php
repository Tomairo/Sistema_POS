<?php

class ControladorPrecioNoche{

    /* Crear Precio Noche */
    static public function ctrCrearPrecioNoche(){

		if(isset($_POST["nuevoPrecioNoche"])){

			if(preg_match('/^[noche]+$/', $_POST["nuevoPrecioNoche"])){

				$tabla = "tiposprecio";

				$datos = $_POST["nuevoPrecioNoche"];

				$respuesta = ModeloPrecioNoche::mdlIngresarPrecioNoche($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El precio de noche se ha activado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "index.php?ruta=tipo-precio";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "Debe ingresar: noche",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "index.php?ruta=tipo-precio";

							}
						})

			  	</script>';

			}

		}

	}

    /* Mostrar Precio Noche */
    static public function ctrMostrarPrecioNoche($item, $valor)
    {

		$tabla = "tiposprecio";

		$respuesta = ModeloPrecioNoche::mdlMostrarPrecioNoche($tabla, $item, $valor);

		return $respuesta;
	
    }
    
    /* Eliminar Precio Noche (Actualizar al Precio Día) */
    static public function ctrBorrarPrecioNoche(){

		if(isset($_GET["idPrecioNoche"])){

			$tabla ="tiposprecio";
			$datos = $_GET["idPrecioNoche"];

			$respuesta = ModeloPrecioNoche::mdlBorrarPrecioNoche($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "El precio noche se desactivó correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "index.php?ruta=tipo-precio";

									}
								})

					</script>';
			}
		}
		
	}

}