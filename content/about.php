<div class="section"><h1>What is Arianne?</h1>

<p>Arianne is a <i>multiplayer online games</i> framework and engine to develop 
turn based and real time games.</p>

<p>It provides a simple way of creating games on a <i>portable</i> and 
<i>robust</i> server architecture. The server is coded in <i>Java</i> and uses
<i>Python</i> for your game description, provides a <i>MySQL</i> backend and 
uses an UDP transport channel to communicate with dozens of players.</p>

<p>Our reference client engines are coded using <i>Java</i> and the <i>C</i> 
language in order to achieve maximum portability.</p>

<p>Arianne has been in development since <i>1999</i> and has evolved from a 
tiny application written in pseudo-C++ to a powerful, expandable but simple 
server framework, running on the <i>Java</i> platform, and a portable client 
framework, written in bare C to allow total portability of arianne's clients. 
Arianne's server is totally <i>client agnostic</i>.</p>

<p>Since the beginning, the key concept at the heart of Arianne's development 
has been <i>KISS</i>: Keep it simple, stupid! </p>
<p><b>Arianne example game screenshots:</b></p>
<ul class="screenshots">
<li><img src="screens/gladiators/example.jpg" alt="Screenshot"></li>
<li><img src="screens/mapacman/example.jpg" alt="Screenshot"></li>
<li><img src="screens/stendhal/example.jpg" alt="Screenshot"></li>
</ul>

<h2>How is it licensed?</h2>
<p>Arianne has always been an <b>Open source</b> project, written and released
under the <i>GNU GPL</i> license. We believe the right way is the open source 
way and we want you to have the power to change, edit and configure whatever 
you want, both on the clients and server. Arianne <i>always welcomes</i> your 
contributions and modifications to the code to create the best possible 
<i>open source reference platform</i> for game content providers.</p>


<h2>What is Marauroa?</h2>
<p>All our efforts are supported by arianne's server: <i>Marauroa</i>.</p>
<p>Marauroa is completely written in Java using a <i>multithreaded</i> server
architecture with a <i>UDP</i> oriented network protocol, a <i>MySQL</i> based 
persistence engine and a flexible game system. The game system is <i>totally 
expandable and modifiable</i> by game developers and is able to run 
<i>Python</i> scripts defining the game's rules.</p>

<p>Marauroa is based on a design philosophy we called <i>Action - Perception</i>. 
Each turn a perception is send to the clients explaining what they currently 
perceive. Clients can ask the server to perform any action in their name using 
actions. Marauroa is totally game agnostic and makes very little assumptions about 
what are you trying to do, allowing a great freedom to create any game type.</p>

<p>Bugs are facts of life, they just happen. </p>
<p>On Arianne we care about code quality so code is fully tested using Test Units with <i>JUnit</i> and <i>cppunit</i>, so all modules are tested for most common cases, allowing a better quality software to be deployed.
</p><p><b>Your</b> cooperation reporting problems is invaluable: <i>You are our best developer and we want to hear from you</i>.</p>

</div>
