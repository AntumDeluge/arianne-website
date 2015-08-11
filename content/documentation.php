<?php
class Documentation extends Page {

	public function writeHtmlHeader() {
		echo '<title>Documentation'.ARIANNE_TITLE.'</title>';
		
	}

	public function writeContent() {
?>
<div class="section"><h1>Documentation</h1>
<p>Documentation for Arianne is mainly in project packages as text docs and 
javadocs comments but we also keep other online live documentation on our 
Wiki.</p>

<h2>Wiki</h2>
<p>A Wiki is an editable website for creating documentation. <a href="https://stendhalgame.org/wiki/Marauroa" class="navi"><b>Framework documentation.</b></a>. 
</p>

<h2>Reporting bugs</h2>
<p>Bugs are a fact of life and are always lurking somewhere in programs. To help 
us eliminate them please report any erroneous execution by submitting Bug 
Reports on our Sourceforge pages.</p>

<h3>Before you submit:</h3>
<p>When creating the report please include the following information:</p>
<ul>
  <li>The version of the package you are using, or the date you updated your CVS</li>
  <li>A detailed explanation of the problem and when it occurs</li>
  <li>Any output log files generated</li>
  <li>The basic spec of your PC (processor, RAM, Graphics Card, Operating System)</li>
</ul>
<p><a href="https://sourceforge.net/p/arianne/bugs/">Click 
here to submit a Bug</a></p>

<h2>Source code</h2>
<p>We use CVS and Git extensively to manage our source code. Please see the documentation and repository list at the
<a href="https://stendhalgame.org/wiki/Arianne_Source_Code_Repositories">arianne source code repositories</a> article.</p>

<p>Browse online the repositories in <a href="https://sourceforge.net/p/arianne/_list/git">git</a>.
</div>
<?php
	}
}
$page = new Documentation();