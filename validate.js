  $(document).ready(function(){

	function decimal(s) {
	    var rgx = /^[0-9]*\.?[0-9]*$/;
	    return s.match(rgx);
	}
	
	// Only decimal numbers with two points
	
	$(".half").on("keypress", function (evt) {
	    var $txtBox = $(this);
	    var charCode = (evt.which) ? evt.which : event.keyCode
	    // backspace allow
	    if (charCode == 8)return true;
	    // numbers allow
	    if ( charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46)
	        return false;
	    else {
	        var len = $txtBox.val().length;
	        var index = $txtBox.val().indexOf('.');

	        if (index > 0 && charCode == 46) {
	            return false;
	        }
	        if (index > 0) {
	            var charAfterdot = (len + 1) - index;
	            if (charAfterdot > 3) {
				return false;
	            }
	        }
	    }
	    return $txtBox;
	});
	
	
	
	 });
