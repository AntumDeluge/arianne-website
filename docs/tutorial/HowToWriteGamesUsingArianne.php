<h2>Howto write a game using arianne</h2>
This is a long but easy to read guide about how to write games for Arianne.<br/>
I hope you enjoy it and don't hesitage to ask questions at:
<blockquote>
irc.freenode.net<br>
#arianne
</blockquote>

<div align="left">
  <h2><a name="TOC" id="TOC">Table Of Contents</a></h2>
  <dl name="toclist" id="toclist">
    <dt><a href="#Howto_write_a_game_using_arianne" title="HowToWriteGamesUsingArianne" class="navi">Howto write a game using arianne</a></dt>
    <dt>&nbsp;&nbsp;<a href="#Introduction" class="navi">Introduction</a></dt>
    <dt>&nbsp;&nbsp;<a href="#Prerequisites" class="navi">Prerequisites</a></dt>
    <dt><a href="#Writing_mapacman" class="navi">Writing mapacman</a></dt>
    <dt>&nbsp;&nbsp;<a href="#Specification" class="navi">Specification</a></dt>
    <dt>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#Basic_Description" class="navi">Basic Description</a></dt>
    <dt>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#Multiplayer_fun" class="navi">Multiplayer fun</a></dt>
    <dt>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#Why_pacmanx3f." class="navi">Why pacman?</a></dt>
    <dt>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#Details" class="navi">Details</a></dt>
    <dt>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#Players" class="navi">Players</a></dt>
    <dt>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#Ghosts" class="navi">Ghosts</a></dt>
    <dt>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#Maze" class="navi">Maze</a></dt>
    <dt>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#Balls" class="navi">Balls</a></dt>
    <dt>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#Superballs" class="navi">Superballs</a></dt>
    <dt>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#Goal" class="navi">Goal</a></dt>
    <dt>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#Game_overall_look" class="navi">Game overall look</a></dt>
    <dt>&nbsp;&nbsp;<a href="#Design" class="navi">Design</a></dt>
    <dt>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#Technology_used" class="navi">Technology used</a></dt>
    <dt>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#Entities_design" class="navi">Entities design</a></dt>
    <dt>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#Logic_design" class="navi">Logic design</a></dt>
    <dt>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#AI_Logic_design" class="navi">AI Logic design</a></dt>
    <dt>&nbsp;&nbsp;<a href="#Implementation" class="navi">Implementation</a></dt>
    <dt>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#Server" class="navi">Server</a></dt>
    <dt>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#Server:_Game_rules_logic" class="navi">Server: Game rules logic</a></dt>
    <dt>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#Server:_Game_world_implementation" class="navi">Server: Game world implementation</a></dt>
    <dt>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#Server:_Game_AI_implementation" class="navi">Server: Game AI implementation</a></dt>
    <dt>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#Client" class="navi">Client</a></dt>
    <dt>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#Client:_Game_logic" class="navi">Client: Game logic</a></dt>
    <dt>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#Client:_Game_presentation" class="navi">Client: Game presentation</a></dt>
    <dt>&nbsp;&nbsp;<a href="#Evaluation" class="navi">Evaluation</a></dt>
    <dt>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#Download_the_files_from_Sourceforge" class="navi">Download the files from Sourceforge</a></dt>
    <dt>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#Using_CVS_access" class="navi">Using CVS access</a></dt>
    <dt>&nbsp;&nbsp;<a href="#Deployment" class="navi">Deployment</a></dt>
    <dt>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#Client_1" class="navi">Client</a></dt>
    <dt>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#Server_1" class="navi">Server</a></dt>
  </dl>
</div>
<h3><a name="Introduction" id="Introduction"></a>Introduction</h3>
<p>This document is a tutorial that will help you develop multiplayer online games using the Arianne system with python and pygame. Although marauroa (that is the Arianne game server) is made in Java and ariannexp (that is the Arianne client library) is made in C we are actually going to explain how to develop the game using Python. The reason for this is because it is so simple that everyone can at least give it a try.</p>
<p>Python is a powerful but simple scripting language, and pygame is an SDL binding for python.</p>
<p>Writing a game is a process that involves several stages:</p>
<ul>
  <li>Specification</li>
  <li>Design</li>
  <li>Implementation</li>
  <li>Evaluation</li>
  <li>Deployment</li>
</ul>
<p>By using the Arianne engine you can concentrate on designing the actual game and be able to ignore all the implementation details of a complex system such as the multiplayer online game content server including Threads, Databases and Network handling.</p>
<p>Arianne, as you now know, is a multiplayer online games framework and engine to develop turn based and real time games. It provides a simple way of creating games on a portable and robust server architecture. The server is coded in Java and uses Python for your game description, provides a MySQL backend and uses an UDP transport channel to communicate with dozens of players. Our reference clients are coded using Java and the C language in order to achieve maximum portability.</p>
<p>Arianne has been in development since 1999 and has evolved from a tiny application written in pseudo-C++ to a powerful, expandable but simple server framework, running on the Java platform, and a portable client framework, written in bare C to allow total portability of arianne's clients. Arianne's server is totally client agnostic. Since the beginning, the key concept at the heart of Arianne's development has been KISS: Keep it simple, stupid!</p>
<p>Arianne has always been an Open source project, written and released under the GNU GPL license. We believe the right way is the open source way and we want you to have the power to change, edit and configure whatever you want, both on the clients and server. Arianne always welcomes your contributions and modifications to the code to create the best possible open source reference platform for game content providers.</p>
<p>All our efforts are supported by arianne's server: Marauroa. Marauroa is completely written in Java using a multithreaded server architecture with a UDP oriented network protocol, a MySQL based persistence engine and a flexible game system. The game system is totally expandable and modifiable by game developers and is able to run Python scripts defining the game's rules. Marauroa is based on a design philosophy we called Action/Perception. Each turn a perception is send to the clients explaining what they currently perceive. Clients can ask the server to perform any action in their name using actions.</p>
<p>Marauroa is totally game agnostic and makes very little assumptions about what are you trying to do, allowing a great freedom to create any game type.</p>
<p>You should always grab the latest release of Arianne from <a href="http://arianne.sourceforge.net/" >http://arianne.sourceforge.net</a> as we constantly fix bugs and improve features.</p>
<h3><a name="Prerequisites" id="Prerequisites"></a>Prerequisites</h3>
<p>Arianne provides a client/server framework, so you need to think about both sides of the game:</p>
<ul>
  <li>Server is similar to the referee of all the online players. It tells every player what he/she sees and what he/she can do. It also determines the result of actions that players perform.</li>
  <li>Client is similar to a TV in the sense that it takes input from the player and sends that to the server and using the servers data it creates the game screen for you. The Client provides the view into the game.</li>
</ul>
<p>Developing a multiplayer online game is a very complex task. I would say that it is the most complex software development task that you can imagine. Arianne lowers that complexity level several orders of magnitude, but there are still things you need to know to sucessfully understand this example:</p>
<ul>
  <li>Python because everything is coded using Python.</li>
  <li>Client/Server concept because that will help you to understand why things are done in the way they are.</li>
  <li>Game design because it will simplify the understanding of the overall document.</li>
</ul>
<p>Just make sure you know the basics, i.e. you are able to write python code ( everyone can ) and you know a bit about game design procedures.</p>
<p>There are no other prerequisites to use Arianne technology, everything will be explained through the document. So let's get started!</p>
<h2><a name="Writing_mapacman" id="Writing_mapacman"></a>Writing mapacman</h2>
<p>I will show as an example the development of the mapacman game. I will give you more guidelines and templates to start your own game at the end of the document, but please first read mapacman.</p>
<h3><a name="Specification" id="Specification"></a>Specification</h3>
<p>Before starting to do anything, think about the game you want to implement. Think what your game is about, what features it will have, what makes it different to other similar games, what are the technologies involved in it, and so on...</p>
<p>For our example we are going to write a game called mapacman</p>
<h4><a name="Basic_Description" id="Basic_Description"></a>Basic Description</h4>
<p>mapacman is a multiplayer online game based on the old pacman game. The goal of the game is to eat as many little balls as possible, each ball increases the score of the player by one unit.</p>
<p>There are also special balls that give extra powers to the player, allowing it to eat ghosts. Ghosts intercept players and eating them.</p>
<p>mapacman stands for multiplayer arianne pacman.</p>
<p>A draft of the game would look like this:</p>
<p><img src="docs/tutorial/mapacman.png" alt="mapacman_draft.png" /></p>
<h4><a name="Multiplayer_fun" id="Multiplayer_fun"></a>Multiplayer fun</h4>
<p>The multiplayer approach consists on competitivness: scores increase with each ball eaten and drops when the player is eaten by ghosts. Players can't kill or block each other. The point is that everyone plays in the same maze. Imagine a big maze with dozens of pacmans ( customised of course ) running away from ghosts while eating dots to achieve the highest score.</p>
<p>An extra feature to expand the game is that the highest scoring player could possibly run another role in the game, who knows... maybe, they can modify the map, or implement a nice new feature, the point is that the highest scoring player could make a different way of playing the game.</p>
<h4><a name="Why_pacmanx3f." id="Why_pacmanx3f."></a>Why pacman?</h4>
<p>Pacman is something of the past, but the game exposed several things that are similar to RPG games:</p>
<ul>
  <li>There are lots of objects in the world</li>
  <li>Objects have triggers associated with them</li>
  <li>There is character development in the game</li>
  <li>World is persistent</li>
  <li>AI is complex as in a RPG game</li>
  <li>Everything is conceptually simple</li>
  <li>Lag does matter a lot</li>
