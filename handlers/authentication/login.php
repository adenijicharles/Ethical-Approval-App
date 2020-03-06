<?php
    session_start();
    require_once "../../connection/connection.php";
    require_once "../functions.php";

    if($_POST){
        catch_empty_values($_POST, '../login.php');        
        $username = sanitise_string($_POST['username']);
        $password = sanitise_string($_POST['password']);

        $query = $connection->prepare('SELECT * FROM students WHERE student_id = :student_id OR email = :email');
        $query->bindParam(':student_id', $username);
        $query->bindParam(':email', $student_id);
        $query->execute();
        $fetch = $query->fetch(PDO::FETCH_ASSOC);

        if(!$query->rowCount() || !password_verify($password, $fetch['password'])){
            $_SESSION['error'] = 'Invalid email or password';
            header('Location: ../../index.php');
            die();
        }

        //compare typed password with hashed password from database
        if($query->execute()){
            
            $_SESSION['user'] = [
                "id" => $fetch['id'],
                "student_id" => $fetch['student_id'],
                "email" => $fetch['email'],
                "name" => $fetch['name']
            ];

            $_SESSION['success'] = 'Login successful';
            header('Location: ../../dashboard.php');
        }else{
            $_SESSION['error'] = 'Unable to create your account. Please try again later';
            header('Location: ../../index.php');
        }
    }
?>