<!DOCTYPE HTML>
<html>
<head>
	<title>Best Movie rating</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Movie_store" />
	<script type="application/x-javascript">
		 addEventListener("load", function() {
		 	setTimeout(hideURLbar, 0);
		 }, false);
		 function hideURLbar(){
		 	window.scrollTo(0,1);
		 }
	</script>
	<link href="css/bootstrap-datepicker.css" rel='stylesheet' type='text/css' />
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- start plugins -->
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="js/validate.js"></script>
	<script type="text/javascript" src="js/jquery.twbsPagination.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
	<?php
	$var_value = $_REQUEST['varname'];

	 ?>
	<script>
	    $(function () {
	        window.pagObj = $('#pagination').twbsPagination({
	            totalPages: 20,
	            visiblePages: 10,
	            onPageClick: function (event, page) {
	                console.info(page + ' (from options)');
	               	var html= "<p>"+page+"</p>";
					$( "#page-content" ).html(html);
	            }
	        }).on('page', function (event, page) {
	            console.info(page + ' (from event listening)');
	            var html= "<p>"+page+"</p>";
				$( "#page-content" ).html(html);
	        });
    	});
	</script>
</head>
<body>
<div class="container">
	<div class="container_wrap">
		<div class="header_top">
			<?php include('header.php');?>
		</div>
		<div class="content">
			<div id="page-content" class="well"></div>
			<nav aria-label="Page navigation">
	        	<ul class="pagination" id="pagination"></ul>
	    	</nav>
	    </div>
    </div>
</div>
<div class="container">
<footer id="footer">
    <?php include('footer.php');?>
</footer>
</div>
</body>
</html>
