<?php
include 'class/project.php';
$database = new Database();
$db = $database->getConnection();

$project = new Project($db);

if(!empty($_POST['action']) && $_POST['action'] == 'getProject') {
	$project->id = $_POST["id"];
	$project->getProject();
}

if(!empty($_POST['action']) && $_POST['action'] == 'addProject') {
	$project->project_name = $_POST["project_id"];
	$project->project_manager_id = $_POST["project_manager"];
	$project->developer_id = $_POST["developer"];
	$project->status = $_POST["status"];
	$project->dev_date = $_POST["dev_date"];
	$project->launch_date = $_POST["launch_date"];
	$project->insert_project();
}

if(!empty($_POST['action']) && $_POST['action'] == 'updateProject') {
	$project->id = $_POST["id"];
	$project->project_name = $_POST["project_id"];
	$project->project_manager_id = $_POST["project_manager"];
	$project->developer_id = $_POST["developer"];
	$project->status = $_POST["status"];
	$project->dev_date = $_POST["dev_date"];
	$project->launch_date = $_POST["launch_date"];
	$project->updateProject();
}

if(!empty($_POST['action']) && $_POST['action'] == 'deleteProject') {
	$project->id = $_POST["id"];
	$project->delete();
}
?>
