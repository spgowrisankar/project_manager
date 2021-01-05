<?php
include_once 'class/user.php';
include_once 'class/project.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$projects = new Project($db);

if(!$user->loggedIn()) {
	header("Location: index.php");
}
include './dashboard.php';
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="./assets/css/main.css">
<div class="table-wrapper">
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Project Name</th>
				<th>Project Manager</th>
				<th>Created At</th>
				<th>Status</th>
				<th>Development</th>
				<th>Launch</th>
			</tr>
		</thead>
	<?php
	$row = $projects->assignedProject();
	foreach($row as $result) {
		$created_date = date("Y-m-d",strtotime($result['created_at']));
		echo
		"<tr>
			<td>" . ucfirst($result['id']) . "</td>
			<td>" . ucfirst($result['project_name']) . "</td>
			<td>" . ucfirst($result['username']) .  "</td>
			<td>" . $created_date .  "</td>
			<td>" . ucfirst($result['status']) .  "</td>
			<td>" . $result['dev_date'] .  "</td>
			<td>" . $result['launch_date'] .  "</td>
			<!-- <td>
				<button type='button'name='update' id='".$result['id']."' class='btn update'><img src='./assets/images/writing.png' alt='edit-icon'></button>
				<button type='button' name='delete' id='".$result['id']."' class='btn delete'><img src='./assets/images/delete.png' alt='edit-icon'></button>
			</td>-->
		</tr>";
	}
	?>
	</table>
</div>
<script src="./assets/js/libraries/jquery.validate.js"></script>
<script src="./assets/js/project.js"></script>
<?php  include './includes/footer.php' ?>
