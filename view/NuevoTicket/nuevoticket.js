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

    $.post("../../controller/categoria.php?op=combo", function(data, status){
        $('#catid').html(data);
    });

    $('#catid').change(function(){
        catid = $(this).val();
        console.log(catid);

        $.post("../../controller/subcategoria.php?op=combo", {catid:catid}, function(data, status){
            $('#cats_id').html(data);
        })
    });
});

function guardaryeditar(e){
    e.preventDefault();
    let formData = new FormData($("#ticket_form")[0]);

    if($('#tickdesc').summernote('isEmpty') || $('#ticktitulo').val() == '' || $('#cats_id').val() == ''){
        swal("Advertencia", "Faltan llenar los campos", "warning");
    }else{
        let totalfiles = $('#fileElem').val().length;
        for (let i = 0; i < totalfiles; i++){
            formData.append("files[]", $('#fileElem')[0].files[i]);
        }
        $.ajax({
            url: "../../controller/ticket.php?op=insert",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
                data = JSON.parse(data);
                console.log(data[0].tickid);

                $.post("../../controller/email.php?op=ticket_abierto", {tickid : data[0].tickid}, function(data){

                });


                $('#ticktitulo').val('');
                $('#tickdesc').summernote('reset');
                swal("¡Correcto!", "Registrado Correctamente", "success");
            }
        });
    }
}

init();