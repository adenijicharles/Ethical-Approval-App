<?php
    session_start();
    require_once "../../../connection/connection.php";
    require_once "../functions.php";

    if($_POST){
        catch_empty_values($_POST, '../register.php');
        $title = sanitise_string($_POST['title']);
        $description = sanitise_string($_POST['description']);        
        $id = sanitise_string($_POST['id']);


        $query = $connection->prepare('UPDATE experiments SET title = :title, description = :description WHERE id = :id');
        $query->bindParam(':title', $title);
        $query->bindParam(':description', $description);
        $query->bindParam(':id', $id);
        if($query->execute()){
            $_SESSION['success'] = 'Experiment updated successfully';
            header('Location: ../../dashboard.php');
        }else{
            $_SESSION['error'] = 'Unable to update experiment. Please try again later';
            header("Location: ../../edit-experiment.php?id=$id");
        }
    }
?>