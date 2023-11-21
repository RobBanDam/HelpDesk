function init(){

}

$(document).ready(function () {

});

$(document).on("click", "#btnsoporte", function(){
	if($('#rolid').val() == 1){
		$('#lbltitulo').html("Acceso Soporte");
		$('#btnsoporte').html("Acceso Usuario");
		$('#rolid').val(2);
	}else{
		$('#lbltitulo').html("Acceso Usuario");
		$('#btnsoporte').html("Acceso Soporte");
		$('#rolid').val(1);
	}
	
});

init();