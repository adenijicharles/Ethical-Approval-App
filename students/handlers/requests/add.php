<?php
    session_start();
    require_once "../../../connection/connection.php";
    require_once "../functions.php";

    if($_POST){
        //catch_empty_values($_POST, '../register.php');

        $uploaded_files = [];
        foreach($_FILES['files']['name'] as $key => $val){
            $tmpname  = $_FILES['files']['tmp_name'][$key];
            $fileName  = $_FILES['files']['name'][$key];


            $pathinfo = pathinfo($fileName);
            $fileExtension = $pathinfo['extension'];
            $uploadFileDir = '../../../uploads/';
            
            $allowedfileExtensions = array('jpg', 'gif', 'png', 'txt', 'xls', 'xlsx', 'docx', 'doc', 'pdf');
            if (in_array($fileExtension, $allowedfileExtensions)) {
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $destination = $uploadFileDir . $newFileName;
                move_uploaded_file($tmpname, $destination);
                array_push($uploaded_files, $newFileName);
            }
        }
        $files = json_encode([]);
        if(count($uploaded_files)){
            $files = json_encode($uploaded_files);
        }

    
        $reasons = sanitise_string($_POST['reasons']);        
        $id = sanitise_string($_POST['id']);     


        $query = $connection->prepare('INSERT INTO approval_requests (experiment_id, reasons, files) VALUES (:experiment_id, :reasons, :files)');
        $query->bindParam(':experiment_id', $id);
        $query->bindParam(':reasons', $reasons);
        $query->bindParam(':files', $files);
        if($query->execute()){
            $_SESSION['success'] = 'Approval request submitted successfully';
            header('Location: ../../dashboard.php');
        }else{
            $_SESSION['error'] = 'Unable to submit approval request. Please try again later';
            header("Location: ../../submit-approval-request.php?id=$experiment_id");
        }
    }
?>