<?php
    session_start();
    require_once "../../../connection/connection.php";
    require_once "../functions.php";

    if($_GET){
        $query = $connection->prepare('DELETE FROM eaos WHERE id = :id');        
        $query->bindParam(':id', sanitise_string($_GET['id']));        
        if($query->execute()){                        
            $_SESSION['success'] = 'EAO deleted';            
        }else{
            $_SESSION['error'] = 'Unable to delete eao';            
        }
        header("location: ../../eaos.php");
    }
?>