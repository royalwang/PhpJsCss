//center element on screen
//how to use
//$(element).center();
//center to parent element
//$(element).center(true);
jQuery.fn.center = function (parent) {
    if (parent) {
        parent = this.parent();
    } else {
        parent = window;
    }	
	this.show();
    this.css("position","absolute");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + $(window).scrollTop()) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + $(window).scrollLeft()) + "px");
    return this;
}


/*
// how to
<script type="text/javascript">
// show
$("body").PopUp("Yours text info");
// hide popup
$('.popup').delay(2000).fadeOut(300);
</script>
*/
jQuery.fn.PopUp = function (alert = 'Kontakt został dodany', err = 1) {	
	var popup = '<div class="popup" style="position: fixed;  left: 50%;  top: 50%;  transform: translate(-50%, -100%);"><p class="alert alert-success">'+alert+'</p></div>'
    if (err == 1) {
        var popup = '<div class="popup" style="position: fixed;  left: 50%;  top: 50%;  transform: translate(-50%, -100%);"><p class="alert alert-error">'+alert+'</p></div>'
    }
	this.append(popup);
    return this;
}