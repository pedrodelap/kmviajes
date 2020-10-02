/*=============================================
BOTON EDITAR COTIZACION
============================================*/

$(".tablas").on("click", ".btnEditarCotizacion", function() {

    var idVenta = $(this).attr("idCotizacion");

    window.location = "index.php?ruta=cotizacion-editar&idCotizacion=" + idCotizacion;


})

/*=============================================
ELIMINAR CLIENTE
=============================================*/

$(".tablas").on("click", ".btnEliminarCliente", function(){

	var idCliente = $(this).attr("idCliente");
	
	swal({
        title: '¿Está seguro de borrar el cliente?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar cliente!'
      }).then((result) => {
        if (result.value) {
          
            window.location = "index.php?ruta=clientes&idCliente="+idCliente;
        }

  })

})