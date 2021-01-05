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
<div class="add_button">
	<button type="button" id="addProject" class="btn button" title="Add project"><img src='./assets/images/plus.png' alt='Add-Project'></button>
</div>
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
	$row = $projects->listProject();
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
			<td>
				<button type='button' name='update' id='".$result['id']."' class='btn update'><img src='./assets/images/writing.png' alt='edit-icon'></button>
				<button type='button' name='delete' id='".$result['id']."' class='btn delete'><img src='./assets/images/delete.png' alt='edit-icon'></button>
			</td>
		</tr>";
	}
	?>
	</table>
</div>
<div id="projectModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="projectForm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><i class="fa fa-plus"></i> Update Record</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="project" class="control-label">Project Name</label>
						<input type="text" class="form-control" id="project_id" name="project_id" required>
					</div>
					<div class="form-group">
						<label for="project_manager" class="control-label">Project Manager</label>
						<select class="form-control" id="project_manager" name="project_manager"/>
							<?php
							$result = $projects->managerList();
							while($manager = $result->fetch_assoc()) {
								?>
								<option value="<?php echo $manager['user_id']; ?>"><?php echo ucfirst($manager['username']); ?></option>
								<?php
							} ?>
						</select>
					</div>
					<div class="form-group">
						<label for="developer" class="control-label">Assign To</label>
						<select class="form-control" id="developer" name="developer"/>
							<?php
							$row = $user->listDev();
							foreach($row as $developer) {
								?>
								<option value="<?php echo $developer['user_id']; ?>"><?php echo ucfirst($developer['username']); ?></option>
								<?php
							} ?>
						</select>
					</div>
					<div class="form-group">
						<label for="status" class="control-label">Status</label>
						<select class="form-control" id="status" name="status"/>
							<option value="1">On Hold</option>
							<option value="2">Active</option>
							<option value="3">Inprogress</option>
						</select>
					</div>
					<div class="form-group">
						<label for="phone" class="control-label">Developmet Date</label>
						<input type="date" class="form-control" id="dev_date" name="dev_date" required>
					</div>
					<div class="form-group">
						<label for="phone" class="control-label">Launch Date</label>
						<input type="date" class="form-control" id="launch_date" name="launch_date" required>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" id="id" />
					<input type="hidden" name="action" id="action" value="" />
					<input type="submit" name="save" id="save" class="btn modal_button" value="Save" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="./assets/js/project.js"></script>
<?php  include './includes/footer.php' ?>
