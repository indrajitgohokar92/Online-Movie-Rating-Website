$(document).ready(function() {
	var fieldValidator = function(field, text, method) {
		return function() {
			validateField(field, text, method);
		}
	}

	var firstValidator = fieldValidator(
			$('#fname'),"The First name must contain only alphabetical characters",function(input) {
				check_fname = /^[A-Za-z]+$/;
				return check_fname.test(input);
			}
	);

	var lastValidator = fieldValidator(
			$('#lname'),"The Last name must contain only alphabetical characters",function(input) {
				check_lname = /^[A-Za-z]+$/;
				return check_lname.test(input);
			}
	);

	var emailValidator = fieldValidator(
			$('#email'),"The email should be a valid email address",
			function(input) {
				check_email = /^(.+)@(.+)+$/;
				return check_email.test(input);
			}
	);

	var dobValidator = fieldValidator(
			$('#dob'),"Enter the Date of Birth",
			function(input) {
				return input.length > 1;
			}
	);

	var userValidator = fieldValidator(
			$('#username'),"The username must contain " +
			"only alphabetical or numeric characters.",function(input) {
				check_username = /^[0-9A-Za-z]+$/;
				return check_username.test(input);
			}
	);
	var passwordStrength = fieldValidator(
			$('#password'),"Should have minimum length 4 and include symbols, special characters & numbers",function(input) {
	    		score = 0
	    		//password < 4
	    		if (input.length < 4 ) { return false}

	    		//password length
	    		score += input.length * 4

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

			    if (score < 50 )  return false
			    return true
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

});

var validateField = function(fieldValue, infoMessage, validateFunction) {
	if (fieldValue.is(':last-child')) {
		fieldValue.parent().append("<i></i>");
	}

	var formStatus = fieldValue.next();
	var inputValue = fieldValue.val();
	formStatus.removeClass();

	if (fieldValue.is(':focus')) {
		formStatus.text(infoMessage);
		formStatus.addClass("info");
		return;
	}

	if (!inputValue) {
		formStatus.text("");
	} else if (validateFunction(fieldValue.val())) {
		formStatus.text("Success!");
	} else {
		formStatus.text("Error!");
	}
};
