<!DOCTYPE html>
<html>
<head>	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">  
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<title><?php echo $title; ?></title>
	<meta name="description" content="<?php echo $description; ?>">
	<meta name="keywords" content="<?php echo $keywords; ?>" />	
	<meta name="author" content="Breakermind.com Marcin Łukaszewski hello@breakermind.com">

	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="pragma" content="no-cache">

	<link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
	<link rel="shortcut icon" href="favicon/favicon.ico" type="image/x-icon">
	<link rel="icon" href="favicon/favicon.ico" type="image/x-icon">
	<meta name="theme-color" content="#ffffff"></head>

	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,800italic,700italic,600italic,600,400italic,300italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>		
	<!-- 
	<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>	
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&subset=latin-ext,vietnamese" rel="stylesheet">
	-->

	<!-- font awesome-->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- animate -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css">	
	<!-- style -->
	<link rel="stylesheet" type="text/css" href="style.css">

	<!-- JQUERY 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
	-->

	<!-- highlight.js 
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.10.0/styles/default.min.css">
	-->
	<script src="js/jquery.min.js"></script>

	<script src="ckeditor/ckeditor.js"></script>
	<script src="ckeditor/sample.js"></script>
	<script src="ckeditor/config.js"></script>
	<link rel="stylesheet" href="ckeditor/samples.css">
	<link rel="stylesheet" href="ckeditor/toolbarconfigurator/lib/codemirror/neo.css">

	<script src="js/upload-progress.js"></script>
	
	<script type="text/javascript">	

		// Resize iframe with email
	function resizeIframe(obj) {
		obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
		obj.style.width = obj.contentWindow.document.body.scrollWidth + 'px';
		// resize side bar
		var wi = $('.main').height();
		$('.left').height(wi);

		// iframe.src = 'data:text/html;charset=utf-8,' + encodeURI(html);
	}

	function createIframe(){
		//var html = '<body><h2>Foo</h2></body>';
		//var iframe = document.createElement('iframe');		
		//iframe.src = 'data:text/html;charset=utf-8,' + encodeURI(html);
		// The iframe element needs to be added to the DOM tree to be parsed.
		//document.body.appendChild(iframe);
		//console.log('iframe.contentWindow =', iframe.contentWindow);
		// 
		// iframe.contentWindow.document.open();
		// iframe.contentWindow.document.write(html);
		// iframe.contentWindow.document.close();
	}

	$(document).ready(function() {

	    // resize left sidebar
		var wi = $('.main').height();
		$('.left').height(wi+100);

		// ajax search
		$('.findtxt').keyup(function() {			
  			var txt = $(this).val();
			$.get( "ajax.php",{ q: txt } ,function( data ) {
			  $( "#ajax" ).html( data );
			});
		});
		// show hide
		$( "#findbtn" ).click(function() {			
		  // $( "#findbox" ).toggle( "slow" );
		  $( "#findbox" ).slideToggle( "slow" );
		});

		// click message button
		$( ".showBcc" ).click(function() {			
		    // alert('Message has been moved to trash!');
		  	$('.bccShow').css({'display':'inherit'});
		  	// resize left sidebar
			var wi = $(document).height();
			$('.left').height(wi);
		});
		

		// add border
		$(".input").focusin(function() {
			var id = $(this).parent();			
			id.css( {'margin-bottom':'10px', "border-width":"2px"} );
			//id.animate({borderWidth: "2px",marginBottom: "10px"}, 500);	
		});

		$(".input").focusout(function() {
			var id = $(this).parent();
			id.css( {'margin-bottom':'11px', "border-width":"1px"} );	
			// id.animate({borderWidth: "1px",marginBottom: "11px"}, 500);	
		});
						
		// ckeditor
		// initSample();
		// get data
		// var data = CKEDITOR.instances.editor.getData();

				// resize left sidebar
		var wi = $('.main').height();
		$('.left').height(wi+100);

	});	

	$(window).scroll(function () {	

		var top = $(this).scrollTop();
		if (top > 100) {
			$( ".top" ).addClass("fixed");
		    $( ".top" ).fadeIn("slow");
			$( ".top" ).animate({opacity: 0.9}, 500);
		}else {
			$( ".top" ).removeClass( 'fixed' );    			
			$( ".top" ).animate({opacity: 1}, 500);
		}	

		// resize left sidebar
		var wi = $('.main').height();
		$('.left').height(wi);	
	});	

	$( window ).resize(function() {			  
		// get iframe with id
		var frame = $('#xframe');
		// get iframe parent div width
		var parentWidth = frame.parent().width();	  
		// resize iframe
		$('#xframe').css({'width':parentWidth + 'px'});	  	  
		// get iframe document
		var frameDocument = $("#xframe", top.document);
		// get iframe html
		var frameHtml = frameDocument.contents().find("html").html();	 
		// resize iframe height to inside content height
		var frameContentHeight = frameDocument.contents().height();
		// set frame height  
		$('#xframe').css({'height':frameContentHeight + 'px'});	
		// change iframe content
		// var frameHtml = frameDocument.contents().find("html").html("<h1>New HTML</h1>");		

		// resize left sidebar
		// var di = $('.mbox').height();
		var wi = $('.main').height();
		// if(di<wi){wi=di;}
		$('.left').height(wi); 
	});
	 
	$(window).load(function(){		
		$('#xframe body a').setAttribute('target','__blank');

        $("a").click(function(){
            top.window.location.href=$(this).attr("href");
            return true;
        })
    });

	</script>
</head>
<body>

<iframe src="loademail.php" id="xframe" name="xframe" style="background: #fff;  width: 100%" sandbox="allow-same-origin allow-scripts allow-popups" frameborder="0" scrolling="yes" onload="resizeIframe(this);">
    <p>Your browser does not support iframes.</p>
</iframe>

</body>
</html>
