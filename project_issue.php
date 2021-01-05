<?php
include_once 'class/user.php';
include_once 'class/project.php';
include_once 'class/issues.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$projects = new Project($db);
$issues = new Issues($db);

if(!$user->loggedIn()) {
	header("Location: index.php");
}
include './dashboard.php';
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="./assets/css/main.css">
<div class="table-wrapper">
	<table class="table" >
		<thead>
			<tr>
				<th>Project</th>
				<th>Issue</th>
				<th>Description</th>
				<th>Status</th>
				<th>Created</th>
				<th>Image Link</th>
				<th>Video Link</th>
				<th>Page Link</th>
			</tr>
		</thead>
	<?php
	$row = $issues->assignedIssues();
	foreach($row as $result) {
		$created_date = date("Y-m-d",strtotime($result['created_at']));
		echo
		"<tr>
			<td>" . ucfirst($result['project_name']) . "</td>
			<td>" . ucfirst($result['issue_title']) . "</td>
			<td>" . ucfirst($result['issue_desc']) .  "</td>
			<td>" . ucfirst($result['status']) .  "</td>
			<td>" . $created_date .  "</td>
			<td> <b><a href='img_uploads/{$result['issue_image']}' target='_blank'>Click Here</a></b></td>
			<td> <b><a href='vid_uploads/{$result['issue_video']}' target='_blank'>Click Here</a></b></td>
			<td> <b><a href='{$result['page_link']}' target='_blank'>Click Here</a></b></td>
		</tr>";
	}
	?>
	</table>
</div>
<?php  include './includes/footer.php' ?>
