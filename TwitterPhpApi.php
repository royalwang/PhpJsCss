<?php
// Twiter API PHP https://github.com/pedroventura/pv-auto-tweets

$consumerKey    = 'Consumer-Key';
$consumerSecret = 'Consumer-Secret';
$oAuthToken     = 'OAuthToken';
$oAuthSecret    = 'OAuth Secret';

# API OAuth
require_once('twitteroauth.php');
$tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);

// get followers id list
echo $tweet->get('followers/ids', array('screen_name' => 'YOUR-SCREEN-NAME-USER'));
//$tweet->get('followers/ids', array('screen_name' => 'YOUR-SCREEN-NAME-USER', 'cursor' => 9999999999));

// get followers list with name
echo $tweet->get('followers/list', array('screen_name' => 'YOUR-SCREEN-NAME-USER'));
//$tweet->get('followers/list', array('screen_name' => 'YOUR-SCREEN-NAME-USER', 'cursor' => 9999999999));

// send private message
echo $tweet->post('direct_messages/new', array('screen_name' => 'SCREEN-NAME-USER', 'text' => 'Hell ha wrrrrrrr......'));

// New Tweet message
$tweetMessage = 'This is a tweet to my Twitter account via PHP. PHP API the best ...';

// Check for 140 characters
if(strlen($tweetMessage) <= 140)
{    
   echo  $tweet->post('statuses/update', array('status' => $tweetMessage));
}

// Auto follow users
function auto_follow($toa)
{ 
    $followers = $toa->get('followers/ids', array('cursor' => -1));
    $friends = $toa->get('friends/ids', array('cursor' => -1));
 	
 	$a = json_decode($followers, true);
 	$b = json_decode($friends, true);
 	
    foreach ($a['ids'] as $id) {
        if (empty($b['ids']) or !in_array($id, $b['ids'])) {
        	echo $id." Following user <br>";
            $ret = $toa->post('friendships/create', array('user_id' => $id));
        }
    }
}

// Follow yours followers 
auto_follow($tweet);
?>