</ul>
<h4><a name="Details" id="Details"></a>Details</h4>
<p>Once we know what will appear in the game we can make detailed descriptions of each entity of the game. This may sound to you like OOP methodologies. You are right, Arianne uses an Object based approach.</p>
<p>In the game we have the following entities:</p>
<ul>
  <li>Players</li>
  <li>Ghosts</li>
  <li>Balls</li>
  <li>Super Balls</li>
  <li>Maze</li>
</ul>
<h4><a name="Players" id="Players"></a>Players</h4>
<p>These are the core of the game, they look like pacman from the original game, that is, a yellow circle with a mouth to eat-eat-eat. They gain a score as a result of eating balls. The score increases by one unit each time the player eats a ball, and drops around 50% each time the pacman player is eaten by a ghost.</p>
<p><img src="docs/tutorial/player_d.png" alt="player_draft.png" /></p>
<h4><a name="Ghosts" id="Ghosts"></a>Ghosts</h4>
<p>They add interest to the game. Ghosts chase players around the Maze and as in the original pacman they have different behaviours. There are chaser ghosts, blocker ghosts and camper ghosts. Their number is not static like in the original pacman, but they increase or decrease depending on the size of the maze and the number of players.</p>
<p><img src="docs/tutorial/ghost_dr.png" alt="ghost_draft.png" /></p>
<h4><a name="Maze" id="Maze"></a>Maze</h4>
<p>The maze is a closed labyrinth, with corridors of different lengths that usually have exits to other corridors. You can never get stuck in the maze; there should always be one way forward. The Maze is full of balls that are eaten by players. There are also super balls, which are a limited number of special balls that allows players to eat ghosts. The Maze has a few special locations called respawn points where players randomly enter the game.</p>
<p><img src="docs/tutorial/wall_dra.png" alt="wall_draft.png" /></p>
<h4><a name="Balls" id="Balls"></a>Balls</h4>
<p>A ball is a dot on the maze that increases the score of the player when the player eats it. The ball then disappears for a period of time to prevent a player camping over that point. (Camping is waiting in one place for items to reappear)</p>
<h4><a name="Superballs" id="Superballs"></a>Superballs</h4>
<p>A Super ball is a special dot in the maze that gives the player the power to eat ghosts and so increases its score for a short period of time. As a common ball, it disappears for a period of time after it is eaten.</p>
<h4><a name="Goal" id="Goal"></a>Goal</h4>
<p>Every game has a goal. mapacman?s goal is to get the highest score of all the players (by eating lots of balls and not being eaten).</p>
<h4><a name="Game_overall_look" id="Game_overall_look"></a>Game overall look</h4>
<p>We also need to know what the game will look like before moving forward. We use a standard pacman game as a reference: <br />
    <img src="docs/tutorial/20040608.png" alt="20040608_mapacman.png" /></p>
<h3><a name="Design" id="Design"></a>Design</h3>
<h4><a name="Technology_used" id="Technology_used"></a>Technology used</h4>
<p>To implement mapacman we are going to use Arianne, our multiplayer online game engine. So before designing the game we must understand the main concepts and ideas of Arianne. We need to make the design fit some simple rules to get the easiest design and the best performance possible.</p>
<p>Arianne uses UDP transport, which is the fastest, lowest ping transport available, but comes at the cost of not being able to detected lost packets. If your connection is really bad you will often become out of sync with the server. However, no transport method will help you with this type of connection.</p>
<p>Arianne's system is based on a perception/action/perception scheme. That is, the server sends clients a list of RPObjects with the modifications, additions and removals that happen in that turn. The clients take the perception and if they want to do something they send an RPAction to the server. On the next turn the server sends a new perception message that will contain the result of the action. This scheme has several advantages:</p>
<ul>
  <li>Works perfectly with turn based and real time based games</li>
  <li>There is a coherent state of the game at each moment</li>
  <li>Lower than the mean ping time players don't get an insane advantage</li>
  <li>Turn time can be modified to improve bandwidth/performance</li>
  <li>Support for several orders of magnitude more players than other systems.</li>
</ul>
<p>On the other hand it suffers from an obvious disadvantage:</p>
<ul>
  <li>Results are only real when the turn happens</li>
  <li>Not the best/easiest way for a First Person Shooter</li>
</ul>
<p>This simple system is powerful enough to code nearly all games easily: both real-time and turn based games.</p>
<p><br />
    <img src="docs/tutorial/Percepti.png" alt="PerceptionActionPerception.png" /></p>
<p>The main problem is choosing a turn time for the server. It should be based on the type of game we are making, for example, a real time strategy game will need turn times of around 300 ms, while a turn based strategy game will work fine with 1000-1500 ms of turn time. The Server will save a lot of bandwidth usage whatever option you choose. Just remember that, the lower the turn time, the higher the CPU usage.</p>
<p>Perceptions use list of RPObjects. An RPObject is built of several Attributes that are of the form: <br />
</p>
<blockquote>
  <p>attribute=value</p>
</blockquote>
<p>The attributes allow the storage of strings, ints and floats.</p>
<p>An RPObject is also built of slots. A slot is a container of objects, much like a pocket, a bag, a box, ... or a hand. The point is that if our objects need to have objects inside them, or attached to them, you need to use slots.</p>
<p><br />
    <img src="docs/tutorial/RPObject.png" alt="RPObjectER.png" /></p>
<p>Finally all the dynamic changes to the world are made using actions. An RPAction is also made up of attributes and you must redefine them so that they are useful for your game.</p>
<p>Every player is stored in a relational database: MySQL. You don't need to know how this is done, just trust me: it works. So everything is stored in the database thus making the whole world permanent. It is up to you to decide to which degree things should be stored and when and how often they should be committed. The database is the main bottleneck of Arianne at the time of writing.</p>
<h4><a name="Entities_design" id="Entities_design"></a>Entities design</h4>
<p>Knowing that the Arianne engine uses RPObjects and RPActions to work, we envision the game in that way.</p>
<p>Our <em>Player</em> will be an RPObject with the following attributes:</p>
<ul>
  <li>id <br />
    The unique identification of the player</li>
  <li>name <br />
    The name of the player</li>
  <li>x <br />
    horizontal position of the player in the maze</li>
  <li>y <br />
    vertical position of the player in the maze</li>
  <li>dir <br />
    direction that player follows</li>
  <li>score <br />
    the score of the player</li>
</ul>
<p>The <em>Maze</em> is part of the Map and it is not sent on each perception, but on the initial connection to the system. The Maze is made of <em>Walls</em>, each wall having:</p>
<ul>
  <li>id <br />
    an identification to this block, but it is not part of the dynamic system, that is, it is not part of the RPZone.</li>
  <li>x <br />
    horizontal position of the block in the maze</li>
  <li>y <br />
    vertical position of the block in the maze</li>
</ul>
<p>There are also respawing points, the points where pacman player can appear into the game, which are marked with a <b>+</b> sign. The Maze is static, neither the walls nor respawn points are expected to change during the duration of the game. Therefore it is not part of the Perception that is sent to each player each turn.</p>
<p>The <em>Dots</em> in the maze are part of the dynamic system (as they change pretty often ) so we define them as a RPObject:</p>
<ul>
  <li>id <br />
    The unique identification of the dot</li>
  <li>x <br />
    horizontal position of the dot in the maze</li>
  <li>y <br />
    vertical position of the dot in the maze</li>
  <li>!timeout <br />
    amount of time that must elapse before it is restored back in to the world</li>
</ul>
<p>The !timeout attribute has a special mark: !. It means that the attribute is hidden to the players and that it is only considered on the server side. No player should care about when the item is going to reappear or not, hence we hide it, avoiding the camper players who would just sit on the fastest respawning dots.</p>
<p>The <em>superdots</em> follows a similar definition to the one of the dot:</p>
<ul>
  <li>id <br />
    The unique identification of the superdots</li>
  <li>x <br />
    horizontal position of the superdots in the maze</li>
  <li>y <br />
    vertical position of the superdots in the maze</li>
  <li>!effectime <br />
    lapsus of time that the effect of the superdot is noticed on the players.</li>
  <li>!timeout <br />
    amount of time that must elapse before it is restored back in to the world</li>
</ul>
<p>Finally the system also has <em>Ghosts</em>, that are a special kind of AI-controlled players that try to eat human players. They have:</p>
<ul>
  <li>id <br />
    The unique identification of the ghost</li>
  <li>name <br />
    Each ghost has an unique name</li>
  <li>x <br />
    horizontal position of the ghost in the maze</li>
  <li>y <br />
    vertical position of the ghost in the maze</li>
  <li>dir <br />
    direction that the ghost follows</li>
</ul>
<h4><a name="Logic_design" id="Logic_design"></a>Logic design</h4>
<p>In pacman only the players and ghosts are active objects and can create actions. So we define the actions for our players:</p>
<ul>
  <li><em>Turn</em> that is the action used to make the ghost or player change direction, but only if it there isn't a wall in the new location that the player wishes to move to. For example:</li>
