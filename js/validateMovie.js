$(document).ready(function() {
	var fieldValidator = function(field, text, method) {
		return function() {
			validateField(field, text, method);
		}
	}

	var movietitleValidator = fieldValidator(
			$('#movietitle'),"The Movie Title must contain only alphabetical characters and must not be empty",function(input) {
				if (input.length < 2) { return "Movie Title is too short!"}
				check_fname = /^[A-Za-z_ ]+$/;
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
				check_fname = /^[A-Za-z_ ]+$/;
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
				if (input.length > 2) { return "Age Restriction is too long!"}
				check_fname = /^[A-Za-z_ ]+$/;
				if(check_fname.test(input)){
					return "Success"
				}else{
						return "Should contain alphabetical characters only!"
				}
			}
	);

  var synopsisValidator = fieldValidator(
			$('#synopsis'),"The Synopsis must not be empty",function(input) {
				if (input.length < 2) { return "Synopsis is too short!"}
				else{
						return "Success"
				}
			}
	);

  var criticsratingValidator = fieldValidator(
			$('#criticsrating'),"The Critics rating must not be empty",function(input) {
				if (input.length < 1) { return "Critics rating invalid!"}
				if (input.length > 3) { return input.length}
				check_fname = /^[0-9].[0-9]+$/;
				if(check_fname.test(input)){
					return "Success"
				}else{
						return "Should be between 1.0-9.9 only!"
				}
			}
	);

  var releaseyearValidator = fieldValidator(
			$('#releaseyear'),"The Release year must not be empty",function(input) {
				if (!(input.length == 4)) { return "Release year should be 4 digit number!"}
				check_fname = /^[0-9]+$/;
				if(check_fname.test(input)){
					return "Success"
				}else{
						return "Should contain numbers only!"
				}
			}
	);

  var audienceratingValidator = fieldValidator(
			$('#audiencerating'),"The audience rating must not be empty",function(input) {
				if (input.length < 1) { return "Audience rating invalid!"}
				if (input.length > 3) { return "Audience rating invalid!"}
				check_fname = /^[0-9].[0-9]+$/;
				if(check_fname.test(input)){
					return "Success"
				}else{
						return "Should be between 1.0-9.9 only!"
				}
			}
	);

	//Event handlers.
	$('#movietitle').focus(movietitleValidator);
  $('#country').focus(countryValidator);
  $('#criticsrating').focus(criticsratingValidator);
  $('#releaseyear').focus(releaseyearValidator);
  $('#audiencerating').focus(audienceratingValidator);
	$('#agerestriction').focus(agerestrictionValidator);
	$('#synopsis').focus(synopsisValidator);


	$('#movietitle').blur(movietitleValidator);
	$('#country').blur(countryValidator);
  $('#criticsrating').blur(criticsratingValidator);
  $('#releaseyear').blur(releaseyearValidator);
  $('#audiencerating').blur(audienceratingValidator);
	$('#agerestriction').blur(agerestrictionValidator);
	$('#synopsis').blur(synopsisValidator);


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
			$("#movieformstatus").text("Errors in the fields!").show().fadeOut( 3000 );
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
