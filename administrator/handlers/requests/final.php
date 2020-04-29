<?php
session_start();
require_once "../../../connection/connection.php";
require_once "../functions.php";

if ($_POST) {
    $status = $_POST['status'];
    $experiment_id = $_POST['experiment_id'];
    $exid = $_POST['id'];

    $query = $connection->prepare('UPDATE approval_requests SET status = :status WHERE experiment_id = :id');
    $query->bindParam(':status', $status);
    $query->bindParam(':id', $experiment_id);
    if($query->execute()){
        $_SESSION['success'] = 'Feedback given successfully';
        header("location: ../../feedback-details.php?id=$exid");
    }else{
        $_SESSION['error'] = 'Unable to give feedback. Please try again';
        header("location: ../../feedback-details.php?id=$exid");
    }
}
