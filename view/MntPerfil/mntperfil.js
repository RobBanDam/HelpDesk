$(document).on("click", "#btnactualizar", function(){
    let pass = $("#txtpass").val();
    let newpass = $("#txtpassnew").val();

    if(pass.length == 0 || newpass.length == 0){
        swal("Error!", "Campos vacíos", "error");
    }else{
        if(pass === newpass){
            let usuid = $('#user_idx').val();
            $.post("../../controller/usuario.php?op=password", {usuid:usuid, usupass: newpass}, function(data){
                swal("¡Correcto!", "Contraseña Actualizada", "success");
            });
        }else{
            swal("Error!", "Las contraseñas no coinciden", "error");
        }
    }
});