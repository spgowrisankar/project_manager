<?php
include_once 'class/issues.php';
include_once 'class/uploads.php';

$database = new Database();
$db = $database->getConnection();

$issues = new Issues($db);
$uploads = new Uploads($db);

$uploadImgFile = $uploads->uploadImgFile();
$uploadVidFile = $uploads->uploadVidFile();

if(!empty($_POST['action']) && $_POST['action'] == 'getIssue') {
	$issues->id = $_POST["id"];
	$issues->getIssue();
}

if(!empty($_POST['action']) && $_POST['action'] == 'addIssue') {
	$issues->project_id  = $_POST["project_id"];
	$issues->issue_title = $_POST["issue_title"];
	$issues->issue_desc = $_POST["issue_desc"];
	$issues->issue_status_id = $_POST["issue_status_id"];
	$issues->issue_image = $uploadImgFile;
	$issues->issue_video = $uploadVidFile;
	$issues->page_link = $_POST["page_link"];
	$issues->insertIssue();
}

if(!empty($_POST['action']) && $_POST['action'] == 'updateIssue') {
	$issues->id = $_POST["id"];
	$issues->project_id  = $_POST["project_id"];
	$issues->issue_title = $_POST["issue_title"];
	$issues->issue_desc = $_POST["issue_desc"];
	$issues->issue_status_id = $_POST["issue_status_id"];
	$issues->page_link = $_POST["page_link"];
	$issues->updateIssue();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateIssue') {
	$issues->id = $_POST["id"];
	$issues->issue_image = $uploadImgFile;
	$issues->issue_video = $uploadVidFile;
	$issues->updateMedia();
}

if(!empty($_POST['action']) && $_POST['action'] == 'deleteIssue') {
	$issues->id = $_POST["id"];
	$issues->delete();
}
?>
