<?php

// gamename:   allow version check for other games
// server:     allow different versions for other servers
// port:       allow different versions for testserver
// version:    the version of the client, so that we can do the decision later
//             instead of early at the client release time
if ($_REQUEST['gamename'] == 'stendhal') {
	$version = trim(file_get_contents(dirname(__FILE__).'/stendhal.version'));
	if ($_REQUEST['version'] < $version) {
		echo '<html><body>Your client is out of date. The latest version is '.$version.'. <br>';
		echo 'But you are using '.htmlspecialchars($_REQUEST['version']).'. <br>';
		echo "Download from https://arianne-project.org";
	}

	if ($_REQUEST['version'] == '1.01.5') {
		echo '<html><body>You are using an outdated test version with disabled updater.<br>';
		echo 'Please use the official client to get the bugfix update.';
	}

	if (strtolower($_REQUEST['server']) == 'stendhalgame.org') {
		if ($_REQUEST['version'] >= '2.') {
			echo '<html><body>Your client is out of date. The latest version is '.$version.'<br>';
			echo 'You are using an unofficial client which will not update automatically.<br>';
			echo 'Please download the most recent version of the offical client from  https://arianne-project.org ';
		}
	}
}
