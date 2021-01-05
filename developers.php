<?php
include_once 'class/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

include './dashboard.php';
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<table class="table dev_table">
	<thead>
		<tr>
			<th>ID</th>
			<th>Developer</th>
			<th>Email</th>
		</tr>
	</thead>
<?php
$row = $user->listDev();
foreach ($row as $result) {
	echo
	"<tr>
		<td>" . $result['user_id'] . "</td>
		<td>" . ucfirst($result['username']) . "</td>
		<td>" . $result['email'] .  "</td>
		<!--  <td>
		<a href='#viewModal'  id='".$result['user_id']."'><img src='./assets/images/writing.png' alt='edit-icon'></a>
		<a href='#delete'  id='".$result['user_id']."'><img src='./assets/images/delete.png' alt='edit-icon'> </a>
		</td>-->
	</tr>";
}
?>
</table>
<script src="./assets/js/project.js"></script>
<?php  include './includes/footer.php' ?>
