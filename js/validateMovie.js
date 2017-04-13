$(document).ready(function() {
	var fieldValidator = function(field, text, method) {
		return function() {
			validateField(field, text, method);
		}
	}

	var movietitleValidator = fieldValidator(
			$('#movietitle'),"The Movie Title must contain only alphabetical characters and must not be empty",function(input) {
				if (input.length < 2) { return "Movie Title is too short!"}
				check_fname = /^[A-Za-z]+$/;
				if(check_fname.test(input)){
					return "Success"
				}else{
						return "Should contain alphabetical characters only!"
				}
			}
	);

  var countryValidator = fieldValidator(
			$('#country'),"The Country must contain only alphabetical characters and must not be empty",function(input) {
				if (input.length < 2) { return "Country name is too short!"}
				check_fname = /^[A-Za-z]+$/;
				if(check_fname.test(input)){
					return "Success"
				}else{
						return "Should contain alphabetical characters only!"
				}
			}
	);
  var agerestrictionValidator = fieldValidator(
			$('#agerestriction'),"The Age Restriction must contain only alphabetical characters and must not be empty",function(input) {
				if (input.length < 1) { return "Age Restriction is too short!"}
				check_fname = /^[A-Za-z]+$/;
				if(check_fname.test(input)){
					return "Success"
				}else{
						return "Should contain alphabetical characters only!"
				}
			}
	);

  var synopsisValidator = fieldValidator(
			$('#synopsis'),"The Synopsis must not be empty",function(input) {
				if (input.length < 2) { return "Synopsis is is too short!"}
				check_fname = /^[A-Za-z]+$/;
				if(check_fname.test(input)){
					return "Success"
				}else{
						return "Should contain alphabetical characters only!"
				}
			}
	);


	//Event handlers.
	$('#movietitle').focus(movietitleValidator);
  $('#country').focus(countryValidator);
	$('#agerestriction').focus(agerestrictionValidator);
	$('#synopsis').focus(synopsisValidator);
  $('#criticsrating').focus(criticsratingValidator);
	$('#releaseyear').focus(releaseyearValidator);
	$('#audiencerating').focus(audienceratingValidator);

	$('#movietitle').blur(movietitleValidator);
	$('#country').blur(countryValidator);
	$('#agerestriction').blur(agerestrictionValidator);
	$('#synopsis').blur(synopsisValidator);
  $('#criticsrating').focus(criticsratingValidator);
	$('#releaseyear').focus(releaseyearValidator);
	$('#audiencerating').focus(audienceratingValidator);

	$('#releasedate').datepicker();

	$('#movieform').on('submit', function(e){

		if($('#movietitle').val()=="" || $('#country').val()=="" || $('#agerestriction').val()==""
			|| $('#synopsis').val()=="" || $('#criticsrating').val()=="" || $('#releaseyear').val()=="" ||
      $('#audiencerating').val()=="")
    {
				$("#movieformstatus").text("Enter All the Fields!").show().fadeOut( 3000 );
				return false;
		}
		var movietitle=$('#movietitlestatus').prop('outerHTML');
		var country=$('#countrystatus').prop('outerHTML');
		var agerestriction=$('#agerestrictionstatus').prop('outerHTML');
		var synopsis=$('#synopsisstatus').prop('outerHTML');
    var criticsrating=$('#criticsrating').prop('outerHTML');
    var releaseyear=$('#releaseyear').prop('outerHTML');
    var audiencerating=$('#audiencerating').prop('outerHTML');
		if ((movietitle.indexOf("Success!") < 0) ||
				 (country.indexOf("Success!") < 0) ||
				 (agerestriction.indexOf("Success!") < 0) ||
				 (synopsis.indexOf("Success!") < 0) ||
     		 (criticsrating.indexOf("Success!") < 0) ||
     		 (releaseyear.indexOf("Success!") < 0) ||
     		 (audiencerating.indexOf("Success!") < 0)
		){
			$("#movieformstatus").text(movietitle.indexOf("Success!") ).show().fadeOut( 3000 );
			return false;
		}else{
			return true;
		}
	});
});
var validateField = function(fieldValue, infoMessage, validateFunction) {
	if (fieldValue.is(':last-child')) {
			var str=fieldValue.prop('outerHTML');
			var id1=str.substring(str.lastIndexOf("=")+2,str.lastIndexOf(">")-1)+"status";
			var $i = $("<i>", {id: id1});
			fieldValue.parent().append($i);
	}

	var formStatus = fieldValue.next();
	var inputValue = fieldValue.val();
	formStatus.removeClass();

	if (fieldValue.is(':focus')) {
		formStatus.text(infoMessage);
		formStatus.addClass("info");
		return;
	}
	var status=validateFunction(fieldValue.val());
	if (!inputValue) {
		formStatus.text("");
	}
	else if (status=="Success") {
		formStatus.text("Success!");
	} else {
		formStatus.text("Error: "+status);
	}
};
