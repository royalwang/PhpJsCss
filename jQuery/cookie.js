$(function(){				
	var arr = ['f','u','c','k'];
	var str = JSON.stringify(arr);		
  
  	// Create cookie
	// document.cookie = 'qNumbers' + "=" + str;
	// alert(document.cookie);
  
  	// Create cookie function
  	setCookie('qNumbers', str, 10);
  
  	// Get cookie
	var json = getCookie('qNumbers');
  
  	// Json to array
  	var bbb = JSON.parse(json);
	alert( bbb[0] + bbb[1] + bbb[2] + bbb[3] );

});

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function setCookie(cname, cvalue, exdays = 1) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    //document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    document.cookie = cname + "=" + cvalue;
}
