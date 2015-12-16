<?php
/*
 Copyright (C) 2015 the Arianne Project

 This program is free software: you can redistribute it and/or modify
 it under the terms of the GNU Affero General Public License as published by
 the Free Software Foundation, either version 3 of the License, or
 (at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU Affero General Public License for more details.

 You should have received a copy of the GNU Affero General Public License
 along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	die('POST required');
}
if (!isset($_REQUEST['repository'])) {
	die('repository not specified');
}
$repo = $_REQUEST['repository'];
if (!preg_match('/^[a-zA-Z0-9]+$/', $repo)) {
	die('invalid repository name');
}
header('HTTP/1.0 204 Found');
system('sudo -Hu marauroa /usr/local/bin/gitsync '.$repo);
