<?php
session_start();
require_once "../../../connection/connection.php";
require_once "../functions.php";

if ($_POST) {
    $request_id = $_POST['request_id'];
    $eaos = $_POST['eao'];
    if (count($eaos) < 2) {
        $_SESSION['error'] = 'Approval request must be assigned to atleast 2 experiment approval officers';
        header("location: ../../request-details.php?id=$request_id");
        die();
    }

    $query = $connection->prepare('DELETE FROM assigned_requests WHERE request_id = :request_id');
    $query->bindParam(':request_id', $request_id);
    $query->execute();

    foreach ($eaos as $eao) {
        $query = $connection->prepare('INSERT INTO assigned_requests (request_id, eao_id) VALUES (:request_id, :eao_id)');
        $query->bindParam(':request_id', $request_id);
        $query->bindParam(':eao_id', $eao);
        $query->execute();
    }

    $_SESSION['success'] = 'Approval request assigned successfully';
    header("location: ../../request-details.php?id=$request_id");
   
}
