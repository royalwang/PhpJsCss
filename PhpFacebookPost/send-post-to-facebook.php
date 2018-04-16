// Send post to facebook
function SendFacebookPost($id, $fbuser, $fbtoken){
		// Get item id
		$car = $this->getCarId($id);
		// Get photo url
		$f= glob("../media/item/".$car[0]['fotofolder']."/*.{jpg,png,gif}", GLOB_BRACE);		
		if(file_exists($f[0])){
			$photo_url = 'https://breakermind.com/media/item/'.$car['fotofolder'].'/'.$f[0];
			// Send post
			return $this->SendFacebook($fbuser, $fbtoken, $msg, $link, $photo_url);			
		}else{
			return "Error car photo url";
		}		
	}

function SendFacebook($fbuser, $fbtoken, $msg, $link, $photo_url){
		// Send photo
		$graph_url= "https://graph.facebook.com/".$fbuser."/photos";
		$postData = "url=" . urlencode($photo_url) . "&message=" . urlencode($msg) . "&link=" . urlencode($link) . "&access_token=" .$fbtoken;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $graph_url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		$output = curl_exec($ch);
		$output = json_decode($output,true);
		curl_close($ch);
		if(array_key_exists("error", $output)){
			return $output['error']['message'];
		}else if(array_key_exists("id", $output)){
			// $output['id']
			return 1;
		}else{
			return "Error send post with curl to facebook!";
		}
	}
