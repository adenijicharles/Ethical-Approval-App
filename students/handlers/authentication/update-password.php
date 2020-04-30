<?php
    session_start();
    require_once "../../../connection/connection.php";
    require_once "../functions.php";

    if($_POST){
        catch_empty_values($_POST, '../update-password.php');

        if (strlen($_POST["password"]) < 8) {
            $_SESSION['error'] = 'Password too short, must be at least 8 characters';
            header('Location: ../../update-password.php');
            die();
        }

        if ($_POST["password"] != $_POST['confirm_password']) {
            $_SESSION['error'] = 'Passwords do not match';
            header('Location: ../../update-password.php');
            die();
        }

        $password = password_hash(sanitise_string($_POST['password']), PASSWORD_DEFAULT);
        // create user account 
        $query = $connection->prepare('UPDATE students SET password = :password WHERE id = :id');
        $query->bindParam(':password', $password);
        $query->bindParam(':id', $_SESSION['password_reset_id']);
        if($query->execute()){
            $_SESSION['success'] = 'Password updated successfully';
            header('Location: ../../index.php');
        }else{
            $_SESSION['error'] = 'Unable to update your password. Please try again later';
            header('Location: ../../update-password.php');
        }
    }
?>