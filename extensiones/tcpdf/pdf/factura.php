<?php

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

class imprimirFactura
{
public $codigo;

public function traerImpresionFactura()
{

/* Traemos la información de la Venta */
$itemVenta = "codigo";
$valorVenta = $this -> codigo;

$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);

$fecha = substr($respuestaVenta["fecha"],0,-8);
$hora = substr($respuestaVenta["fecha"], 10);
$productos = json_decode($respuestaVenta["productos"], true);
$neto = number_format($respuestaVenta["neto"],2);
$impuesto = number_format($respuestaVenta["impuesto"],2);
$total = number_format($respuestaVenta["total"],2);

/* Traemos la información del Cliente */
$itemCliente = "id";
$valorCliente = $respuestaVenta["id_cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

/* Traemos la información del Vendedor */
$itemVendedor = "id";
$valorVendedor = $respuestaVenta["id_vendedor"];

$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

/* Requerimos la clase TCPDF */
require_once('tcpdf_include.php');

/* crear un nuevo documento PDF */
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

/* si se quiere tener varias páginas con diferentes maquetaciones */

$pdf -> startPageGroup();/* iniciamos un grupo de páginas */

$pdf -> AddPage();/* agregamos una nueva página */


/* Creamos un bloque de maquetación */
/* ----------------------------------INICIO BLOQUE 1--------------------------------- */
$bloque1 = <<<EOF

	<table>
	
		<tr>
		
			<td style="width:150px"><img src="images/logo-negro-bloque.png"></td>

			<td style="background-color:white; width:140px">
			
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
				
					<br>
					RUC: 10254997469

					<br>
					Dirección: Av. Habich 244, Urb. Ingeniería SMP.
				
				</div>

			</td>

			<td style="background-color: white; width: 140px">
			
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
				
					<br>
					Teléfono: 999 166 429

					<br>
					letycuro@gmail.com

				</div>
			
			</td>

			<td style="background-color: white; width:110px; text-align: center; color: red"><br><br>FACTURA N°<br>$valorVenta</td>

		</tr>
	
	</table>

EOF;

/* leemos el bloque de HTML ('$bloque1') */
$pdf -> writeHTML($bloque1, false, false, false, false, '');
/* ----------------------------------FINAL BLOQUE 1--------------------------------- */


 
/* ----------------------------------INICIO BLOQUE 2--------------------------------- */
$bloque2 = <<<EOF

	<table>
	
		<tr>
		
			<td style="width:540px"><img src="images/back.jpg"></td>
		
		</tr>
	
	</table>

	<table style="font-size: 10px; padding: 5px 10px;">
	
		<tr>
		
			<td style="border: 1px solid #666; background-color: white; width: 240px">
			
				Cliente: $respuestaCliente[nombre]
			
			</td>

			<td style="border: 1px solid #666; background-color: white; width: 150px; text-align: center">
			
				Fecha: $fecha
			
			</td>

			<td style="border: 1px solid #666; background-color: white; width: 150px; text-align: center">
			
				Hora: $hora
			
			</td>
		
		</tr>

		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width: 540px">Vendedor: $respuestaVendedor[nombre]</td>
		
		</tr>

		<tr>
		
			<td style="border-bottom: 1px solid #666; background-color:white; width: 540px"></td>
		
		</tr>
	
	</table>
EOF;

$pdf -> writeHTML($bloque2, false, false, false, false, '');
/* ----------------------------------FINAL BLOQUE 2--------------------------------- */



/* ----------------------------------INICIO BLOQUE 3--------------------------------- */
$bloque3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
			<td style="border: 1px solid #666; background-color:#B2B2B2; width:260px; text-align:center">Producto</td>
			<td style="border: 1px solid #666; background-color:#B2B2B2; width:80px; text-align:center">Cantidad</td>
			<td style="border: 1px solid #666; background-color:#B2B2B2; width:100px; text-align:center">Valor Unit.</td>
			<td style="border: 1px solid #666; background-color:#B2B2B2; width:100px; text-align:center">Valor Total</td>

		</tr>

	</table>

EOF;

$pdf -> writeHTML($bloque3, false, false, false, false, '');
/* ----------------------------------FINAL BLOQUE 3--------------------------------- */



/* ----------------------------------INICIO BLOQUE 4--------------------------------- */
foreach ($productos as $key => $item)
{

/*$itemProducto = "descripcion";
$valorProducto = $item["descripcion"];
$orden = null;*/

//$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);

$precioTotal = number_format($item["total"],2);

$valorUnitario = number_format($item["precio"],2);

$bloque4 = <<<EOF

	<table style="font-size: 10px; padding: 5px 10px;">
	
		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:260px; text-align:center">$item[descripcion]</td>

			<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">$item[cantidad]</td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">S/. $valorUnitario</td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">S/. $precioTotal</td>
		
		</tr>
	
	</table>

EOF;

$pdf -> writeHTML($bloque4, false, false, false, false, '');
/* ----------------------------------FINAL BLOQUE 4--------------------------------- */
}



/* ----------------------------------INICIO BLOQUE 5--------------------------------- */
$bloque5 = <<<EOF

	<table style="font-size: 10px; padding: 5px 10px;">
	
		<tr>
		
			<td style="color: #333; background-color: white; width: 340px; text-align: center"></td>

			<td style="border-bottom: 1px solid #666; background-color:white; width: 100px; text-align: center"></td>

			<td style="border-bottom: 1px solid #666; color: #333; background-color:white; width: 100px; text-align: center"></td>
		
		</tr>

		<tr>
		
			<td style="border-right: 1px solid #666; color: #333; background-color:white; width: 340px; text-align: center"></td>

			<td style="border: 1px solid #666; background-color:#B2B2B2; width: 100px; text-align: center">Neto</td>

			<td style="border: 1px solid #666; background-color:white; width: 100px; text-align: center">S/. $neto</td>

		</tr>

		<tr>

			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:#B2B2B2; width:100px; text-align:center">
				Impuesto
			</td>
		
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				S/. $impuesto
			</td>

		</tr>

		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:#01AB84; font-weight: bold; width:100px; text-align:center">
				Total
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:#FFFB00; font-weight: bold;  width:100px; text-align:center">
				S/. $total
			</td>

		</tr>
	
	</table>

EOF;

$pdf -> writeHTML($bloque5, false, false, false, false, '');
/* ----------------------------------FINAL BLOQUE 5--------------------------------- */

/* Salida del archivo */
$pdf -> Output('factura'.$valorVenta.'.pdf');

}/* cierre del método */
}/* cierre de la clase */

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();

?>