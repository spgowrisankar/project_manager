<?php
require_once('./config/database.php');

class Uploads extends Database {

    public function __construct($db) {
        $this->conn = $db;
    }

    // Upload Image
    public function uploadImgFile() {
        $img_response = '';
        if(isset($_FILES['issue_image']['name'])) {
            $uploadDir = 'img_uploads/';
            $fileName = basename($_FILES["issue_image"]["name"]);
            $targetFilePath = $uploadDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            $allowTypes = array("jpg","jpeg","png");

            if(in_array($fileType, $allowTypes)) {
                if(move_uploaded_file($_FILES["issue_image"]["tmp_name"], $targetFilePath)) {
                    $img_response = $fileName;
                }
            }
        }
        return $img_response;
    }

    // Upload Video
    public function uploadVidFile() {
        $vid_response = '';
        if(isset($_FILES['issue_video']['name'])) {
            $uploadDir = 'vid_uploads/';
            $fileName = basename($_FILES["issue_video"]["name"]);
            $targetFilePath = $uploadDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            $allowTypes = array("mp3", "mp4", "wma");

            if(in_array($fileType, $allowTypes)) {
                if(move_uploaded_file($_FILES["issue_video"]["tmp_name"], $targetFilePath)) {
                    $vid_response = $fileName;
                }
            }
        }
        return $vid_response;
    }
}
?>
