<?php
session_start();
require_once "../../../connection/connection.php";
require_once "../functions.php";

if ($_POST) {
    $status = $_POST['status'];
    $feedback = $_POST['feedback'];
    $id = $_POST['id'];
    $exid = $_POST['exid'];

    $query = $connection->prepare('UPDATE assigned_requests SET feedback = :feedback, feedback_status = :status WHERE request_id = :id AND eao_id = :eao');
    $query->bindParam(':feedback', $feedback);
    $query->bindParam(':status', $status);
    $query->bindParam(':eao', $_SESSION['eao']['staff_id']);
    $query->bindParam(':id', $id);
    if($query->execute()){
        $_SESSION['success'] = 'Feedback given successfully';
        header("location: ../../request-details.php?id=$exid");
    }else{
        $_SESSION['error'] = 'Unable to give feedback. Please try again';
        header("location: ../../request-details.php?id=$exid");
    }


}
