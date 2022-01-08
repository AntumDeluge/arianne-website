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
	$res = $res.'<img src="images/buttons/twitter_button.webp" width="24" height="24" border="0" hspace="0" alt="Twitter">';
	$res = $res.'</a>';
	return $res;
}

/**
 * Function to provide a button for sharing a news item on facebook
 * 
 * @param $title title of the news item
 * @param $url the url to link to
 */
function buildFacebookButton($title, $url) {
	$res = '<a href="http://facebook.com/sharer.php?u='.urlencode($url);
	$res = $res.urlencode('&t='.$title);
	$res = $res.'" target="_blank" title="Facebook">';
	$res = $res.'<img src="images/buttons/facebook_button.webp" width="24" height="24" border="0" hspace="0" alt="Facebook">';
	$res = $res.'</a>';
	return  $res;
}
