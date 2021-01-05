<div class="top_menu">
	<p class="topmenu_head">Hello, <?php echo ucfirst($_SESSION["user_name"]); ?>!!</p>
</div>
<ul class="nav nav-tabs" id="nav_tabs">
	<?php
	if($_SESSION["user_role"] == 'admin' || $_SESSION["user_role"] == 'pm') { ?>
		<li id="projects"><a class="nav-link active" href="project.php">Projects</a></li>
		<li id="developer"><a class="nav-link" href="developers.php">Developers</a></li>
		<li id="issues"><a class="nav-link" href="issues.php">Issues</a></li>
	<?php
	}
	?>

	<?php
	if($_SESSION["user_role"] == 'dev') { ?>
		<li ><a class="nav-link" href="task.php">Projects</a></li>
		<li id="issues"><a class="nav-link" href="project_issue.php">Issues</a></li>
	<?php
	}
	?>
</ul>
