<?php
/*
 Stendhal website - a website to manage and ease playing of Stendhal game
 Copyright (C) 2008-2012  The Arianne Project

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

/**
 * this class represents a page of the website
 *
 * @author hendrik
 */
class Page {
	
	/**
	 * this method can write additional http headers, for example for cache control.
	 *
	 * @return true, to continue the rendering, false to not render the normal content
	 */
	public function writeHttpHeader() {
		// do nothing
		return true;
	}

	/**
	 * this method can write additional html headers, for example the &lt;title&gt; tag.
	 */
	public function writeHtmlHeader() {
		echo '<title>A Multiplayer Online Role Playing Framework to develop games'.ARIANNE_TITLE.'</title>';
		echo '<meta name="keywords" content="arianne, java, python, jython, multiplayer, play, online, game, engine, framework, content creation, C, portable, free, open source, gpl, MySQL, documentation, design">';
		echo '<meta name="description" content="Arianne is a multiplayer online games framework and engine to develop turn based and real time games. It provides a simple way of creating games on a portable and robust server architecture. The server is coded in Java and you may use Python for your game description, provides a MySQL or H2 database backend and uses an TCP transport channel to communicate with hundreds of players.">';
	}

	/**
	 * this methos can add attributes to the body tag.
	 *
	 * @return attributes for the body tag
	 */
	public function getBodyTagAttributes() {
		return "";
	}

	/**
	 * this methods writes the content area of the page.
	 */
	public function writeContent() {
		// do nothing
	}
}
?>