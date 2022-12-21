<?php
class About extends Page {

	public function writeHtmlHeader() {
		echo '<title>About'.ARIANNE_TITLE.'</title>';
	}

	public function writeContent() {
?>
<div class="section"><h1>What is Arianne?</h1>

<p>Arianne comprises a <i>multiplayer online games</i> framework and engine to develop
turn based and real time games, and the various games which use it.</p>
The main subprojects active now are the framework/engine, called <a href="/engine/marauroa.html">Marauroa</a>,
and a multiplayer online adventures game called <a href="/game/stendhal.html">Stendhal</a>.
Some of the original subprojects are inactive now, you will find archived information about them on this site.

<p>Arianne has been in development since <i>1999</i> and has evolved from a
tiny application written in pseudo-C++ to a powerful, expandable but simple
framework called Marauroa, running on the <i>Java</i> platform.
Marauroa is totally <i>game agnostic</i>.</p>
<p>Our reference engines are coded using <i>Java</i> in order to achieve maximum portability.</p>


<p>Since the beginning, the key concept at the heart of Arianne's development
has been <i>KISS</i>: Keep it simple, stupid! </p>
<p><b>Arianne example game screenshots:</b></p>
<ul class="screenshots">
<li><a href="/game/jamapacman.html"><img src="/screens/mapacman/example.webp" alt="Screenshot of MaPacman"></a></li>
<li><a href="/game/stendhal.html"><img src="/screens/stendhal/20210704_RaidDragons.webp" alt="Screenshot of Stendhal"></a></li>
<li><a href="/tool/marboard.html"><img src="/screens/marboard/THM_marboard_dot.webp" alt="Screenshot of Marboard"></a></li>
</ul>

<h2>How is it licensed?</h2>
<p>Arianne has always been an <b>Open source</b> project, written and released
under the <i>GNU GPL</i> license. We believe the right way is the open source
way and we want you to have the power to change, edit and configure whatever
you want, both on the <i>clients and server</i>. Arianne <i>always welcomes</i> your
contributions and modifications to the code to create the best possible
<i>open source reference platform</i> for game content providers.</p>


<h2>What is Marauroa?</h2>

<p>All our efforts are supported by Arianne's engine: <i>Marauroa</i>, which is <i>portable</i> and
<i>robust</i>.</p>
<p>Marauroa is completely written in Java using a <i>multithreaded</i> server
architecture with a <i>TCP</i> oriented network protocol, a <i>MySQL</i> or <i>H2</i> based
persistence engine and a flexible game system. The game system is <i>totally
expandable and modifiable</i> by game developers.</p>

<p>Marauroa is based on an <i>Action - Perception</i> design philosophy.
Each turn a perception is send to the clients explaining what they currently
perceive. Clients can ask the server to perform any action in their name using
actions. Marauroa is totally game agnostic and makes very little assumptions about
what are you trying to do, allowing a great freedom to create any game type.</p>

<p>At Arianne we care about code quality so code is fully tested using Test Units with <i>JUnit</i>, so modules are tested for most common cases, allowing a better quality software to be deployed.
</p><p><b>Your</b> cooperation reporting problems is invaluable: <i>You are our best developer and we want to hear from you</i>.</p>

<p>If you'd like any more information, try our <a href="https://stendhalgame.org/wiki/Main_Page">wiki</a>.
</div>
<?php
	}
}
$page = new About();
