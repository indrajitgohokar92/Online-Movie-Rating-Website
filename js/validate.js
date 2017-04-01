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
				return input.length > 0;
			}
	);

	var userValidator = fieldValidator(
			$('#username'),"The username must contain " +
			"only alphabetical or numeric characters.",function(input) {
				check_username = /^[0-9A-Za-z]+$/;
				return check_username.test(input);
			}
	);

	var passValidator = fieldValidator(
			$('#password'),"The password should be at least 8 characters long.",
			function(input) {
				return input.length > 7;
			}
	);

	//Event handlers.
	$('#fname').focus(firstValidator);
	$('#lname').focus(lastValidator);
	$('#dob').focus(dobValidator);
	$('#email').focus(emailValidator);
	$('#username').focus(userValidator);
	$('#password').focus(passValidator);
	$('#fname').blur(firstValidator);
	$('#lname').blur(lastValidator);
	$('#dob').blur(dobValidator);
	$('#email').blur(emailValidator);
	$('#username').blur(userValidator);
	$('#password').blur(passValidator);

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