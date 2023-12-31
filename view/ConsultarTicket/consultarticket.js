let tabla;
let usuid = $('#user_idx').val();
let rolid = $('#rol_idx').val();

function init(){
    $("#ticket_form").on("submit", function(e){
        guardar(e);
    });
}

$(document).ready(function(){
    $.post("../../controller/usuario.php?op=combo", function(data){
        $('#usu_asig').html(data);
    });

    if(rolid == 1){
        tabla=$('#ticket_data').dataTable({
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
                    url: '../../controller/ticket.php?op=listar_x_usu',
                    type : "post",
                    dataType : "json",  
                    data:{ usuid : usuid },                        
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
    }else{
        tabla=$('#ticket_data').dataTable({
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
                    url: '../../controller/ticket.php?op=listar',
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
    }

});

function ver(tickid){
    window.open('http://localhost/HelpDesk/view/DetalleTicket/?ID='+ tickid +'');
}

function asignar(tickid){
    $.post("../../controller/ticket.php?op=mostrar", {tickid:tickid}, function(data){
        data = JSON.parse(data);
        $('#tickid').val(data.tickid);
        $('#mdltitulo').html('Asignar Agente');
        $("#modalasignar").modal('show');
    });
}

function guardar(e){
    e.preventDefault();
    let formData = new FormData($("#ticket_form")[0]);
    $.ajax({
        url: "../../controller/ticket.php?op=asignar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){
            /* console.log(datos); */
            let tickid = $('#tickid').val();
            $.post("../../controller/email.php?op=ticket_asignado", {tickid : tickid}, function(data){

            });

            swal("¡Correcto!", "Asignado Correctamente", "success");
            $('#modalasignar').modal('hide');
            $('#ticket_data').DataTable().ajax.reload();
        }
    });
}

function CambiarEstado(tickid){
    swal({
        title: "HelpDesk",
        text: "¿Está seguro de Abrir nuevamente el ticket?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Confirmo",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false
    },
    function(isConfirm) {
        if (isConfirm) {
            $.post("../../controller/ticket.php?op=reabrir", {tickid : tickid, usuid : usuid}, function(data){  
            });

			$('#ticket_data').DataTable().ajax.reload();

            swal({
                title: "Cerrado",
                text: "Ticket Abierto",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    });
}

init();