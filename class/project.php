<?php
require_once('./config/database.php');

class Project extends Database {
    private $table = 'projects';
    private $status_table = 'project_status';
    private $user_table = 'users';
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }
    // Get project record for updation
    public function getProject() {
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
    }

    // Project Listing
    public function listProject() {
        $list_projects = "SELECT p.id, p.project_name, u.username, p.created_at, s.status, p.dev_date, p.launch_date";
        $list_projects .= " FROM ".$this->table." p";
        $list_projects .= " LEFT JOIN ".$this->status_table." s ON s.id = p.status_id";
        $list_projects .= " LEFT JOIN ".$this->user_table." u ON u.user_id = p.project_manager_id";
        $list_projects .= " WHERE p.status_code = '0'";
        $stmt = $this->conn->prepare($list_projects);
        $stmt->execute();
        $result = $stmt->get_result();
        $data= array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    // PM List
    public function managerList() {
        $manager_query = "SELECT * FROM ".$this->user_table." WHERE role='pm'";
        $stmt = $this->conn->prepare($manager_query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    // Insert New Project
    public function insert_project() {
        if($this->project_name) {
            $insert_query = "INSERT INTO ".$this->table."(`project_name`, `project_manager_id`,`developer_id`, `status_id`, `dev_date`,`launch_date`)";
            $insert_query .= "VALUES(?,?,?,?,?,?)";
            $stmt = $this->conn->prepare($insert_query);
            $this->project_name = htmlspecialchars(strip_tags($this->project_name));
            $this->project_manager_id = htmlspecialchars(strip_tags($this->project_manager_id));
            $this->developer_id = htmlspecialchars(strip_tags($this->developer_id));
            $this->status = htmlspecialchars(strip_tags($this->status));
            $this->dev_date = htmlspecialchars(strip_tags($this->dev_date));
            $this->launch_date = htmlspecialchars(strip_tags($this->launch_date));
            $stmt->bind_param("siiiss", $this->project_name, $this->project_manager_id, $this->developer_id, $this->status, $this->dev_date, $this->launch_date);
            if($stmt->execute()) {
                return true;
            }
        }
        return false;
    }

    // Updating Record
    public function updateProject() {
        if($this->id) {
            $update_query = "UPDATE ".$this->table." ";
            $update_query .= "SET `project_name` = ?, `project_manager_id` = ?, `developer_id` = ?, `status_id` = ?, `dev_date` = ?, `launch_date` = ? ";
            $update_query .= "WHERE id = ? ";
            $stmt = $this->conn->prepare($update_query);
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->project_name = htmlspecialchars(strip_tags($this->project_name));
            $this->project_manager_id = htmlspecialchars(strip_tags($this->project_manager_id));
            $this->developer_id = htmlspecialchars(strip_tags($this->developer_id));
            $this->status = htmlspecialchars(strip_tags($this->status));
            $this->dev_date = htmlspecialchars(strip_tags($this->dev_date));
            $this->launch_date = htmlspecialchars(strip_tags($this->launch_date));
            $stmt->bind_param("siiissi", $this->project_name, $this->project_manager_id, $this->developer_id, $this->status, $this->dev_date, $this->launch_date, $this->id);

            if($stmt->execute()) {
                return true;
            }
        }
        return false;
    }

    // Deleting Project
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

    // For Developer login
    public function assignedProject() {
        $dev_projects = "SELECT p.id, p.project_name, u.username, p.created_at, s.status, p.dev_date, p.launch_date";
        $dev_projects .= " FROM ".$this->table." p";
        $dev_projects .= " LEFT JOIN ".$this->status_table." s ON s.id = p.status_id";
        $dev_projects .= " LEFT JOIN ".$this->user_table." u ON u.user_id = p.project_manager_id";
        $dev_projects .= " WHERE p.status_code = '0' AND p.developer_id = {$_SESSION['user_id']}";
        $stmt = $this->conn->prepare($dev_projects);
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
