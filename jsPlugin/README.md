
# PopUp.js how to use

Add links
```
<script src="https://raw.githubusercontent.com/fxstar/PhpJsCss/master/jsPlugin/jquery.PopUp.js"></script>
<link rel="stylesheet" type="text/css" href="https://raw.githubusercontent.com/fxstar/PhpJsCss/master/jsPlugin/jquery.PopUp.css">
```
and add to script tags
```
<script type="text/javascript">
$(function(){
     $('body').on('click', '.show',function(){
	  if (show == 1) {        			
	  	$("body").PopUp('<i class="fa fa-thumbs-up"></i> Komentarz usunięty', 0);
	  	$('.popup').delay(2000).fadeOut(300);   
	  }else{
	    $("body").PopUp('<i class="fa fa-thumbs-down"></i> Nie można usunąć, komentarz nie istnieje.', 1);
	  	$('.popup').delay(2000).fadeOut(300);
	  }
     });
});
</script>
```
or
```
<script type="text/javascript">
// show
$("body").PopUp("Info text");
// hide popup
$('.popup').delay(2000).fadeOut(300);
</script>
```