</ul>
<pre>
  *****
  ..C..
  *****</pre>
<p>The player won't be allowed to move UP or DOWN, but it could move LEFT or RIGHT. It has the following attributes:</p>
<ul>
  <li>id <br />
    the unique id of the action so that we can know if it was successful or not.</li>
  <li>turn <br />
    a char containing where the player moves: N, W, S and E</li>
</ul>
<p>As you can imagine N means going up on the map, W means going to the left, S means going down and E means going the right.</p>
<p>There is one other issue to take into account, that is when you request to move in a direction that makes a 90º degree angle with the current one and there is a wall in the way, the action is not discarded, but conserved until it is cancelled by a new order that specifies a move in a different direction or until it can actually be executed</p>
<pre>
  **********
  .C-&gt;......
  *******.**
        *.*
        *.*</pre>
<p>If the player press down in the location shown above, it will take the hallway heading to south when it arrives there. This way we minimize the effect of lag on the game.</p>
<p>That's all! As you can see it is a very simple game if we ignore the trick to handle lag.</p>
<p>So where is the problem? The problem is in coding the logic of the game. We all agree that actions happens synchronously each turn independently of the player input. For example</p>
<pre>
  *******
  .C-&gt;...
  *******</pre>
<p>Our pacman will continue to move along the hallway, unless we change the direction of it, to the left( East ). In order to achieve this we design all the logic to happen at synchronous periods of time.</p>
<p>So each Turn we execute the server logic that mainly consist of</p>
<pre>
  for each player do
    pos=Try to move to the next position following the current direction
    if pos is not Wall then
      Move to next position
      if pos is Dot then
        Increase player score
        Remove Dot at pos
        Add to restore later list this Dot

      else if pos is SuperDot
        Player becomes Hunter
        Remove Dot at pos
        Add to restore later list this Dot
        Add to remove hunter list this Player
      end if
    end if
  end for

  for each item in Remove Hunter List do
    Decreate item timeout
    if timeout is 0 then
      Remove Hunter status of item
    end if
  end for

  for each item in Restore Later List do
    Decreate item timeout
    if timeout is 0 then
      Add Dot at pos to World
    end if
  end for</pre>
<h4><a name="AI_Logic_design" id="AI_Logic_design"></a>AI Logic design</h4>
<p>We need to create Ghosts that move around the maze. Their single task is to chase and eat players and run away from players that can eat them. We are not going to implement different behaviours for each ghost, as mapacman is meant to be a very simple game. So an initial approach to it could look like this:</p>
<pre>
  for each Ghost do
    if ghost doesn't have target then
      get target

    follow target
  end for</pre>
<h3><a name="Implementation" id="Implementation"></a>Implementation</h3>
<p>Ok, now for the one million dollar question: How do we implement it? Well, I hope the answer is easy enough to be understood.</p>
<p>Arianne is a very high level application, so you really don't need to mess with database, network connections, object serialization, version controlling and that kind of thing (as explained in the design part).</p>
<p>First we are going to think about the server and later about the client.</p>
<h4><a name="Server" id="Server"></a>Server</h4>
<p>To implement the server side of your game you have two options, use pure Java or use Jython to code it. I will explain using Jython. This is an arbitrary choice as they are almost the same, they only differ in the way they create the classes.</p>
<p><b>Python</b> <br />
  Lets create a file named mapacman_script.py because this is the file that will contain all the python source code that describes the game logic.</p>
<p>Let's name it mapacmanPython, and here is the empty framework I created for it:</p>
<pre>
from marauroa.game.python import *

class mapacmanRP(PythonRP)
  def __init__(self, zone):
    self._zone=zone

  def execute(self, id, action):
    return 0

  def nextTurn(self):
      pass

  def onInit(self, object):
      return 0

  def onExit(self, objectid):
      return 0

  def onTimeout(self, objectid):
      return 0

class mapacmanZone(PythonZoneRP):
    def __init__(self, zone):
        self._zone=zone

    def onInit(self):
        pass

    def onFinish(self):
        pass

    def serializeMap(self, objectid):
        return java.util.LinkedList()

class mapacmanAI(PythonAIRP):
    def __init__(self, zone, sched):
        self._zone=zone
        self._sched=sched

    def onCompute(self, timelimit):
        pass
  </pre>
<p>Ok, this bare skeleton does nothing, but it allows us to start adding thing to this pacman. This class is inherited from marauroa.game.python.PythonRP, marauroa.game.python.PythonZone and marauroa.game.python.PythonAIRP because this is the class that contains the python wrapper stuff. Hence, this way we can handle it from Java as if it were a normal java class. We will describe what the methods mean later.</p>
<p>In order to make this work save the mapacman file to where the marauroa-&lt;version&gt;.jar or class files are. And modify the following parameters of marauroa.ini</p>
<pre>
  [1]  rp_RPRuleProcessorClass=marauroa.game.python.PythonRPRuleProcessor
       rp_RPZoneClass=marauroa.game.python.PythonRPZone
       rp_RPAIClass=marauroa.game.python.PythonRPAIManager
  [2]  python_script=mapacman_script.py
  [3]  python_script_rules_class=mapacmanRP
       python_script_zone_class=mapacmanZone
       python_script_ai_class=mapacmanAI</pre>
<p>These lines change the behaviour of the marauroa server by using different RPZone and RPRuleProcessor classes, that is, changing the game rules that the server will use.</p>
<p>[1] rp_RPRuleProcessorClass is the attribute that contains the name of the class that will be used to handle all the game logic. As our game is written in Python we use the default python rules handler. rp_RPZoneClass is the attribute that contain the name of the class that will contain all the objects. Think of zone as an object container. Finally rp_RPAIClass is the class in charge of doing AI.</p>
<p>[2] python_script is the name of the file that contains the python script and it must be in the same folder as the jar file of marauroa.</p>
<p>[3] python_script_rules_class is the name of the python class that implements the java PythonRP superclass, the class that is called from Java to do RP rules. python_script_zone_class is the class that is called from Java to initialize the zone from Python and python_script_ai_class is the class that will handle all the AI.</p>
<p>We also need to set up the database, because Marauroa uses a JDBC database. Our first item is <b>marauroa_DATABASE</b>, this attribute sets the type of database that you will use:</p>
<ul>
  <li>MemoryPlayerDatabase, this type of database is pre built in memory and to modify it you need to recompile the server and manually edit the sources to add new accounts. Obviously when the application is shut down everything that has been modified is discarded.</li>
  <li>JDBCPlayerDatabase, this is mainly a MySQL database. It won't run as-is on other SQL compliant databases because it uses MySQL features as special tables types to get transactions and auto_increment column types to generate primary keys</li>
</ul>
<p>My recommendation is that you should embrace MySQL and choose JDBCPlayerDatabase.</p>
<p>The next section describes the connection string to the database.</p>
<ul>
  <li>jdbc_url=jdbc:mysql://127.0.0.1/marauroa<br />
    This attribute explain where the database is running <i>(127.0.0.1)_and the name of the database e.g. _(marauroa)</i>.</li>
  <li>jdbc_class=com.mysql.jdbc.Driver <br />
    the class that describes the driver used for this JDBC connection</li>
  <li>jdbc_user=marauroa_dbuser <br />
    username of the database account for marauroa</li>
  <li>jdbc_pwd=marauroa_dbpwd <br />
    password of the database account for marauroa</li>
</ul>
<p>Remember that to set up the database you need to enter into MySQL as administrator and run: <br />
</p>
<blockquote>
  <p>create database marauroa; grant all on marauroa.* to marauroa_dbuser@&lt;serverip&gt; identified by 'marauroa_dbpwd';</p>
</blockquote>
<p>ok, now lets run marauroad to see what happens.</p>
<blockquote>
  <p>java -classpath marauroa.jar marauroa.marauroad -l</p>
</blockquote>
<p>You should see the following output:</p>
<pre>
  Marauroa - an open source multiplayer online framework for game development -
  Running on version 0.40
  (C) 2003-2004 Miguel Angel Blanch Lardin

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
  2004-05-25 13:31:37.961 &gt;       RPServerManager::run
  2004-05-25 13:31:37.961 D       RPServerManager::run    Turn time elapsed: 0
  2004-05-25 13:31:38.555 D       RPServerManager::run    Turn time elapsed: 0
  2004-05-25 13:31:39.165 D       RPServerManager::run    Turn time elapsed: 0
  2004-05-25 13:31:39.758 D       RPServerManager::run    Turn time elapsed: 0
  2004-05-25 13:31:40.368 D       RPServerManager::run    Turn time elapsed: 0
  2004-05-25 13:31:40.961 D       RPServerManager::run    Turn time elapsed: 0</pre>
