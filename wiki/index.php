<?php

if (isset($_REQUEST['title'])) {
	header('Location: https://stendhalgame.org/wiki/'.urlencode($_REQUEST['title']));
} else {
	header('Location: https://stendhalgame.org/wiki/'.urlencode(substr($_SERVER['PATH_INFO'], 1)));
}
