<?php

    $item = null;
    $valor = null;

    $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);
    $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

    $arrayClientes = array();
    $arraylistaClientes = array();

    foreach($ventas as $key => $valueVentas)
    {
        foreach ($clientes as $key => $valueClientes)
        {
            if ($valueClientes["id"] == $valueVentas["id_cliente"])
            {
                /* Capturamos los clientes en un array */
                array_push($arrayClientes, $valueClientes["nombre"]);

                /* Capturamos los nombres y los valores netos en un mismo array */
                $arraylistaClientes = array($valueClientes["nombre"] => $valueVentas["neto"]);

                /* Sumamos los netos de cada cliente */
                foreach ($arraylistaClientes as $key => $value)
                {
                    $sumaTotalClientes[$key] += $value;
                }
            }
        }
    }

    /* No repetir nombres */
    $noRepetirNombres = array_unique($arrayClientes);

?>

<!-- COMPRADORES -->
<div class="box box-primary">

    <div class="box-header with-border">
    
        <h3 class="box-title">Compradores</h3>
    
    </div>

    <div class="box-body">
    
        <div class="chart-responsive">
        
            <div class="chart" id="bar-chart2" style="height: 300px;"></div>
        
        </div>
    
    </div>

</div>

<script>

//BAR CHART
var bar = new Morris.Bar({
      element: 'bar-chart2',
      resize: true,
      data: [

        <?php

            foreach ($noRepetirNombres as $value)
            {
                echo "{y: '".$value."', a: '".$sumaTotalClientes[$value]."'},";
            }

        ?>
    
      ],
      barColors: ['#f6a'],
      xkey: 'y',
      ykeys: ['a'],
      labels: ['compras'],
      preUnits: 'S/ ',
      hideHover: 'auto'
    });

</script>