<h4><a name="Server:_Game_rules_logic" id="Server:_Game_rules_logic"></a>Server: Game rules logic</h4>
<p>Before we procced to detail game logic we need to define the types of objects that will be used on the game. This improves bandwidth usage by a factor of 5:1. We call it on the constructor of PythonZone and define a method in PythonZone like:</p>
<pre>
def createRPClasses(self):
    STRING=RPClass.STRING
    SHORT_STRING=RPClass.STRING
    INT=RPClass.INT
    SHORT=RPClass.SHORT
    BYTE=RPClass.BYTE
    FLAG=RPClass.FLAG

    HIDDEN=RPClass.HIDDEN

    objclass=RPClass(&quot;position&quot;)
    objclass.add(&quot;x&quot;,BYTE)
    objclass.add(&quot;y&quot;,BYTE)

    objclass=RPClass(&quot;player&quot;)
    objclass.isA(&quot;position&quot;)
    objclass.add(&quot;name&quot;,SHORT_STRING)
    objclass.add(&quot;dir&quot;,SHORT_STRING)
    objclass.add(&quot;score&quot;,INT)
    objclass.add(&quot;super&quot;,BYTE)
    objclass.add(&quot;!vdir&quot;,STRING,HIDDEN)
    objclass.add(&quot;!hdir&quot;,STRING,HIDDEN)

    objclass=RPClass(&quot;ghost&quot;)
    objclass.isA(&quot;player&quot;)
    objclass.add(&quot;!target&quot;,INT,HIDDEN)
    objclass.add(&quot;!decision&quot;,INT,HIDDEN)
    objclass.add(&quot;?kill&quot;,FLAG)

    objclass=RPClass(&quot;block&quot;)
    objclass.isA(&quot;position&quot;)

    objclass=RPClass(&quot;ball&quot;)
    objclass.isA(&quot;position&quot;)
    objclass.add(&quot;!score&quot;,INT,HIDDEN)
    objclass.add(&quot;!respawn&quot;,INT,HIDDEN)

    objclass=RPClass(&quot;superball&quot;)
    objclass.isA(&quot;ball&quot;)
    objclass.add(&quot;!timeout&quot;,INT,HIDDEN)</pre>
<p>Note how we define the data types and specify their visibility. As you can see Marauroa support inheritance on data definition. This step is by now optional but the advantages are really great, so make sure not to skip it :-)</p>
<p>First we are going to add the code for the execute method. This method of mapacmanRP class is called by the scheduler to execute actions for the current turn.</p>
<pre>
  def execute(self, id, action):
[1]    player=self._zone.get(id)
[2]    action_code=action.get(&quot;type&quot;)

[3]    if action_code==&quot;turn&quot;:
         result=self.turn(player,action.get(&quot;dir&quot;))
[4]    elif action_code==&quot;chat&quot;:
         result=self.chat(player,action.get(&quot;content&quot;))
       else:
[5]      print &quot;action not registered&quot;

[6]    print &quot;Player doing &quot;, action.toString(),&quot; with result &quot;, result
       return result</pre>
<p>Our first step is to retrieve the player from the world and hence get th type of action he/she is trying to do.</p>
<dl>
  <dt>For example</dt>
  <dd>
    <p>Our player Billy, whose id is 2, sent an action to the server: <br />
    </p>
    <blockquote>
      <p>action={type=chat,content=Hi World}</p>
    </blockquote>
    <p>Our server will call execute with params: <br />
    </p>
    <blockquote>
      <p>execute(2,action)</p>
    </blockquote>
    <p>And our script will choose the chat method. Simple, isn't it?</p>
  </dd>
</dl>
<p>Then in [3], [4] and [5] we execute the action code that is related to that type of action. Let see the code for each action in mapacmanRP class.</p>
<pre>
    def turn(self, player, direction):
        result=failed
        if direction=='N' or direction=='W' or direction=='S' or direction=='E':
            if self.canMove(player,direction):
                player.put(&quot;dir&quot;,direction)
                self._zone.modify(player)
                result=success
        return result

    def canMove(self, player, dir):
        &quot;&quot;&quot; This methods try to move the player and return the new position &quot;&quot;&quot;
        x=player.getInt(&quot;x&quot;)
        y=player.getInt(&quot;y&quot;)

        if dir=='N' and (y-1)&gt;=0 and self._map.get(x,y-1)&lt;&gt;'*':
            return 1
        elif dir=='W' and (x-1)&gt;=0 and self._map.get(x-1,y)&lt;&gt;'*':
            return 1
        elif dir=='S' and (y+1)&lt;self._map.sizey() and self._map.get(x,y+1)&lt;&gt;'*':
            return 1
        elif dir=='E' and (x+1)&lt;self._map.sizex() and self._map.get(x+1,y)&lt;&gt;'*':
            return 1
        else:
            return 0
  </pre>
<p>As you can see the turn method still doesn't handle the issue we pointed out in the design stage, that is, allow the pacman to move on in the current direction and perform any turn when a corner is reached. To handle that feature we need to modify the above methods as indicated here:</p>
<pre>
    def turn(self, player, direction):
        result=failed
        directionsH=['E','W']
        directionsV=['N','S']

        if _directions.count(direction)==1 and not self._canMove(player,direction):
            if directionsH.count(direction)==1:
                player.put(&quot;!hdir&quot;,direction)

            if directionsV.count(direction)==1:
                player.put(&quot;!vdir&quot;,direction)

        if _directions.count(direction)==1 and self._canMove(player,direction):
            player.put(&quot;dir&quot;,direction)
            self._zone.modify(player)
            result=success
        return result</pre>
<p>Our first modification is to store if the new direction, if it is a horizontal or a vertical direction. We renamed the canMove method to _canMove Now canMove implements the logic to decide if we need to move perpendicular to the current direction of the player movement.</p>
<pre>
    def canMove(self, player):
        dir=player.get(&quot;dir&quot;)
        if (dir=='E' or dir=='W') and player.has(&quot;!vdir&quot;):
            vdir=player.get(&quot;!vdir&quot;)
            if self._canMove(player,vdir):
                player.put(&quot;dir&quot;,vdir)
                player.remove(&quot;!vdir&quot;)

        if (dir=='N' or dir=='S') and player.has(&quot;!hdir&quot;):
            hdir=player.get(&quot;!hdir&quot;)
            if self._canMove(player,hdir):
                player.put(&quot;dir&quot;,hdir)
                player.remove(&quot;!hdir&quot;)

        return self._canMove(player,player.get(&quot;dir&quot;))</pre>
<p>canMove is called on each turn to determine if the client can move. As you see here, we decide if we need to change the direction of the player and then decide, using the old code, if we can move or not.</p>
<pre>
    def chat(self, player, content):
        player.put(&quot;?text&quot;,content)
        self._zone.modify(player)
        return success</pre>
<p>ok, I hope you get the idea. The main procedure is:</p>
<pre>
  # get action params
  # do action logic
  # modify player and/or world
  # notify zone that you modified them</pre>
<p>You need to manually notify everything about the modifications you make each turn to speed up the creation of the perceptions and to control better when and how players perceive things.</p>
<p>Now let's handle the player login, logout and timeout events. The point of handling these events is to allow your application to control what needs to be done in these cases. For example, add attributes on login, or remove other attributes, or mark the characters... The events available are:</p>
<ul>
  <li>onInit is the login event and happens when the player is inserted into the world, not only when they login into the server. There is a period of time between login and game start that corresponds to the time frame between one synchronization perception and the next. This way we ensure that player has a coherent state of the world before really joining the game.</li>
  <li>onExit is the logout event and happens when the player requests to logout. Your only task is to modify the object so that it is subsequently stores in the database correctly.</li>
  <li>onTimeout is the timeout event that happens when player loses connection to the server, it is called after the a period of inactivity, usually around 1 minute. Usually the simplest option is to map this method to onExit</li>
</ul>
<pre>
    def onInit(self, object):
        &quot;&quot;&quot; Do what you need to initialize this player &quot;&quot;&quot;
        pos=self._map.getRandomRespawn()
        object.put(&quot;x&quot;,pos[0])
        object.put(&quot;y&quot;,pos[1])

        self._zone.add(object)
        self._online_players.append(object)
        return 1</pre>
<p>This method of mapacmanRP class inserts the player into the world and gives them a position using a random respawn point that we defined on the map. It also inserts the player in to a list of online players, so we can easily iterate through who is online.</p>
<pre>
    def onExit(self, objectid):
        &quot;&quot;&quot; Do what you need to remove this player &quot;&quot;&quot;
        for x in self._online_players:
            if x.getInt(&quot;id&quot;)==objectid.getObjectID():
                self._online_players.remove(x)
                break

        self._zone.remove(objectid)
        return 1</pre>
<p>This method of mapacmanRP class is the opposite of onInit, it removes the player from the world and from our data structure. Just to note that the search of the player <b>must</b> be done using the RPObject.ID, not the object.</p>
<pre>
    def onTimeout(self, objectid):
        return onExit(self,objectid)</pre>
<p>We are not interested in handling in any special way the timeout of the player; we simply remove it from the world. You may want to make the player stay in the world for a period of time after this so they cannot exploit the when-I-am-going-to-die-I-quickly-logout trick.</p>
<p>One important thing to note is that in this case we don't call the modify method of the zone; this is because it is automatically called when we add or remove objects from the world.</p>
<p>Now I will explain the mother of all the methods in mapacmanRP class: the nextTurn method.</p>
<pre>
    def nextTurn(self):
[1]        for object in self._removed_elements:
             if object['timeout']==0:
                 self._addBall(object)
             else:
                 object['timeout']=object['timeout']-1

