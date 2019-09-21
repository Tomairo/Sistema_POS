/* Eliminar Tipo Precio Noche (Actualizar a Tipo Precio Día) */
$(".tablas").on("click", ".btnEliminarPrecioNoche", function(){

    var idPrecioNoche = $(this).attr("idPrecioNoche");

    swal({
        title: '¿Está seguro de desactivar precio noche?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí, desactivar!'
    }).then(function(result){

        if(result.value){

            window.location = "index.php?ruta=tipo-precio&idPrecioNoche="+idPrecioNoche;

        }

    })

})