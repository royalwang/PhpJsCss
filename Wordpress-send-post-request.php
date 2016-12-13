  <?php
 //sending mail
 if(isset($_POST['sub']))
 {
   $uname=$_POST['uname']; 
   $mailid=$_POST['mailid'];
   $phone=$_POST['phone'];
   $message=$_POST['message'];
   mail($uname,$mailid,$phone,$message);
   if(mail($uname,$mailid,$phone,$message))
   {
     echo "mail sent";
   }
   else
   {
     echo "mail failed";
   }
 }
?>
<form name="frm" method="post" action="#">
 <label for="uname">Name:</label>
 <input type="text" value="" name="uname" id="uname"><br/>
 <label for="mailid">Email:</label>
 <input type="text" value="" name="mailid" id="mailid"><br/>
 <label for="mobile">Phone:</label>
 <input type="text" value="" name="phone" id="phone"><br/>
 <label for="message">Message:</label>                                   
 <input type="text" value="" name="message" id="message"><br/>
 <input type="submit" value="Submit" name="sub" id="sub">
</form>
