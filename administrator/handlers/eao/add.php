<?php
    session_start();
    require_once "../../../connection/connection.php";
    require_once "../functions.php";

    if($_POST){
        catch_empty_values($_POST, '../add-eaos.php');

        if (strlen($_POST["staff_id"]) < 7) {
            $_SESSION['error'] = 'Staff ID too short, must be at least 7 characters';
            header('Location: ../../add-eaos.php');
            die();
        }

        if (strlen($_POST["password"]) < 8) {
            $_SESSION['error'] = 'Password too short, must be at least 8 characters';
            header('Location: ../../add-eaos.php');
            die();
        }

        $name = sanitise_string($_POST['full_name']);
        $email = sanitise_string($_POST['email']);
        $staff_id = sanitise_string($_POST['staff_id']);
        $password = password_hash(sanitise_string($_POST['password']), PASSWORD_DEFAULT);

        //check if account does not already exist
        $check = $connection->prepare('SELECT * FROM eaos WHERE staff_id = :staff_id OR email = :email');
        $check->bindParam(':staff_id', $staff_id);
        $check->bindParam(':email', $email);
        $check->execute();
        if($check->rowCount()){
            $_SESSION['error'] = 'Unable to create your account. Account already exists';
            header('Location: ../../add-eaos.php');
            die();
        }

        // create user account 
        $query = $connection->prepare('INSERT INTO eaos (name, email, staff_id, password) VALUES (:name, :email, :staff_id, :password)');
        $query->bindParam(':name', $name);
        $query->bindParam(':email', $email);
        $query->bindParam(':staff_id', $staff_id);
        $query->bindParam(':password', $password);
        if($query->execute()){
            $_SESSION['success'] = 'Account created successfully';
            header('Location: ../../eaos.php');
        }else{
            $_SESSION['error'] = 'Unable to create account. Please try again later';
            header('Location: ../../add-eaos.php');
        }
    }
?>