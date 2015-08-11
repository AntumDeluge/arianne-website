<?php
class Contact extends Page {
	public function writeHtmlHeader() {
		echo '<title>Contact'.ARIANNE_TITLE.'</title>';
	}

	public function writeContent() {
?>
<div class="section"><h1>Contact information</h1>
<p>You can contact the project leaders, nhnb or kymara, at: NAME <i>at</i> users <i>tod</i> sourceforge <i>tod</i> net<br/>

<h2>IRC</h2>
<p>You may wish to chat live with the team on IRC. You can get an IRC client and connect to:</p>

<p><b>irc.freenode.net</b> (see <a href="https://freenode.net">http://freenode.net</a> for more information) then</p>
<ul> 
<li> <b>#arianne</b> which is for technical discussion, getting help and planning.</li>
<li><b>#arianne-chat</b> which is for friendly chatter </li>
</ul>
<p>
Alternatively, you can simply use freenode's webchat service, below. </p>
<ul> 
<li>
<a href="https://webchat.freenode.net/?channels=arianne">#arianne</a></li>
<li>
<a href="https://webchat.freenode.net/?channels=arianne-chat">#arianne-chat</a></li>
</ul>
<h2>Forums</h2>
<p>There are also a number of Forums on our Sourceforge project page. <a href="https://sourceforge.net/p/arianne/discussion/">The forums are located here.</a></p>

<h2>Join/Help Arianne</h2>
<p>Yep, Arianne is open source and we welcome everyone willing to fight side 
by side with us in our brave effort :-)</p>
<p>Take a look to Sourceforge Bugs Trackers, create a new exciting game, help 
fix this website or promote Arianne all around the world are a few of the many options. Please remember to contact us if you wish to participate.</p>

<h2>Mailing Lists</h2>
You can also contact the whole group at the mailing list. There are several mailing lists available:</p>
<ul>
<li><a href="https://lists.sourceforge.net/mailman/listinfo/arianne-general">arianne-general</a> general subjects mailing list</li>
<li><a href="https://lists.sourceforge.net/mailman/listinfo/arianne-devel">arianne-devel</a> development talk mailing list</li>
<li><a href="https://lists.sourceforge.net/mailman/listinfo/arianne-announce">arianne-announce</a> read-only release announces mailing list</li>
</ul>
<?php
	}
}
$page = new Contact();