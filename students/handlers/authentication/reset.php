<?php
    session_start();
    require_once "../../../connection/connection.php";
    require_once "../functions.php";

    if($_POST){
        catch_empty_values($_POST, '../login.php');        
        $details = sanitise_string($_POST['user']);

        $query = $connection->prepare('SELECT * FROM students WHERE student_id = :student_id OR email = :email');
        $query->bindParam(':student_id', $details);
        $query->bindParam(':email', $details);
        $query->execute();
        $fetch = $query->fetch(PDO::FETCH_ASSOC);        


        if($query->rowCount() === 1){            
            $_SESSION['password_reset_id'] = $fetch['id'];
            $_SESSION['success'] = 'Reset your password below';
            header('Location: ../../update-password.php');            
        }else{
            $_SESSION['error'] = 'Invalid email or student id';
            header('Location: ../../reset.php');
        }
    }
?>