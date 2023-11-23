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
        }
    });

    $('#tickid_descusu').summernote({
        height: 250,
        lang: "es-ES",
        popover: {
            image: [],
            link: [],
            air: []
        },
        /* callbacks: {
            onImageUpload: function(image){
                console.log("Image detect...");
                myimagetreat(image[0]);
            },
            onPaste: function(e){
                console.log("Text detect...");
            }
        } */
    });
    $('#tickid_descusu').summernote('disable');
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
            $('#ticktitulo').val(data.ticktitulo);

            $('#tickid_descusu').summernote('code', data.tickdesc);

            if(data.tickest_txt == "Cerrado"){
                $('#pnldetalle').hide();
            }
            
    });
}

init();