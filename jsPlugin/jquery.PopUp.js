/*
// how to
<script type="text/javascript">
// show
$("body").PopUp("Info text");
// hide popup
$('.popup').delay(2000).fadeOut(300);
</script>
*/
jQuery.fn.PopUp = function (alert = 'Info text.') {	
	var popup = '<div class="popup" style="position: absolute;  left: 50%;  top: 50%;  transform: translate(-50%, -100%);"><p class="alert alert-success">'+alert+'</p></div>'
	this.append(popup);
    return this;
}