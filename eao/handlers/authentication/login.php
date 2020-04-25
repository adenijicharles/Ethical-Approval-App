<?php
    session_start();
    require_once "../../../connection/connection.php";
    require_once "../functions.php";

    if($_POST){
        catch_empty_values($_POST, '../login.php');        
        $username = sanitise_string($_POST['username']);
        $password = sanitise_string($_POST['password']);

        $query = $connection->prepare('SELECT * FROM eaos WHERE staff_id = :staff_id OR email = :email');
        $query->bindParam(':staff_id', $username);
        $query->bindParam(':email', $username);
        $query->execute();
        $fetch = $query->fetch(PDO::FETCH_ASSOC);        

        if(!$query->rowCount() || $query->rowCount() != 1 || !password_verify($password, $fetch['password'])){
            $_SESSION['error'] = 'Invalid email or password';
            header('Location: ../../index.php');
            die();
        }
        if($query->execute()){            
            $_SESSION['eao'] = [
                "id" => $fetch['id'],
                "staff_id" => $fetch['staff_id'],
                "email" => $fetch['email'],
                "name" => $fetch['name']
            ];
            $_SESSION['success'] = 'Login successful';
            header('Location: ../../dashboard.php');            
        }else{
            $_SESSION['error'] = 'Invalid email or password';
            header('Location: ../../index.php');
        }
    }
?>