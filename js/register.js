$(document).ready(function() {
	$('#submitformbutton').on('click', function(event) {
		var fname = $('#fname').val();
		var lname = $('#lname').val();
		var email = $('#email').val();
		var dob = $('#dob').val();
		var username = $('#username').val();
		var password = $('#password').val();


		if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		} else {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
	    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var res=xmlhttp.responseText.split("    ");
	        	document.getElementById("info").innerHTML = res[0];
	    }
	}
	xmlhttp.open("POST","../db/adduser.php?username="+username+"&password="+password,true);
	xmlhttp.send();
	});
});
