$(document).ready(function() {
	var fieldValidator = function(field, text, method) {
		return function() {
			validateField(field, text, method);
		}
	}

	var firstValidator = fieldValidator(
			$('#fname'),"The First name must contain only alphabetical characters and must not be empty",function(input) {
				if (input.length < 2) { return "First name is less than 2 characters!"}
				check_fname = /^[A-Za-z]+$/;
				if(check_fname.test(input)){
					return "Success"
				}else{
						return "Should contain alphabetical characters only!"
				}
			}
	);

	var lastValidator = fieldValidator(
			$('#lname'),"The Last name must contain only alphabetical characters and must not be empty",function(input) {
				if (input.length < 2) { return "Last name is less than 2 characters!"}
				check_lname = /^[A-Za-z]+$/;
				if(check_lname.test(input)){
					return "Success"
				}else{
						return "Should contain alphabetical characters only!"
				}
			}
	);

	var emailValidator = fieldValidator(
			$('#email'),"Should be unique, valid email address and must not be empty",
			function(input) {
				var status="false";
				input_email = $('#email').val();
				$.ajax({
					 'async': false,
						url: '../db/checkemail.php',
						type: 'POST',
						data: {input_email: input_email},
						success: function(response) {
							console.log("success");
							console.log(response);
							if(response.indexOf("not registered") > -1){
							 	check_email = /\S+@\S+\.\S+/;
								if(check_email.test(input_email) && input_email.length > 2){
									status="Success";
								}else{
									status="Incorrect email format!";
								}
							}else{
								status="Already Registered!";
							}
			 			},
			 			error: function() { console.log("error"); }
				});
				return status
			}
	);

	var dobValidator = fieldValidator(
			$('#dob'),"Enter the Date of Birth",
			function(input) {
				if (input.length < 2) {
			    return "Incorrect DOB!"
			  }
			  return "Success"
			}
	);

	var userValidator = fieldValidator(
			$('#username'),"Username must be unique, contain " +
			"only alphanumeric characters and must not be empty",function(input) {
			  var status="false";
				input_username = $('#username').val();
				$.ajax({
						'async': false,
						url: '../db/checkusername.php',
						type: 'POST',
						data: {input_username: input_username},
						success: function(response) {
							console.log("success");
							console.log(response);
							if(response.indexOf("not registered") > -1){
							 	check_username = /^[0-9A-Za-z]+$/;
								if(check_username.test(input_username) && input_username.length > 2){
									status="Success";
								}else{
									status="Should contain alphanumeric characters only!";
								}
							}else{
								status="Already Registered!";
							}
			 			},
			 			error: function() { console.log("error"); }
				});
				return status
			}
	);
	var passwordStrength = fieldValidator(
			$('#password'),"Should have minimum length 4 and include symbols, special characters",function(input) {
	    		score = 0
	    		//password < 4
	    		if (input.length < 4 ) { return "Password length less than 4 characters!"}

	    		//password length
	    		score += input.length * 2

			    //password has 3 numbers
			    if (input.match(/(.*[0-9].*[0-9].*[0-9])/))  score += 5

			    //password has 2 symbols
			    if (input.match(/(.*[!,@,#,$,%,^,&,*,?,_,~].*[!,@,#,$,%,^,&,*,?,_,~])/)) score += 5

			    //password has Upper and Lower chars
			    if (input.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  score += 10

			    //password has number and chars
			    if (input.match(/([a-zA-Z])/) && input.match(/([0-9])/))  score += 15
			    //
			    //password has number and symbol
			    if (input.match(/([!,@,#,$,%,^,&,*,?,_,~])/) && input.match(/([0-9])/))  score += 15

			    //password has char and symbol
			    if (input.match(/([!,@,#,$,%,^,&,*,?,_,~])/) && input.match(/([a-zA-Z])/))  score += 15

			    //password is just a numbers or chars
			    if (input.match(/^\w+$/) || input.match(/^\d+$/) )  score -= 10

			    //verifing 0 < score < 100
			    if ( score < 0 )  score = 0
			    if ( score > 100 )  score = 100

			    if (score < 50 )  return "Weak password!"
			    return "Success"
			}
	);

	//Event handlers.
	$('#fname').focus(firstValidator);
	$('#lname').focus(lastValidator);
	$('#dob').focus(dobValidator);
	$('#email').focus(emailValidator);
	$('#username').focus(userValidator);
	$('#password').focus(passwordStrength);
	$('#fname').blur(firstValidator);
	$('#lname').blur(lastValidator);
	$('#dob').blur(dobValidator);
	$('#email').blur(emailValidator);
	$('#username').blur(userValidator);
	$('#password').blur(passwordStrength);
	$('#dob').datepicker();
	$('#registerform').on('submit', function(e){

		if($('#fname').val()=="" || $('#lname').val()=="" || $('#email').val()==""
			|| $('#username').val()=="" || $('#password').val()==""){
				$("#formstatus").text("Enter All the Fields!").show().fadeOut( 3000 );
				return false;
		}
		if($('#dob').val()==""){
			$("#formstatus").text("Enter the date of birth!").show().fadeOut( 3000 );
			return false;
		}
		var fname=$('#fnamestatus').prop('outerHTML');
		var lname=$('#lnamestatus').prop('outerHTML');
		var email=$('#emailstatus').prop('outerHTML');
		var username=$('#usernamestatus').prop('outerHTML');
		var password=$('#passwordstatus').prop('outerHTML');
		var dob=$('#dobstatus').prop('outerHTML');
		if ((fname.indexOf("Success!") < 0) ||
				(lname.indexOf("Success!") < 0) ||
				(email.indexOf("Success!") < 0) ||
				(username.indexOf("Success!") < 0) ||
				(password.indexOf("Success!") < 0) ||
				(dob.indexOf("Success!") < 0)
		){
			$("#formstatus").text("Errors in the fields!").show().fadeOut( 3000 );
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
