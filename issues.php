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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<div class="add_button">
	<button type="button" id="addIssue" class="btn button" title="Add Issue"><img src='./assets/images/plus.png' alt='Add-Issue'></button>
</div>
<div class="table-wrapper">
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Project</th>
				<th>Issue</th>
				<th>Description</th>
				<th>Status</th>
				<th>Created</th>
				<th>Image</th>
				<th>Video</th>
				<th>Page Link</th>
				<th></th>
			</tr>
		</thead>
	<?php
	$row = $issues->listIssues();
	foreach($row as $result) {
		$created_date = date("Y-m-d",strtotime($result['created_at']));
		echo
		"<tr>
			<td>" . $result['id'] . "</td>
			<td>" . ucfirst($result['project_name']) . "</td>
			<td>" . ucfirst($result['issue_title']) . "</td>
			<td>" . ucfirst($result['issue_desc']) .  "</td>
			<td>" . ucfirst($result['status']) .  "</td>
			<td>" . $created_date .  "</td>
			<td> <b><a href='img_uploads/{$result['issue_image']}' target='_blank'>Click Here</a></b></td>
			<td> <b><a href='vid_uploads/{$result['issue_video']}' target='_blank'>Click Here</a></b></td>
			<td> <b><a href='{$result['page_link']}' target='_blank'>Click Here</a></b></td>
			<td>
				<button type='button' name='update' id='".$result['id']."' class='btn update'><img src='./assets/images/writing.png' alt='edit-icon'></button>
				<button type='button' name='delete' id='".$result['id']."' class='btn delete'><img src='./assets/images/delete.png' alt='edit-icon'></button>
			</td>
		</tr>";
	}
	?>
	</table>
</div>
<div id="issueModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="issueForm" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><i class="fa fa-plus"></i> Update Record</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="project_id" class="control-label">Project Name</label>
						<select class="form-control" id="project_id" name="project_id"/>
							<?php
							$result = $issues->projectsList();
							foreach($result as $project_name) {
								?>
								<option value="<?php echo $project_name['id']; ?>"><?php echo ucfirst($project_name['project_name']); ?></option>
								<?php
							} ?>
						</select>
					</div>
					<div class="form-group">
						<label for="issue_title" class="control-label">Issue</label>
						<input type="text" class="form-control" id="issue_title" name="issue_title" required>
					</div>
					<div class="form-group">
						<label for="issue_desc" class="control-label">Description</label>
						<input type="text" class="form-control" id="issue_desc" name="issue_desc" required>
					</div>
					<div class="form-group">
						<label for="issue_status_id" class="control-label">Status</label>
						<select class="form-control" id="issue_status_id" name="issue_status_id"/>
							<option value="1">Todo</option>
							<option value="2">In Progress</option>
							<option value="3">In Review</option>
							<option value="4">Completed</option>
						</select>
					</div>
					<div class="form-group">
						<label for="issue_image" class="control-label">Issue Image</label>
						<input type="file" class="form-control" id="issue_image" name="issue_image">
						<input type="hidden" name="img_updated" id="img_value" value="">
						<div class="modal_image" id="modal_image">
							<img src="" alt="Image Not Available!!">
						</div>
					</div>
					<div class="form-group">
						<label for="issue_video" class="control-label">Issue Video</label>
						<input type="file" class="form-control" id="issue_video" name="issue_video">
						<input type="hidden" name="vid_updated" id="vid_value" value="">
						<div class="modal_video" id="modal_video">
						<video src="" width="280" height="200" controls autoplay poster="assets/images/novideo.png"></video>
						</div>
					</div>
					<div class="form-group">
						<label for="page_link" class="control-label">Page Link</label>
						<input type="text" class="form-control" id="page_link" name="page_link" required>
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
<script src="./assets/js/issues.js"></script>
<?php  include './includes/footer.php' ?>
