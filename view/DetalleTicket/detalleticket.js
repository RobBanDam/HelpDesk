function init(){

}

$(document).ready(function(){
    let tickid = getUrlParameter('ID');

    $.post("../../controller/ticket.php?op=listardetalle", {tickid : tickid}, function(data){
        $('#lbldetalle').html(data);
    });
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

init();