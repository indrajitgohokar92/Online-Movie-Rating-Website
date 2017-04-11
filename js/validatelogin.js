$(document).ready(function() {
	$('#loginform').on('submit', function(e){
		if($('#input_username').val()=="" || $('#input_password').val()==""){
				$("#formstatus").text("Enter All the Fields!").show().fadeOut( 3000 );
				return false;
		}else{
			return true;
    }
	});
});
