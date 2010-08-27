<?php

$products = array('stendhal');

$filesShort = array(
	'jmapacman.zip', 'jmapacman-server.zip', 'jmapacman-src.tar.gz', 'jmapacman-changes.txt',
	'marauroa.zip', 'marauroa-src.tar.gz', 'marauroa-docs.zip', 'marauroa-changes.txt',
	'marboard-client.zip', 'marboard-server.zip', 'marboard-src.zip', 'marboard-changes.txt',
	'stendhal.zip', 'stendhal-FULL.zip', 'stendhal-server.zip', 'stendhal-src.tar.gz', 'stendhal-changes.txt');
$filesLong = array(
	'jmapacman-(version).zip', 'jmapacman-server-(version).zip', 'jmapacman-(version)-src.tar.gz', 'jmapacman-(version)-changes.txt',
	'marauroa-(version).zip', 'marauroa-(version)-src.tar.gz', 'marauroa-(version)-docs.zip', 'marauroa-(version)-changes.txt',
	'marboard-client-(version).zip', 'marboard-server-(version).zip', 'marboard-src-(version).zip', 'marboard-(version)-changes.txt',
	'stendhal-(version).zip', 'stendhal-FULL-(version).zip', 'stendhal-server-(version).zip', 'stendhal-(version)-src.tar.gz', 'stendhal-(version)-changes.txt'); 


function getVersion($file) {
	preg_match('/^([^-.]*)/', $file, $matches, PREG_OFFSET_CAPTURE);
	$product = $matches[0][0];

	if (!in_array($product, array('stendhal'))) {
		return null;
	}

	$version = file_get_contents(dirname(__FILE__).'/'.$product.'.version');
	return trim($version);
}

	echo '<pre>';
	echo 'File: '.htmlspecialchars($_REQUEST['file']);
	$version = getVersion($_REQUEST['file']);
	echo trim($version);
	echo 'B</pre>';
?>