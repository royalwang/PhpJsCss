<?php

		if(file_exists('tmp/'.$fn)){
		$attachment = chunk_split(base64_encode(file_get_contents('tmp/'.$fn)));   
		$add =      "Content-Transfer-Encoding: base64\r\n"
			        . "Content-Disposition: attachment; filename=\"$fn\"\r\n"
			        . "\r\n" . $attachment . "\r\n"
			        . "\r\n\r\n\r\n"   
			        . "--$boundary--\r\n\r\n";
		}
		
		imap_append($ibox, $IMAP."Send"
					, "Content-Type: text/html;\r\n\tcharset=\"utf-8\"\r\n"
					. "From: Hello <".$IMAPuser.">\r\n"
					. "To: ".$email."\r\n"
					. "Subject: ".quoted_printable_encode($sub)."\r\n"
					. "Date: $dmy\r\n" 					
					. "Message-ID: <".md5(microtime())."$IMAPuser>\r\n"
			        . "MIME-Version: 1.0\r\n"
			        . "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n"
			        . "\r\n\r\n"
			        . "--$boundary\r\n" 					
			        . "Content-Type: text/html;\r\n\tcharset=\"utf-8\"\r\n"
			        . "Content-Transfer-Encoding: 8bit \r\n"
			        . "\r\n\r\n" 			        
					. html_entity_decode($msg)."\r\n"
			        . "\r\n\r\n"
			        . "--$boundary\r\n".$add
                   );
?>   

<?php
// normalny header from mail() Subject polskie znaki
//$sub= "=?UTF-8?B?".base64_encode($sub)."?=";
?>
    	
