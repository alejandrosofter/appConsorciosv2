<?php
session_start();
require_once("twitteroauth.php"); //Path to twitteroauth library

if($_GET["placement"] == 'footer'){

	$twitteruser = "envatowebdesign"; // Twitter username
	$notweets = 30;
	$consumerkey = "YtJVNfDDDgSLw8xNzGZw";
	$consumersecret = "IiTQAhGvpleI8Ohgf4D7WMzwFjx2jJOULtRUKp79Mc";
	$accesstoken = "1166043541-Y6De2NsoBToaMwUDWGhMXrwe2EZdpM9AqMaiDw1";
	$accesstokensecret = "qDMHE24IIlMTu7VmB51kSJv6SxfUwhCk5oApP78";

}else if($_GET["placement"] == 'onMiddle'){

	$twitteruser = "Met_Creative";
	$notweets = 30;
	$consumerkey = "YtJVNfDDDgSLw8xNzGZw";
	$consumersecret = "IiTQAhGvpleI8Ohgf4D7WMzwFjx2jJOULtRUKp79Mc";
	$accesstoken = "1166043541-Y6De2NsoBToaMwUDWGhMXrwe2EZdpM9AqMaiDw1";
	$accesstokensecret = "qDMHE24IIlMTu7VmB51kSJv6SxfUwhCk5oApP78";

}else if($_GET["placement"] == 'comingSoon'){

	$twitteruser = "envatowebdesign"; // Twitter username
	$notweets = 30;
	$consumerkey = "YtJVNfDDDgSLw8xNzGZw";
	$consumersecret = "IiTQAhGvpleI8Ohgf4D7WMzwFjx2jJOULtRUKp79Mc";
	$accesstoken = "1166043541-Y6De2NsoBToaMwUDWGhMXrwe2EZdpM9AqMaiDw1";
	$accesstokensecret = "qDMHE24IIlMTu7VmB51kSJv6SxfUwhCk5oApP78";

}


function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
	$connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
	return $connection;
}

function convert_links($status,$targetBlank=true,$linkMaxLen=250){

	// the target
	$target=$targetBlank ? " target=\"_blank\" " : "";

	// convert link to url
	$status = preg_replace("/((http:\/\/|https:\/\/)[^ )
	]+)/e", "'<a class=\"met_color\" href=\"$1\" title=\"$1\" $target >'. ((strlen('$1')>=$linkMaxLen ? substr('$1',0,$linkMaxLen).'...':'$1')).'</a>'", $status);

	// convert @ to follow
	$status = preg_replace("/(@([_a-z0-9\-]+))/i","<a class=\"met_color\" href=\"http://twitter.com/$2\" title=\"Follow $2\" $target >$1</a>",$status);

	// convert # to search
	$status = preg_replace("/(#([_a-z0-9\-]+))/i","<a class=\"met_color\" href=\"https://twitter.com/search?q=$2\" title=\"Search $1\" $target >$1</a>",$status);

	// return the status
	return $status;
}



$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);

$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);

$tweets = json_encode($tweets);
$tweets = json_decode($tweets, true);

for($i = 0; $i <= (count($tweets) - 1); $i++){
	$tweets[$i]["text"] = convert_links($tweets[$i]["text"]);
}

echo json_encode($tweets);

?>