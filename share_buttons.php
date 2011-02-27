<?php
/**
 * Function to provide a button for posting a tweet about a news item
 * 
 * @param $url the URL to mention in the tweet
 * @param $toMention the twitter accounts to mention in the post
 */
function buildTweetButton($url, $toMention) {
	$res = '<a href="http://twitter.com/home?status=';
	$res = $res.$url.' '.$toMention;
	$res = $res.'" target="_blank" title="Twitter">';
	$res = $res.'<img src="images/buttons/twitter_button.png" width="24" height="24" border="0" hspace="0" alt="Twitter">';
	$res = $res.'</a>';
	return $res;
}

function buildFacebookButton($url) {
	$res = $res.'<img src="images/buttons/facebook_button.png" width="24" height="24" border="0" hspace="0" alt="Facebook">';
	return  $res;
}

function buildGoogleBuzzButton($url) {
	$res = $res.'<img src="images/buttons/google_buzz_button.png" width="24" height="24" border="0" hspace="0" alt="Google Buzz">';
	return $res;
}

?>