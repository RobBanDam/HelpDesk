function init(){
    $("#ticket_form").on("submit", function(e){
        guardaryeditar(e);
    });
}

$(document).ready(function() {
    $('#tickdesc').summernote({
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

    $.post("../../controller/categoria.php?op=combo", function(data, status){
        $('#catid').html(data);
    });
});

function guardaryeditar(e){
    e.preventDefault();
    let formData = new FormData($("#ticket_form")[0]);

    if($('#tickdesc').summernote('isEmpty') || $('#ticktitulo').val() == ''){
        swal("Advertencia", "Faltan llenar los campos", "warning");
    }else{
        $.ajax({
            url: "../../controller/ticket.php?op=insert",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(datos){
                $('#ticktitulo').val('');
                $('#tickdesc').summernote('reset');
                swal("¡Correcto!", "Registrado Correctamente", "success");
            }
        });
    }
}

init();