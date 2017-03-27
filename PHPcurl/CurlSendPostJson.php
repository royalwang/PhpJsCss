<?php
$url = 'http://localhost/forex/z/curl-req.php';

$data = array("name" => "Heniek", "age" => "125", "rozmiar" => "M");                                                                    
$data = json_encode($data);                                                                                   

// Send post data format json
echo CurlSendPostJson($url,$data);

// send curl post                                        
function CurlSendPostJson($url='http://localhost/forex/z/curl-req.php',$datajson){   
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $datajson);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($datajson)));
	return $result = curl_exec($ch);
}
?>

<?php
// curl-req.php
echo $jsonStr = file_get_contents("php://input");
?>