[2]        for object in self._super_players:
             if object['timeout']==0:
                 object['object'].remove(&quot;super&quot;)
                 self._super_players.remove(object)
             else:
                 object['timeout']=object['timeout']-1
                 object['object'].put(&quot;super&quot;,object['timeout'])

[3]              self._zone.modify(object['object'])
           self._foreachPlayer()</pre>
<p>[1] takes care of dots that have been eaten by the pacmans. After their timeout value has reach 0 they are restored back to world, so the game is almost endless.</p>
<p>[2] is in charge of removing the hunter state from players that have expired the given period of time after eating a superball. Notice that we modify the object so that it is possible for the client to see that it was modified.</p>
<p>[3] part is just a call to this function.</p>
<pre>
    def _foreachPlayer(self):
        for player in self._online_players:
            if(self.canMove(player,player.get(&quot;dir&quot;))):
                print 'You move in %s direction' % player.get(&quot;dir&quot;)
                self._movePlayer(player)
                self._ghostCollisions(player)
            else:
                print 'You CAN\'T move in %s direction' % player.get(&quot;dir&quot;)</pre>
<p>For each online player we try to move in the direction chosen and if that is possible we call the movePlayer method. We create some output to helping debug the server.</p>
<pre>
    def _movePlayer(self,player):
        pos=self.move(player)

        if self._map.hasZoneRPObject(pos):
            object_in_pos=self._map.getZoneRPObject(pos)
            if object_in_pos.get(&quot;type&quot;)==&quot;ball&quot;:
                self._removeBall(object_in_pos,pos)

                # Increment the score of the player
                player.add(&quot;score&quot;,1)
            elif object_in_pos.get(&quot;type&quot;)==&quot;superball&quot;:
                self._removeBall(object_in_pos,pos)

                # Notify to remove the attribute on timeout
                timeout=object_in_pos.getInt(&quot;!timeout&quot;)
                player.put(&quot;super&quot;,timeout)
                element={'timeout':timeout,'object':player}
                self._super_players.append(element)

        self._zone.modify(player)</pre>
<p>If this method decides that the player can move in that direction, we now check what is found in the new position. If the object is a dot ( ball ) then we remove it and insert it in the list of elements to be restored later (as seen on [1] of nextTurn). Additionally, if the object is a Superdot ( Superball ) we also remove it as before and also add the player information so that the super attribute can be removed at a later time (in [2] of nextTurn)</p>
<pre>
    def _removeBall(self, ball, pos):
        self._zone.remove(ball.getID())
        self._map.removeZoneRPObject(pos)
        element={'timeout':ball.getInt(&quot;!respawn&quot;),'object':ball}
        self._removed_elements.append(element)

    def _addBall(self, element):
        self._map.addZoneRPObject(element['object'])
        self._removed_elements.remove(element)</pre>
<p>These are the two methods that help the nextTurn logic.</p>
<pre>
    def _ghostCollisions(self, player):
        pos=(player.getInt(&quot;x&quot;),player.getInt(&quot;y&quot;))
        for ghost in self.getGhosts(pos):
            if player.has(&quot;super&quot;):
                # TODO: Eat the ghost
                pass
            else:
                print &quot;Ghost killed player &quot;,player.get(&quot;id&quot;)
                ghost.add(&quot;score&quot;,1)
                ghost.put(&quot;?kill&quot;,&quot;&quot;)
                if ghost.has(&quot;!target&quot;): ghost.remove(&quot;!target&quot;)
                self._killedFlagGhosts.append(ghost)
                self._zone.modify(ghost)

                pos=self._map.getRandomRespawn()
                player.put(&quot;x&quot;,pos[0])
                player.put(&quot;y&quot;,pos[1])
                player.put(&quot;score&quot;,player.getInt(&quot;score&quot;)/2)
                self._zone.modify(player)</pre>
<p>This method handles the event of ghosts eating players. We tag the ghost with the ?kill attribute to indicate that it has eaten a player, and we increase its score by one. Of course we also modify the position and the score of the player that just got killed.</p>
<p>Once a ghost kills a player we tell it to look for a new target by removing its target attribute.</p>
<p>You may want to add a respawn delay (10-15 seconds maybe) so they do not respawn immediately.</p>
<p>We now need only to define the way the map is seen. Before looking at the map I will show you the helper methods in mapacmanZone that I used to create the objects:</p>
<pre>
    def createPlayer(self, name):
        &quot;&quot;&quot; This function create a player &quot;&quot;&quot;
        object=self._zone.create()
        object.put(&quot;type&quot;,&quot;player&quot;);
        object.put(&quot;name&quot;,name)
        object.put(&quot;x&quot;,0)
        object.put(&quot;y&quot;,0)
        object.put(&quot;dir&quot;,randomDirection())
        object.put(&quot;score&quot;,0)
        return object;</pre>
<p>This method creates a player and gives it a randomDirection. Note that we use zone.create( ) to get a new RPObject with a valid id. Remember that each object <b>must</b> have a unique id for the whole session, so the only way to make sure of this is to use the RPZone create( ) method.</p>
<pre>
    def createGhost(self, name):
        &quot;&quot;&quot; This function create a ghost &quot;&quot;&quot;
        object=self._zone.create()
        object.put(&quot;type&quot;,&quot;ghost&quot;);
        object.put(&quot;name&quot;,name)
        object.put(&quot;x&quot;,0)
        object.put(&quot;y&quot;,0)
        object.put(&quot;score&quot;,0)
        object.put(&quot;dir&quot;,randomDirection())
        return object;</pre>
<pre>
    def createBall(self, x,y):
        &quot;&quot;&quot; This function create a Ball object that when eats by player increments
        its score. &quot;&quot;&quot;
        object=self._zone.create()
        object.put(&quot;type&quot;,&quot;ball&quot;);
        object.put(&quot;x&quot;,x)
        object.put(&quot;y&quot;,y)
        object.put(&quot;!score&quot;,1)
        object.put(&quot;!respawn&quot;,60)
        return object;</pre>
<pre>
    def createSuperBall(self, x,y):
        &quot;&quot;&quot; This function create a SuperBall object that when eats by player
        make it to be able to eat and destroy the ghosts &quot;&quot;&quot;
        object=self.createBall(x,y)
        object.put(&quot;type&quot;,&quot;superball&quot;);
        object.put(&quot;!timeout&quot;,15)
        return object;</pre>
<p>A super ball is just a special type of ball, so we reuse the definition.</p>
<p>Note that we don't set the type of the object explictly, it will be set automatically using the type attribute.</p>
<p>Ok, now let's see what the map looks like in mapacman. The map class doesn't need to follow any special mapacman guidelines so we can simply design it however we want. Just one thing to note: mapacmanPython has a method named serializeMap, that may be implemented here, that gives the client a list on login of the static objects that make up the map, for example the walls.</p>
<p>Anyway, I will proceed and explain how I coded this class and why things are the way they are.</p>
<pre>
class mapacmanRPMap:
    def __init__(self, pythonRP, filename):
        f=open(filename,'r')
        line=f.readline()

        self._respawnPoints=[]
        self._last_respawnPoints=0
        self._objects_grid={}

        self._grid=[]
        self._zone=pythonRP.getZone()

        i=0
        while line&lt;&gt;'':
            j=0
            for char in line[:-1]:
                if char=='.':
                    self.addZoneRPObject(pythonRP.createBall(j,i))
                elif char=='0':
                    self.addZoneRPObject(pythonRP.createSuperBall(j,i))
                elif char=='+'
                    pos = (j,i)
                    self._respawnPoints.append(pos)
                j=j+1

            self._grid.append(line[:-1])
            line=f.readline()
            i=i+1</pre>
<p>This is the more complex method of the class and its task is to load a text file that contains the map definition into the data structure that hosts the map. A map file looks like:</p>
<pre>
  *************
  *+...***...+*
  *.**.***.**.*
  *.*.......*.*
  *...*****...*
  ***...*...***
  *...*...*...*
  *.***.*.***.*
  *+....*....+*
  *************</pre>
<p>The method reads each line in to a list of strings in Python and also creates a list of dynamic objects like dots and superdots.</p>
<p>For each line we also look for respawn points and add them to the list. Respawn points are the points chosen by the designer to allow players to enter the world, think of them as the phones in Matrix :-)</p>
<pre>
    def get(self,x,y):
        return (self._grid[y])[x]

    def hasZoneRPObject(self, pos):
        return self._objects_grid.has_key(pos)

    def getZoneRPObject(self,pos):
        return self._objects_grid[pos]

    def addZoneRPObject(self,object):
        x=object.getInt(&quot;x&quot;)
        y=object.getInt(&quot;y&quot;)

        self._objects_grid[(x,y)]=object
        self._zone.add(object)

    def removeZoneRPObject(self,pos):
        del self._objects_grid[pos]</pre>
<p>Some helper (save-me-writing-the-same-thing-several-times) functions to test, get, add and remove static and dynamic objects in the world.</p>
<pre>
    def sizey(self):
        return len(self._grid)

    def sizex(self):
        return len(self._grid[0])</pre>
<p>These are more helper functions to make the rest of the logic independent of the map representation.</p>
<pre>
    def getRandomRespawn(self):
        self._last_respawnPoints=(self._last_respawnPoints+1)%(len(self._respawnPoints))
        return self._respawnPoints[self._last_respawnPoints]</pre>
