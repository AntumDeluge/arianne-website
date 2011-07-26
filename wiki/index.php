<?php

if (isset($_REQUEST['title'])) {
	header('Location: http://stendhalgame.org/wiki/'.urlencode($_REQUEST['title']));
} else {
	header('Location: http://stendhalgame.org/wiki/'.urlencode($_SERVER['PATH_INFO']));
}
