<?php
    session_start();
    require_once "../../../connection/connection.php";
    require_once "../functions.php";

    if($_POST){
        catch_empty_values($_POST, '../add-experiment.php');
        $title = sanitise_string($_POST['title']);
        $description = sanitise_string($_POST['description']);        
        $query = $connection->prepare('INSERT INTO experiments (student_id, title, description) VALUES (:student_id, :title, :description)');
        $query->bindParam(':title', $title);
        $query->bindParam(':description', $description);
        $query->bindParam(':student_id', $_SESSION['user']['student_id']);
        if($query->execute()){
            $_SESSION['success'] = 'Experiment created successfully';
            header('Location: ../../dashboard.php');
        }else{
            $_SESSION['error'] = 'Unable to add new experiment. Please try again later';
            header('Location: ../../add-experiment.php');
        }
    }
?>