<?php
/**
 * Returns an encrypted & utf8-encoded
 */
function encrypt($pure_string, $encryption_key) {
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
    return $encrypted_string;
}

/**
 * Returns decrypted original string
 */
function decrypt($encrypted_string, $encryption_key) {
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
    return $decrypted_string;
}


define("ENCRYPTION_KEY", "***&&&^^^%$$");
echo $string = base64_encode("This is the original data string! żźćńóśłęęęę rgreg rg rg reg reg err żźćńóśłęęęę rgreg rg rg reg reg err żźćńóśłęęęę rgreg rg rg reg reg err żźćńóśłęęęę rgreg rg rg reg reg errvvżźćńóśłęęęę rgreg rg rg reg reg errżźćńóśłęęęę rgreg rg rg reg reg errżźćńóśłęęęę rgreg rg rg reg reg errżźćńóśłęęęę rgreg rg rg reg reg errżźćńóśłęęęę rgreg rg rg reg reg err");

echo $encrypted = encrypt($string, ENCRYPTION_KEY);
echo "<br />";
echo $decrypted = base64_decode(decrypt($encrypted, ENCRYPTION_KEY));

?>
