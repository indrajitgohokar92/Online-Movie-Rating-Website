$(document).ready(function() {
	$('#commentform').on('submit', function(e){
		if($('#comment').val()==""){
				$("#commentformstatus").text("Enter valid comment!").show().fadeOut( 3000 );
				return false;
		}else{
			return true;
    }
	});
});
