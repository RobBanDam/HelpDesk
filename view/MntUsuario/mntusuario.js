let tabla;

function init(){
    $('#usuario_form').on("submit", function(e){
        guardaryeditar(e);
    });
}

function guardaryeditar(e){
    e.preventDefault();
    let formData = new FormData($("#usuario_form")[0]);
    $.ajax({
        url: "../../controller/usuario.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){
            /* console.log(datos); */
            $('#usuario_form')[0].reset();
            $('#modalnuevo').modal('hide');
            $('#usuario_data').DataTable().ajax.reload();

            swal({
                title: "Cerrado",
                text: "Tarea completada",
                type: "success",
                confirmButtonClass: "btn-success"
            });

        }
    })
}

$(document).ready(function(){
    tabla=$('#usuario_data').dataTable({
            "aProcessing": true,
                "aServerSide": true,
                dom: 'Bfrtip',
                "searching": true,
                lengthChange: false,
                colReorder: true,
                buttons: [                
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                        ],
                "ajax":{
                    url: '../../controller/usuario.php?op=listar',
                    type : "post",
                    dataType : "json",  
                                            
                    error: function(e){
                        console.log(e.responseText);    
                    }
                },
                "bDestroy": true,
                "responsive": true,
                "bInfo":true,
                "iDisplayLength": 10,
                "autoWidth": false,
                "language": {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
    }).DataTable();
});

function editar(usuid){
	$('#mdltitulo').html('Editar Registro');

    $.post("../../controller/usuario.php?op=mostrar", {usuid : usuid}, function(data){  
        data = JSON.parse(data);
        $('#usuid').val(data.usuid);
        $('#usunom').val(data.usunom);
        $('#usuape').val(data.usuape);
        $('#usucorreo').val(data.usucorreo);
        $('#usupass').val(data.usupass);
        $('#rolid').val(data.rolid).trigger('change');
    });

	$('#modalnuevo').modal('show');
}

function eliminar(usuid){
	swal({
        title: "HelpDesk",
        text: "¿Está seguro de Eliminar el Usuario?",
        type: "error",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Confirmo",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false
    },
    function(isConfirm) {
        if (isConfirm) {
            $.post("../../controller/usuario.php?op=eliminar", {usuid : usuid}, function(data){  
            });

			$('#usuario_data').DataTable().ajax.reload();

            swal({
                title: "Cerrado",
                text: "Usuario eliminado con éxito",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    });
}

$(document).on("click", "#btnnuevo", function(){
    $('#usuid').val('');
    $('#mdltitulo').html('Nuevo Registro');
    $('#usuario_form')[0].reset();
	$('#modalnuevo').modal('show');
});

init();