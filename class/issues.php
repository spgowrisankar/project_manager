<?php
require_once('./config/database.php');

class Issues extends Database {
    private $table = 'issues';
    private $projectstable = 'projects';
    private $issue_status = 'issue_status';
    private $usertable = 'users';
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function projectsList() {
        $projects_query = "SELECT * FROM ".$this->projectstable." WHERE status_code = '0'";
        $stmt = $this->conn->prepare($projects_query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function listIssues() {
        $list_issues = "SELECT i.id, p.project_name, i.issue_title , i.issue_desc, i.issue_image, i.issue_video, c.status, i.created_at, i.page_link";
        $list_issues .= " FROM ".$this->table." i";
        $list_issues .= " LEFT JOIN ".$this->issue_status." c ON c.id = i.issue_status_id ";
        $list_issues .= " LEFT JOIN ".$this->projectstable." p ON p.id = i.project_id";
        $list_issues .= " WHERE i.status_code = '0'";
        $stmt = $this->conn->prepare($list_issues);
        $stmt->execute();
        $result = $stmt->get_result();
        $data= array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function getIssue() {
        if($this->id) {
            $sqlQuery = "SELECT * FROM ".$this->table." ";
            $sqlQuery .= "WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bind_param("i", $this->id);
            $stmt->execute();
            $result = $stmt->get_result();
            $record = $result->fetch_assoc();
            echo json_encode($record);
        }
        return $result;
    }

    public function insertIssue() {
        if($this->project_id) {
            $insert_query = "INSERT INTO ".$this->table."(`issue_title`, `issue_desc`,`issue_status_id`,`issue_image`,`issue_video`, `page_link`, `project_id`)";
            $insert_query .= "VALUES(?,?,?,?,?,?,?)";
            $stmt = $this->conn->prepare($insert_query);
            $this->project_id = htmlspecialchars(strip_tags($this->project_id));
            $this->issue_title = htmlspecialchars(strip_tags($this->issue_title));
            $this->issue_desc = htmlspecialchars(strip_tags($this->issue_desc));
            $this->issue_status_id = htmlspecialchars(strip_tags($this->issue_status_id));
            $this->issue_image = htmlspecialchars(strip_tags($this->issue_image));
            $this->issue_video = htmlspecialchars(strip_tags($this->issue_video));
            $this->page_link = htmlspecialchars(strip_tags($this->page_link));
            $stmt->bind_param("ssisssi", $this->issue_title, $this->issue_desc, $this->issue_status_id, $this->issue_image, $this->issue_video, $this->page_link, $this->project_id);
            if($stmt->execute()) {
                return true;
            }
        }
        return false;
    }

    public function updateIssue() {
        if($this->id) {
            $update_query = "UPDATE ".$this->table." ";
            $update_query .= "SET `issue_title` = ?, `issue_desc` = ?, `issue_status_id` = ?,`issue_image` = ?,`issue_video` = ?, `page_link` = ?, `project_id` = ? ";
            $update_query .= "WHERE id = ? ";
            $stmt = $this->conn->prepare($update_query);
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->project_id = htmlspecialchars(strip_tags($this->project_id));
            $this->issue_title = htmlspecialchars(strip_tags($this->issue_title));
            $this->issue_desc  = htmlspecialchars(strip_tags($this->issue_desc));
            $this->issue_status_id = htmlspecialchars(strip_tags($this->issue_status_id));
            $this->issue_image = htmlspecialchars(strip_tags($this->issue_image));
            $this->issue_video = htmlspecialchars(strip_tags($this->issue_video));
            $this->page_link = htmlspecialchars(strip_tags($this->page_link));
            $stmt->bind_param("ssisssii", $this->issue_title, $this->issue_desc, $this->issue_status_id, $this->issue_image, $this->issue_video, $this->page_link, $this->project_id,$this->id);
            if($stmt->execute()) {
                return true;
            }
        }
        return false;
    }

    public function delete() {
        if($this->id) {
            $delete_query = "UPDATE ".$this->table." SET `status_code` = '1' ";
            $delete_query .= "WHERE id = ?";
            $stmt = $this->conn->prepare($delete_query);
            $this->id = htmlspecialchars(strip_tags($this->id));
            $stmt->bind_param("i", $this->id);
            if($stmt->execute()) {
                return true;
            }
        }
        return false;
    }
    public function assignedIssues() {
        $list_issues = "SELECT i.id, p.project_name, i.issue_title , i.issue_desc, i.issue_image, i.issue_video, c.status, i.created_at, i.page_link";
        $list_issues .= " FROM ".$this->table." i";
        $list_issues .= " LEFT JOIN ".$this->issue_status." c ON c.id = i.issue_status_id ";
        $list_issues .= " LEFT JOIN ".$this->projectstable." p ON p.id = i.project_id";
        $list_issues .= " WHERE i.status_code = '0' AND p.developer_id = {$_SESSION['user_id']}";;
        $stmt = $this->conn->prepare($list_issues);
        $stmt->execute();
        $result = $stmt->get_result();
        $data= array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
}
?>
