<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";


class TablaRankingProductos{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaRankingProductos(){

		$item = null;
		$valor = null;
		$cantidad_ventas = "ventas";

		$productos = ControladorProductos::ctrMostrarRankingProductos($item, $valor, $cantidad_ventas);	
		
  		$datosJson = '{
		  "data": [';

		 $suma_ventas = 0;

		 for ($i = 0; $i < count($productos); $i++)
		 { 
			$suma_ventas = $suma_ventas + $productos[$i]["ventas"];
		 }

		  for($i = 0; $i < count($productos); $i++){

		  	/*=============================================
 	 		TRAEMOS LA IMAGEN
  			=============================================*/ 

		  	$imagen = "<img src='".$productos[$i]["imagen"]."' width='40px'>";

		  	/*=============================================
 	 		TRAEMOS LA CATEGORÍA
  			=============================================*/ 

		  	$item = "id";
		  	$valor = $productos[$i]["id_categoria"];

		  	$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

		  	/*=============================================
 	 		CANTIDAD DE VENTAS
  			=============================================*/ 

            if($productos[$i]["ventas"] >= 1)
            {

  				$ventas = "<button class='btn btn-primary'>".$productos[$i]["ventas"]."</button>";

            }
            else
            {

  				$ventas = "<button class='btn btn-danger'>".$productos[$i]["ventas"]."</button>";

			}

			/*=============================================
 	 		PORCENTAJE DE VENTAS
			=============================================*/
			
			$porcentaje_ventas = ($productos[$i]["ventas"]/$suma_ventas)*100;

			if ($porcentaje_ventas >= 45)
			{
				$total_porcentaje_ventas = "<button class='btn btn-success'>".number_format($porcentaje_ventas,2)."%</button>";
			}
			elseif ($porcentaje_ventas >= 30)
			{
				$total_porcentaje_ventas = "<button class='btn btn-primary'>".number_format($porcentaje_ventas,2)."%</button>";
			}
			elseif ($porcentaje_ventas >= 20)
			{
				$total_porcentaje_ventas = "<button class='btn btn-info'>".number_format($porcentaje_ventas,2)."%</button>";
			}
			elseif ($porcentaje_ventas >= 9)
			{
				$total_porcentaje_ventas = "<button class='btn btn-secondary'>".number_format($porcentaje_ventas,2)."%</button>";
			}
			else
			{
				$total_porcentaje_ventas = "<button class='btn btn-danger'>".number_format($porcentaje_ventas,2)."%</button>";
			}


		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$imagen.'",
			      "'.$productos[$i]["codigo"].'",
			      "'.$productos[$i]["descripcion"].'",
			      "'.$categorias["categoria"].'",
				  "'.$ventas.'",
				  "'.$total_porcentaje_ventas.'",
			      "S/. '.number_format($productos[$i]["precio_compra"],2).'",
				  "S/. '.number_format($productos[$i]["precio_venta"],2).'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}


}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarProductos = new TablaRankingProductos();
$activarProductos -> mostrarTablaRankingProductos();

