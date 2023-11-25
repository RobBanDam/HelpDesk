function init(){

}

$(document).ready(function(){
    let usuid = $('#user_idx').val();

    if($('#rol_idx').val() == 1){
        $.post("../../controller/usuario.php?op=total", {usuid:usuid}, function(data){
        data = JSON.parse(data);
        $("#lbltotal").html(data.TOTAL);
        });

        $.post("../../controller/usuario.php?op=totalabierto", {usuid:usuid}, function(data){
            data = JSON.parse(data);
            $("#lbltotalAbiertos").html(data.TOTAL);
        });

        $.post("../../controller/usuario.php?op=totalcerrado", {usuid:usuid}, function(data){
            data = JSON.parse(data);
            $("#lbltotalCerrados").html(data.TOTAL);
        });
    }else{
        $.post("../../controller/ticket.php?op=total", function(data){
            data = JSON.parse(data);
            $("#lbltotal").html(data.TOTAL);
        });   
    
        $.post("../../controller/ticket.php?op=totalabierto", function(data){
            data = JSON.parse(data);
            $("#lbltotalAbiertos").html(data.TOTAL);
        });
    
        $.post("../../controller/ticket.php?op=totalcerrado", function(data){
            data = JSON.parse(data);
            $("#lbltotalCerrados").html(data.TOTAL);
        });    
    }
    
});

init();