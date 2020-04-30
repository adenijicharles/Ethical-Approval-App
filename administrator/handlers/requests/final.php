<?php
session_start();
require_once "../../../connection/connection.php";
require_once "../functions.php";
// require_once '../../../vendor/autoload.php';

// use Mailgun\Mailgun;


if ($_POST) {
    $status = $_POST['status'];
    $experiment_id = $_POST['experiment_id'];
    $exid = $_POST['id'];

    $query = $connection->prepare('UPDATE approval_requests SET status = :status WHERE experiment_id = :id');
    $query->bindParam(':status', $status);
    $query->bindParam(':id', $experiment_id);
    if($query->execute()){

        //send notifications to student using mailgun
        $query = $connection->prepare('SELECT * FROM experiments LEFT JOIN students ON experiments.student_id = students.student_id WHERE experiments.id = :id');
        $query->bindParam(':id', $experiment_id);
        $query->execute();
        $fetch = $query->fetch();

        $status_message = $status === 1 ? "Approved" : "Rejected";
        $experiment_title = $fetch['title'];
        $student_name = $fetch['name'];
        $student_email = $fetch['email'];
        $message = "
            Dear <b>$student_name</b> <br>
            The approval request that you submitted for experiment titled <b>$experiment_title</b> has been <b>$status_message</b>
        ";

        mail($student_email, 'Experiment Approval Request Feedback', $message);
        $_SESSION['success'] = 'Feedback given successfully';
        header("location: ../../feedback-details.php?id=$exid");
    }else{
        $_SESSION['error'] = 'Unable to give feedback. Please try again';
        header("location: ../../feedback-details.php?id=$exid");
    }
}
