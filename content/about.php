<p><h2>What is <b>Arianne</b> ?</h2>

<p>
Arianne is a <i>multiplayer online games</i> framework and engine to develop turn based and real time games.
It provides a simple way of creating games on a <i>portable</i> and <i>robust</i> server architecture. The server is coded in <i>Java</i> and uses <i>Python</i> for your game description, provides a <i>MySQL</i> backend and uses an UDP transport channel to communicate with dozens of players.<br> 
Our reference clients are coded using <i>Java</i> and the <i>C</i> language in order to achieve maximum portability.

<p>Arianne has been in development since 1999 and has evolved from a tiny application written in pseudo-C++ to a powerful, expandable but simple server framework, running on the <i>Java</i> platform, and a portable client framework, written in bare C to allow total portability of arianne's clients. Arianne's server is totally <i>client agnostic</i>. 
Since the beginning, the key concept at the heart of Arianne's development has been <i>KISS</i>: Keep it simple, stupid! 

<p>Arianne has always been an <b>Open source</b> project, written and released under the <i>GNU GPL</i> license. We believe the right way is the open source way and we want you to have the power to change, edit and configure whatever you want, both on the clients and server. Arianne <i>always welcomes</i> your contributions and modifications to the code to create the best possible <i>open source reference platform</i> for game content providers.

<p>Arianne is <b>playable</b>.<br>
Arianne now supports several games:<ul>
<li>a multiplayer Gladiators fighting game</li>
<li>a multiplayer Pacman game</li>
</ul>

<p><i>Arianne games screenshots</i>:<br>
<table align="center"><tr><td>
<img src="screens/gladiators/example.jpg" border="1">
</td><td>
<img src="screens/mapacman/example.jpg" border="1">
</td></table>


<p>All our efforts are supported by arianne's server: <i>Marauroa</i>.<br> Marauroa is completely written in Java using a <i>multithreaded</i> server architecture with a <i>UDP</i> oriented network protocol, a <i>MySQL</i> based persistence engine and a flexible game system. The game system is <i>totally expandable and modifiable</i> by game developers and is able to run <i>Python</i> scripts defining the game's rules.
Marauroa is based on a design philosophy we called <i>Action/Perception</i>. Each turn a perception is send to the clients explaining what they currently perceive. Clients can ask the server to perform any action in their name using actions. Marauroa is totally game agnostic and makes very little assumptions about what are you trying to do, allowing a great freedom to create any game type.

<p>Marauroa is based on very simple principles:<ul>
<li>Clients communicate with the server, and vice-versa, using an UDP portable network protocol with reliability in mind to allow a stabler experience when online game lag occurs. </li>
<li>You can develop an arianne client, using the arianne client framework, on any system that is able to compile C code. </li>
<li>To play a game every player needs an account on the server that is identified by an username and a password. </li>
<li>Players use their account to login into the server and then choose a 'player' stored under their account to play with. The server then checks the login information using the mySQL backend and loads the player into the game using the persistence engine. </li>
<li>Players send actions to the server. The action system is totally open and has nothing hard-coded so you can edit it totally to your game style. The server sends at regular intervals, called turns, a perception to each player to inform them about the state of the game and any relevant state modifications. Marauroa's perception system is based on the Delta^2 ideology: simply send what has changed. </li>
<li>The server executes some code each turn in order to move the game status on. Using this hook it is simple to code triggers, timeouts, conditions and whatever kind of behavior you need. </li>
<li>The server transparently and automatically stores players and game status modifications on the persistence engine, and also information decided by the game developer using their game definition scripts. </li>
<li>The server side game rules can be written in Python to allow simple and rapid development without needing to recompile the rules engine and without having to know anything about Marauroa's internals. Games
rules can also be coded in Java. </li>
<li>The server generates statistics of usage which are stored in a mySQL database (so you can later generate fancy statistics from them). Or in case you don't require them, they can be disabled to save CPU cycles and disk space. Marauroa features a modular structure that means modules can be changed and disabled without affecting the operation of other modules. </li>
<li>Both the server and clients are fully and wisely documented, with documentation about specification and design and not just API documentation. </li>
</ul>

<p>Bugs are facts of life, they just happen. But Arianne is fully tested using Test Units with <i>JUnit</i> and <i>cppunit</i>, so all modules are tested for most common cases, allowing a better quality software to be deployed. Your cooperation reporting problems is invaluable: <i>You are our best developer and we want to hear from you</i>.