<p>We want respawn points to be chosen randomly, so that?s what this does.</p>
<pre>
    def serializeMap(self):
        def createBlock(pos):
            object=RPObject()
            object.put(&quot;x&quot;,pos[0])
            object.put(&quot;y&quot;,pos[1])
            object.put(&quot;type&quot;,&quot;block&quot;)
            return object

        listObjects=LinkedList()
        y=0
        for line in self._grid:
            x=0
            for char in line:
                if char=='*':
                    listObjects.add(createBlock((x,y)))
                x=x+1
            y=y+1

        return listObjects</pre>
<p>This method is the only that is worth mentioning. The idea behind serializeMap is to tell the client what the static part of the game is like. Think of the static part as a background for a 2D scroller. The main point is that these objects don't need to be sent on each perception because they never change.</p>
<p>So to help myself I created a createBlock function that given the position it returns an RPObject containing the right information, see that these objects don't have an id. That is because these objects are just sugar for the game and they don't really do anything to the game logic.</p>
<p>So the algorithm simply runs through the whole list of strings and for each Wall it creates a Block object and adds it to a list. When we are done we just return the list and voila... by magic the Arianne client will get it.</p>
<h4><a name="Server:_Game_world_implementation" id="Server:_Game_world_implementation"></a>Server: Game world implementation</h4>
<p>The RPZone of mapacman is very light so we don't want to initialize anything, and because of the same reason, we don't store anything in the database. You may want to store/load ghosts, instead of resetting them each time.</p>
<pre>
class mapacmanZone(PythonZone):
    def __init__(self, zone):
        self._zone=zone

    def onInit(self):
        return 1

    def onFinish(self):
        return 1</pre>
<h4><a name="Server:_Game_AI_implementation" id="Server:_Game_AI_implementation"></a>Server: Game AI implementation</h4>
<p>The AI implementation is in charge of moving pacmans around the map, and handling the ghosts.</p>
<p>Everything must be done inside the compute method.</p>
<pre>
def getPythonAI():
    return variable_PythonAI

def setPythonAI(pythonAI):
    global variable_PythonAI
    variable_PythonAI=None

    if variable_PythonAI is None:
        variable_PythonAI=pythonAI</pre>
<p>We create two helper methods to access the PythonAI from PythonRP. PythonAI is called before PythonRP, so we set PythonAI in PythonAI?s constructor and on PythonRP we set the pythonRP attribute in PythonAI. What does this mean? That we can reuse PythonRP methods from PythonAI.</p>
<p>Of course it works because initialization order is always the same:</p>
<ol>
  <li>RPZone</li>
  <li>RPAI</li>
  <li>RPRuleProcessor</li>
</ol>
<pre>
class RealPythonAI(PythonAI):
    def __init__(self, zone, sched):
        self._zone=zone
        self._sched=sched
        self.pythonRP=None
        self.ghosts=[]

        setPythonAI(self)

    def setPythonRP(self, pythonRP):
        self.pythonRP=pythonRP

    def createEnviroment(self):
        ghost=self.pythonRP.createGhost('Sticky')
        self.pythonRP.onInitAIGhost(ghost)
        self.ghosts.append(ghost)</pre>
<p>This method is called on init by PythonRP and it creates a ghost that moves around the maze, just to make the game a bit more interesting.</p>
<pre>
    def compute(self,timelimit):
        if len(self.pythonRP._online_players)==0:
            return 1

        for ghost in self.ghosts:
            print ghost.toString()
            if self.pythonRP.canMove(ghost)==0:
                print &quot;Can't move: Changing direction&quot;
                dir=randomDirection()
                ghost.put(&quot;dir&quot;,dir)
            else:
                self.pythonRP.move(ghost)
                self.pythonRP._zone.modify(ghost)

        for player in self.pythonRP._online_players:
            self.pythonRP._ghostCollisions(player)

        return 1</pre>
<p>This method is the real AI of the ghost, and as you see it is pretty stupid at the moment as the point of this document is not to create a long AI implementation.</p>
<p>The idea is for each ghost to just try to move in any direction. If it cannot move in that direction we randomly change its direction. Once this is done, just check if we collided with any player.</p>
<p>The idea may seem stupid, but it has scored 5000 kills in 12 hours :-)</p>
<p>Of course it is not hard to do a more complex idea like this:</p>
<pre>
        for ghost in self.ghosts:
            ghost.add(&quot;!decision&quot;,-1)

            target=None
            if not ghost.has(&quot;!target&quot;):
                players=self.pythonRP._online_players
                target=players[random.randint(0,len(players)-1)]
                ghost.put(&quot;!target&quot;,target.get(&quot;id&quot;))
            else:
                try:
                    target=self.pythonRP._zone.get(RPObject.ID(ghost.getInt(&quot;!target&quot;)))
                except:
                    ghost.remove(&quot;!target&quot;)

            if target is not None and ghost.getInt(&quot;!decision&quot;)&lt;=0:
                ghost.put(&quot;!decision&quot;,5)
                difx=target.getInt(&quot;x&quot;)-ghost.getInt(&quot;x&quot;)
                dify=target.getInt(&quot;y&quot;)-ghost.getInt(&quot;y&quot;)

                if difx&gt;0:
                    ghost.put(&quot;!hdir&quot;,&quot;E&quot;)
                elif difx&lt;0:
                    ghost.put(&quot;!hdir&quot;,&quot;W&quot;)

                if dify&gt;0:
                    ghost.put(&quot;!vdir&quot;,&quot;S&quot;)
                elif dify&lt;0:
                    ghost.put(&quot;!vdir&quot;,&quot;N&quot;)

            if self.pythonRP.canMove(ghost)==0:
                dir=randomDirection()
                ghost.put(&quot;dir&quot;,dir)
            else:
                self.pythonRP.move(ghost)
                self.pythonRP._zone.modify(ghost)</pre>
<p>Basically what is does is to choose randomly a target and try to get near to it by moving in the horizontal or vertical direction. To avoid the ghost getting stuck because of the primitive AI, we only make this decision once each 5 turns, and in case the ghost is stuck we randomly choose a new direction. It is just a bit more complex but the ghost becomes the-machine-of-death! :-D</p>
<h4><a name="Client" id="Client"></a>Client</h4>
<p>The client side is not as easy to implement as the server, but it is not complex at all. The main idea behind the client is:</p>
<pre>
  login
  choose Character
  map=get Map

  while not exit do
    if has Perception
      get Perception
      apply Perception
    end if

    draw map
    draw perception

    if has input from user
      get input from user
      send action
    end if
  end while</pre>
<p>You should read the pyarianne API definition before continuing this example to understand what is going on.</p>
<p>To implement the client we are going to use pyarianne and pygame.</p>
<p>Lets first create our main game loop and later define the rest of the helper functions. One point to keep in mind is that I am not writing how to design a great client, that is your task: I will write about how to design a basic client that just works. That is, no GUI, no extras :-)</p>
<pre>
    presentation=GamePresentation()
    logic=GameLogic(presentation)

    presentation.init()
    logic.init(&quot;127.0.0.1&quot;,32140)
    if logic.login(&quot;miguel&quot;,&quot;qwerty&quot;):
        character=presentation.chooseCharacter()
        if logic.chooseCharacter(character):
            while not presentation.exitRequested():
                logic.run()
            logic. logout()
        else:
            print 'ERROR(2): '+pyarianne.errorReason()
    else:
        print 'ERROR(1): '+pyarianne.errorReason()

    presentation.quit()</pre>
<p>I have designed the client to totally split presentation and logic ( yes, I am a maniac ), that way it is easy to replace pygame for another engine like a Soya or pyopengl.</p>
<p>The presentation class is in charge of putting things on the screen and handling the user input, it does nothing with the pyarianne library, so it is totally dependant on pygame.</p>
<p>On the other side, the Logic class is the one that talks with pyarianne and so is totally independent of the technology used in the presentation class.</p>
<h4><a name="Client:_Game_logic" id="Client:_Game_logic"></a>Client: Game logic</h4>
<p>So lets have a look at the logic class (the one that talks with the arianne server)</p>
<pre>
class GameLogic:
    def __init__(self, presentation):
        self._world=pyarianne.World()
        self._presentation=presentation
        listener=mapacmanListener(self._presentation)
        self._perceptionHandler=pyarianne.PerceptionHandler(listener)</pre>
<p>This class is the constructor and its only relevant feature is the creation of the listener that will be the glue between perception handling and the presentation layer. The mapacmanListener.</p>
<p>The general idea of the listener is that it is called whenever something is done with the perception, again, refer to pyarianne documentation for more info. Anyway, the point is that we want to redefine the methods that we use, in our case:</p>
<ul>
  <li>onClear</li>
  <li>onAdded</li>
  <li>onModifiedAdded</li>
  <li>onDeleted</li>
</ul>
<p>The rest of methods are simply of no interest to the mapacman game. Note how we want to delegate specific behaviour to the presentation class instead of doing it directly ourselves.</p>
<pre>
class mapacmanListener(pyarianne.PerceptionListener):
    def __init__(self, presentation):
        pyarianne.PerceptionListener.__init__(self)
        self._presentation=presentation</pre>
