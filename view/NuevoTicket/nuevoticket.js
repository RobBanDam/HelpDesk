function init(){
    $("#ticket_form").on("submit", function(e){
        guardaryeditar(e);
    });
}

$(document).ready(function() {
    $('#tickdesc').summernote({
        height: 100
    });

    $.post("../../controller/categoria.php?op=combo", function(data, status){
        $('#catid').html(data);
    });
});

function guardaryeditar(e){
    e.preventDefault();
    let formData = new FormData($("#ticket_form")[0]);
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

init();