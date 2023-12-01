function init(){

}

$(document).ready(function(){
    let tickid = getUrlParameter('ID');

    listardetalle(tickid);

    $('#tickid_desc').summernote({
        height: 250,
        lang: "es-ES",
        popover: {
            image: [],
            link: [],
            air: []
        },
        callbacks: {
            onImageUpload: function(image){
                console.log("Image detect...");
                myimagetreat(image[0]);
            },
            onPaste: function(e){
                console.log("Text detect...");
            }
        },
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
          ]
    });

    $('#tickid_descusu').summernote({
        height: 250,
        lang: "es-ES",
        /* popover: {
            image: [],
            link: [],
            air: []
        }, */
        /* callbacks: {
            onImageUpload: function(image){
                console.log("Image detect...");
                myimagetreat(image[0]);
            },
            onPaste: function(e){
                console.log("Text detect...");
            }
        } */
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
          ]
    });

    $('#tickid_descusu').summernote('disable');

    tabla=$('#documentos_data').dataTable({
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
                url: '../../controller/documento.php?op=listar',
                type : "post",
                data : {tickid: tickid},
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

let getUrlParameter = function getUrlParameter(sParam){
    let sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++){
        sParameterName = sURLVariables[i].split('=');

        if(sParameterName[0] === sParam){
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
}

$(document).on("click", "#btnenviar", function(){
    let tickid = getUrlParameter('ID');
    let usuid = $('#user_idx').val();
    let tickid_desc = $('#tickid_desc').val();

    if($('#tickid_desc').summernote('isEmpty')){
        swal("¡Advertencia!", "No ingresó su respuesta", "warning");
    }else{
        $.post("../../controller/ticket.php?op=insertdetalle", {tickid : tickid, usuid : usuid, tickid_desc : tickid_desc}, function(data){
            listardetalle(tickid);
            $('#tickid_desc').summernote('reset');
            swal("¡Correcto!", "Registrado Correctamente", "success");
        });
    }
});

$(document).on("click", "#btncerrar", function(){
    swal({
        title: "HelpDesk",
        text: "¿Está seguro de Cerrar el Ticket?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Confirmo",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false
    },
    function(isConfirm) {
        if (isConfirm) {
            let tickid = getUrlParameter('ID');
            let usuid = $('#user_idx').val();
            $.post("../../controller/ticket.php?op=update", {tickid : tickid, usuid : usuid}, function(data){
                
            });

            $.post("../../controller/email.php?op=ticket_cerrado", {tickid : tickid}, function(data){

            });

            listardetalle(tickid);

            swal({
                title: "Cerrado",
                text: "Ticket cerrado con éxito",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    });
});

function listardetalle(tickid){
    $.post("../../controller/ticket.php?op=listardetalle", {tickid : tickid}, function(data){
        $('#lbldetalle').html(data);
    });

    $.post("../../controller/ticket.php?op=mostrar", {tickid : tickid}, function(data){
        data = JSON.parse(data);
            $('#lblestado').html(data.tickest);
            $('#lblnomusuario').html(data.usunom +' '+data.usuape);
            $('#lblfechcrea').html(data.fechcrea);
            $('#lblnomidtick').html("Detalle Ticket # " + data.tickid);

            $('#catnom').val(data.catnom);
            $('#cats_nom').val(data.cats_nom);
            $('#ticktitulo').val(data.ticktitulo);

            $('#tickid_descusu').summernote('code', data.tickdesc);

            if(data.tickest_txt == "Cerrado"){
                $('#pnldetalle').hide();
            }
            
    });
}

init();