<pre>
    def onClear(self):
        self._presentation.mapDots.empty()
        self._presentation.mapPlayers.empty()</pre>
<p>We redefine onClear because it is the method that is called on a sync perception to clear everything and start adding objects. This method should really only be called once, but it may be called more times if a player looses synchronization with the server due to a bad connection for example.</p>
<pre>
    def onAdded(self, object):
        if object.get('type')=='ball':
            pos=(object.getInt(&quot;x&quot;),object.getInt(&quot;y&quot;))
            self._presentation.mapDots.add(Dot(object.getInt(&quot;id&quot;),pos))
        elif object.get('type')=='player':
            pos=(object.getInt(&quot;x&quot;),object.getInt(&quot;y&quot;))
            self._presentation.mapPlayers.add(Player(object.getInt(&quot;id&quot;),pos))</pre>
<p>The onAdded method is used to add new objects, like dots that reappear or new players that enter the game. It will also be called just after onClear</p>
<pre>
    def onModifiedAdded(self, object):
        for item in self._presentation.mapPlayers.sprites():
            id=object.getInt(&quot;id&quot;)
            if id==item.getID():
                pos=(object.getInt(&quot;x&quot;),object.getInt(&quot;y&quot;))
                item.setPosition(pos)
                break</pre>
<p>The onModifiedAdded is called each time an object is modified, in mapacman that is each time one object chats or moves. Note, the object is already added to the world, there has only been modifications to its attributes.</p>
<pre>
    def onDeleted(self, object):
        for item in self._presentation.mapPlayers.sprites():
            id=object.getInt(&quot;id&quot;)
            if id==item.getID():
                item.kill()

        for item in self._presentation.mapDots.sprites():
            id=object.getInt(&quot;id&quot;)
            if id==item.getID():
                item.kill()</pre>
<p>Finally the onDeleted method is called each time an object is removed from the world, for example, players that leave and dots that are eaten.</p>
<p>Lets continue analysing the logic class.</p>
<pre>
    def init(self, server, port):
        def idleCallback():
            self._presentation.idleCallback()

        pyarianne.setIdleMethod(idleCallback)
        pyarianne.connectToArianne(server, port)</pre>
<p>The init method is called with a server and a port to connect to which is then passed to pyarianne to make the actual connection. We also set the idleCallback method using a nice feature of python that allows inner functions access to variables of the methods/class where it is defined.</p>
<pre>
    def login(self, username, password):
        result=False
        if pyarianne.login(username, password):
            self._chars=pyarianne.availableCharacters()
            self._listOfCharacters(self._presentation)
            result=True

        return result

    def _listOfCharacters(self, presentation):
        self._presentation._showListOfCharacters(self._chars)</pre>
<p>This method performs the actual login to the server with the username and password passed to the init function. Once you have logged into the server it will pass the list of players to the presentation layer.</p>
<pre>
    def chooseCharacter(self, character):
        result=False
        if pyarianne.chooseCharacter(character):
            listObjects=pyarianne.getRPMap()
            worldMap=WorldMap(listObjects)
            self._setRPMap(worldMap)
            result=True
        return result

    def _setRPMap(self,worldMap):
        self._presentation._addRPMapObjects(worldMap.listWalls())</pre>
<p>The presentation layer will return to us one of the characters, which we then pass to this method that will select this character on the server. If the client is allowed to choose this character, the server will send the client a list of Objects that make up the map. This list is then passed to the presentation layer so that it can drawn by it.</p>
<pre>
    def run(self):
        if pyarianne.hasPerception():
            perception=pyarianne.getPerception()
            self._perceptionHandler.applyPerception(perception, self._world)

        self._presentation._update()
        event=self._presentation.getEvent()

        if event=='N' or event=='S' or event=='W' or event=='E':
            def createTurnAction(dir):
                action=pyarianne.RPAction()
                action.put('type','turn')
                action.put('dir',dir)
                return action

            pyarianne.send(createTurnAction(event))</pre>
<p>This is the method that handles all the logic of the game. It checks if a perception has been received and if so it applies it to the world (that process will call listener if it is needed). Note that you only need call this method around once per perception turn time <i>( usually about 300 ms is a good value )</i>.</p>
<p>Then we update the presentation and get any events that may be waiting on the presentation class (user inputs) and send them to server but only if it is a move event.</p>
<p>To send the action we create a helper method and simply defines it as type=turn and we tell it what direction to turn to. Then we call the send method and we are done.</p>
<p>As you see there is no chat support in this example. It is dependent on a GUI and that will just make the example harder to explain. You can refer to the real source of this game to see how chats are processed. The problem with chat is that we need to be able capture key presses and convert them to unicode, then check if shift is pressed or not, check if we pressed back space, ...blah blah, and so on.</p>
<pre>
    def  logout(self):
        pyarianne.logout()</pre>
<p>Hehe, you guessed it, this performs the logout from the server.</p>
<h4><a name="Client:_Game_presentation" id="Client:_Game_presentation"></a>Client: Game presentation</h4>
<p>As the client is implemented using Python a good option available for graphic support is pygame, whch is a python SDL wrapper.</p>
<p>Pygame is very simple to use, but I will explain a bit of how it works as I continue my explanation of the presentation layer.</p>
<p>Pygame is very 2D oriented, so I will code mapacman using Sprites: a small graphic that can be moved independently around the screen, producing animated effects. Pygame provides a Sprite class for them, so we will subclass it to create our own sprites.</p>
<pre>
class BlockSprite(pygame.sprite.Sprite):
    def __init__(self, resource):
        pygame.sprite.Sprite.__init__(self)
        self.image, self.rect=loadImage(resource)
        self.pos=None

    def setPosition(self, pos):
        self.pos=pos
        x=[self.pos[0]*SPRITE_WIDTH,self.pos[1]*SPRITE_HEIGHT]
        y=[SPRITE_WIDTH,SPRITE_HEIGHT]
        self.rect=[x,y]

    def update(self):
        pass</pre>
<p>This is our basic static sprite for a block like a wall or a dot. It is not animated and has not orientation. We initialise it as expected and we load the graphic resource that is passed as a parameter. We need to call setPosition explictly to tell pygame where this block is expected to be located.</p>
<p>The update method is called by pygame to update things on the sprite, and as this one has nothing to update, there is nothing to be done.</p>
<pre>
class Dot(BlockSprite):
    def __init__(self, id, pos):
        BlockSprite.__init__(self,'dot.png')
        self._id=id
        self.setPosition(pos)

    def getID(self):
        return self._id

class Wall(BlockSprite):
    def __init__(self, pos):
        BlockSprite.__init__(self,'block.png')
        self.setPosition(pos)</pre>
<p>Now we create two subclasses of BlockSprite, one for dots and one for walls. A nice improvement would be to pass wall a description of what surrounds it, so that it is possible to change the type of wall that we draw dependant on the surroundings.</p>
<pre>
class AnimatedSprite(pygame.sprite.Sprite):
    def __init__(self, resource):
        pygame.sprite.Sprite.__init__(self)
        self.images=[]
        self.images.append(loadImage(resource+'_N.png'))
        self.images.append(loadImage(resource+'_E.png'))
        self.images.append(loadImage(resource+'_S.png'))
        self.images.append(loadImage(resource+'_W.png'))
        self.image, self.rect=self.images[0]
        self.pos=None

    def setPosition(self, pos):
        self.pos=pos
        x=[self.pos[0]*SPRITE_WIDTH,self.pos[1]*SPRITE_HEIGHT]
        y=[SPRITE_WIDTH,SPRITE_HEIGHT]
        self.rect=[x,y]

    def setDirection(self, dir):
        if dir=='N': self.image,i=self.images[0]
        if dir=='E': self.image,i=self.images[1]
        if dir=='S': self.image,i=self.images[2]
        if dir=='W': self.image,i=self.images[3]

    def update(self):
        pass</pre>
<p>This class is also a subclass of Sprite, but it loads several sprites, one per orientation and fro each it set the position and the orientation of the object. There is no animation because we are making a very simple client.</p>
<p>The setDirection method takes a parameter given to it by mapacmanListener and makes the sprite head in that direction.</p>
<p>If or when we add animations we will code them in the update method.</p>
<pre>
class Player(AnimatedSprite):
    def __init__(self, id, pos, dir):
        AnimatedSprite.__init__(self,'player')
        self._id=id
        self.setPosition(pos)
        self.setDirection(dir)

    def getID(self):
        return self._id

class Ghost(AnimatedSprite):
    def __init__(self, id, pos, dir):
        AnimatedSprite.__init__(self,'ghost')
        self._id=id
        self.setPosition(pos)
        self.setDirection(dir)

    def getID(self):
        return self._id</pre>
<p>The player and ghost are exactly the same because there no difference between a player and a ghost front the graphic engine?s point of view. We need to store the id of the player to recognize it later.</p>
<pre>
class GamePresentation:
    def __init__(self):
        self._exit_requested=False
        self._event=None</pre>
<p>The constructor is very simple, we just need to set exit_requested to false so that client doesn't exit immediately.</p>
<pre>
       def init(self):
           pygame.init()

