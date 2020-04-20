<?php
    session_start();
    require_once "../../../connection/connection.php";
    require_once "../functions.php";

    if($_POST){
        catch_empty_values($_POST, '../register.php');

        if (strlen($_POST["student_id"]) < 7) {
            $_SESSION['error'] = 'Student ID too short, must be at least 7 characters';
            header('Location: ../../register.php');
            die();
        }

        if (strlen($_POST["password"]) < 8) {
            $_SESSION['error'] = 'Password too short, must be at least 8 characters';
            header('Location: ../../register.php');
            die();
        }

        $name = sanitise_string($_POST['full_name']);
        $email = sanitise_string($_POST['email']);
        $student_id = sanitise_string($_POST['student_id']);
        $password = password_hash(sanitise_string($_POST['password']), PASSWORD_DEFAULT);

        //check if account does not already exist
        $check = $connection->prepare('SELECT * FROM students WHERE student_id = :student_id OR email = :email');
        $check->bindParam(':student_id', $student_id);
        $check->bindParam(':email', $email);
        $check->execute();
        if($check->rowCount()){
            $_SESSION['error'] = 'Unable to create your account. Account already exists';
            header('Location: ../../register.php');
            die();
        }

        // create user account 
        $query = $connection->prepare('INSERT INTO students (name, email, student_id, password) VALUES (:name, :email, :student_id, :password)');
        $query->bindParam(':name', $name);
        $query->bindParam(':email', $email);
        $query->bindParam(':student_id', $student_id);
        $query->bindParam(':password', $password);
        if($query->execute()){
            $_SESSION['success'] = 'Account created successfully';
            header('Location: ../../index.php');
        }else{
            $_SESSION['error'] = 'Unable to create your account. Please try again later';
            header('Location: ../../register.php');
        }
    }
?>