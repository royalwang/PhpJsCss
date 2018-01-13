<!-- 
https://highlightjs.org/download/
https://highlightjs.org/usage/
https://github.com/isagalaev/highlight.js/tree/master/src/styles
-->

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>
  <meta name="description" content="<?php echo $description; ?>">
	<meta name="keywords" content="Blog - <?php echo $keywords; ?>" />
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">  
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800,800italic,700italic,600italic,600,400italic,300italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

	<!-- font awesome 
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
  -->

	<!-- animate.css 
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css">
	-->

	<!-- or local -->
	<link rel="stylesheet" type="text/css" href="css/animate.css">	

	<!-- style.css -->
	<link rel="stylesheet" type="text/css" href="/style.css">

	<!-- JQUERY -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 

	<!-- highlight.js -->
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.10.0/styles/default.min.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.10.0/highlight.min.js"></script>
  
	<script type="text/javascript">
		$(document).ready(function() {
      
      <!-- highlight.js -->
		  $('pre code').each(function(i, block) {
		    hljs.highlightBlock(block);
		  });
      
		});
	</script>
  
</head>
<body>