[1]        self.screen=pygame.display.set_mode((400, 400))
[2]        self.background=pygame.Surface([400, 400])
[3]        self.background.fill([0, 0, 0])

           self.clock=pygame.time.Clock()
[4]        pygame.display.set_caption(&quot;mapacman &quot;+VERSION+&quot; client&quot;)

[5]        image,rect=loadImage('mainscreen.png')
           self.screen.blit(image, [0, 0])
           pygame.display.update()

[6]        self.mapDots=pygame.sprite.RenderUpdates()
           self.mapPlayers=pygame.sprite.RenderUpdates()
           self.mapWalls= pygame.sprite.RenderUpdates()</pre>
<p>This method is called to initialise the presentation class. It has a lot of pygame specific stuff.</p>
<p>[1] set_mode method initialises the graphic screen mode to 400x400 using the best available colour depth on the system.</p>
<p>[2] and [3] In order for the game to look correct we need to set the background to black, so we create a new surface and fill it with black.</p>
<p>[4] We then set up the title and the icon of the window so that it looks a bit better. We place the caption &quot;mapacman 0.01 client&quot; in the title</p>
<p>[5] Until the game loads and is ready to go we show a splash screen.</p>
<p>[6] Now we create the groups to which sprites will belong to. A group is a container for sprites. The RenderUpdates is a sprite group that can draw and clear with update rectangles. The RenderUpdates is derived from the RenderClear group and keeps track of all the areas drawn and cleared. It also cleverly handles overlapping areas between where a sprite was drawn and cleared when generating the update rectangles.</p>
<pre>
    def exitRequested(self):
        return self._exit_requested</pre>
<p>This tells the logic class if the user has requested to exit or not.</p>
<pre>
    def quit(self):
        pygame.quit()</pre>
<p>The quit method must be called before exit so that pygame can free all the resources properly and in the correct order.</p>
<pre>
    def chooseCharacter(self):
        #TODO: Make character choosal choosable
        return self._characters[0]

    def _addRPMapObjects(self, listObjects):
        for i in listObjects:
            self.mapWalls.add(i)
        self.screen.blit(self.background, [0, 0])
        self.mapWalls.draw(self.screen)
        pygame.display.flip()</pre>
<p>The addRPMapObjects adds all the blocks that should appear on the screen. It then blits the black background to the screen and draws the sprites in place. Finally we flip the back buffer to the screen so that the changes are visible.</p>
<pre>
    def getEvent(self):
        event=self._event
        self._event=None
        return event

    def _update(self):
[1]        for event in pygame.event.get():
               if event.type == QUIT:
                   self._exit_requested=True
               elif event.type == KEYDOWN:
                   if event.key == K_ESCAPE:
                       self._exit_requested=True
                   elif event.key ==K_UP:
                       self._event='N'
                   elif event.key ==K_DOWN:
                       self._event='S'
                   elif event.key ==K_LEFT:
                       self._event='W'
                   elif event.key ==K_RIGHT:
                       self._event='E'


[2]        self.mapWalls.update()
           self.mapDots.update()
           self.mapPlayers.update()

[3]        self.updated_areas=[]
           self.updated_areas.extend(self.mapWalls.draw(self.screen))
           self.updated_areas.extend(self.mapDots.draw(self.screen))
           self.updated_areas.extend(self.mapPlayers.draw(self.screen))

[4]        pygame.display.update(self.updated_areas)

[5]        pygame.time.delay(30)
[6]        self.mapWalls.clear(self.screen, self.background)
           self.mapDots.clear(self.screen, self.background)
           self.mapPlayers.clear(self.screen, self.background)</pre>
<p>This is the main <i>loop</i> of the presentation class. I will comment on how each bit works.</p>
<p>[1] We iterate over the events that are waiting, and register the interesting events in our event store location :-P <br />
  I am interested only in the UP, DOWN, LEFT, RIGHT and EXIT events, so a single variable is ok for them all. This method needs to be improved in order to allow chat.</p>
<p>[2] We now update the sprites. However this will do nothing as the update method of each sprite is empty.</p>
<p>[3] Once we have updated the sprites, we draw them. So we call the draw method of the group and that will take care of restoring backgrounds and handling overlapping areas and so on. The draw method will generate a list with the positions that need to be updated.</p>
<p>[4] Knowing what positions have changed we update them only. This way is the fastest possible way of doing an updat. Any other methods won't go above 20-15 fps even on a very good machine.</p>
<p>[5] CPU time is valuable, so we sleep a few milliseconds to allow the CPU to do other tasks.</p>
<p>[6] Finally we restore the background to where it was before the points were sprites were drawn. Notice that even if we restore it, this doesn?t update the screen as we are working in the back buffer.</p>
<pre>
    def _showListOfCharacters(self, characters):
        self._characters=characters</pre>
<p>This method should show the list of characters available to the user, but as we are still not using a GUI I simply store it to so we can choose the first one easily later.</p>
<h3><a name="Evaluation" id="Evaluation"></a>Evaluation</h3>
<p>To evaluate the result we are going to use the actual game: marauroa and mapacman.</p>
<h4><a name="Download_the_files_from_Sourceforge" id="Download_the_files_from_Sourceforge"></a>Download the files from Sourceforge</h4>
<p>Go to the following URLs and grab the latest version of each package:</p>
<ul>
  <li>Marauroa <a href="http://sourceforge.net/project/showfiles.php?group_id=1111&amp;package_id=114051" >http://sourceforge.net/project/showfiles.php?group_id=1111&amp;package_id=114051</a></li>
  <li>ariannexp <a href="http://sourceforge.net/project/showfiles.php?group_id=1111&amp;package_id=1109" >http://sourceforge.net/project/showfiles.php?group_id=1111&amp;package_id=1109</a></li>
  <li>mapacman <a href="http://sourceforge.net/project/showfiles.php?group_id=1111&amp;package_id=120109" >http://sourceforge.net/project/showfiles.php?group_id=1111&amp;package_id=120109</a></li>
</ul>
<h4><a name="Using_CVS_access" id="Using_CVS_access"></a>Using CVS access</h4>
<dl>
  <dt>In order to get Marauroa grab a copy from CVS by using</dt>
  <dd>cvs -d:pserver:anonymous@cvs.sourceforge.net:/cvsroot/arianne checkout marauroa</dd>
  <dt>And also get a copy of the client mapacman from CVS</dt>
  <dd>cvs -d:pserver:anonymous@cvs.sourceforge.net:/cvsroot/arianne checkout ariannexp cvs -d:pserver:anonymous@cvs.sourceforge.net:/cvsroot/arianne checkout mapacman</dd>
</dl>
<p>Follow the instructions on the README of each file to build and setup it.</p>
<p>Once you have them working and you have carefully chosen the turn time for the game start them running. The best turn time follows the following conditions:</p>
<ul>
  <li>It is at least as big as the mean ping time to your server</li>
  <li>It is long enough for the server to do all the game computation in that time</li>
  <li>It happens often enough, but is not unnecessarily bandwidth hungry</li>
</ul>
<p>For example 10 ms of turn time is too aggressive, as no client will issue commands as fast as every 10 ms, but 300-400 ms is a good time because it is near the limit of real-time and turn-based gaming requirement.</p>
<p>Now simply run the server and then run a client. You should see something like this: <br />
    <img src="docs/tutorial/20040603.png" alt="20040603_mapacman.png" /></p>
<h3><a name="Deployment" id="Deployment"></a>Deployment</h3>
<p>Deployment is the process whereby software is installed into an operational environment. In our case we have two different applications:</p>
<ul>
  <li>Client</li>
  <li>Server</li>
</ul>
<p>Fortunately both client and server are totally portable. In order to make the process of installation easier we need to think about what type of user will run each application.</p>
<h4><a name="Client_1" id="Client_1"></a>Client</h4>
<p>The client is going to be used by a range of people that goes from the computers geek to the general user. Our install procedure should be targeted to this wide group. How? Making it very configurable (down to the smallest detail) if the user desires, otherwise it should default to the simplest settings.</p>
<h4><a name="Server_1" id="Server_1"></a>Server</h4>
<p>The server should only be targered at an above average user. There is a reason for making it easy to install as it prevents the risk of opening holes to the system of the user by accident, as he/she is not able to set up a firewall or correctly protect the database.</p>
<p>I wouldn?t run a server on anything that is not Linux, and I would set up a very restrictive firewall poking holes through only on the ports needed by the game.</p>
<p>So the steps to install marauroa should be:</p>
<ul>
  <li>Check dependencies</li>
</ul>
<ol>
  <li>Java 1.4</li>
  <li>MySQL</li>
</ol>
<ul>
  <li>Install marauroa</li>
  <li>Setup everything</li>
</ul>
<ol>
  <li>Database</li>
  <li>marauroa.ini</li>
</ol>
<ul>
  <li>Install as a service</li>
</ul>
<p>We can create a makefile to do this task.</p>
<hr />
<p>This document was originally written by Miguel Angel Blanch Lardin. It was then proof read by Stephen I. Even though the utmost care has been taken to make sure this document is correct and well written if you find any errors please feel free to modify the document and fix them.</p>
<hr /> 
</body>
</html>
<!-- This document saved from http://arianne.sourceforge.net/wiki/HowToWriteGamesUsingArianne -->
