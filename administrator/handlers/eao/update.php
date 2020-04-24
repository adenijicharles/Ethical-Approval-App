<?php
    session_start();
    require_once "../../../connection/connection.php";
    require_once "../functions.php";

    if($_POST){
        $id = sanitise_string($_POST['id']);
        catch_empty_values($_POST, "../edit-eao.php?id=$id");

        $name = sanitise_string($_POST['full_name']);
        $email = sanitise_string($_POST['email']);
        $staff_id = sanitise_string($_POST['staff_id']);
        $password = password_hash(sanitise_string($_POST['password']), PASSWORD_DEFAULT);


        $query = $connection->prepare('UPDATE eaos SET name = :name, email = :email, staff_id = :staff_id, password = :password WHERE id = :id');
        $query->bindParam(':name', $name);
        $query->bindParam(':id', $id);
        $query->bindParam(':email', $email);
        $query->bindParam(':staff_id', $staff_id);
        $query->bindParam(':password', $password);
        if($query->execute()){
            $_SESSION['success'] = 'EAO details updated successfully';
            header('Location: ../../eaos.php');
        }else{
            $_SESSION['error'] = 'Unable to update experiment. Please try again later';
            header("Location: ../../edit-eao.php?id=$id");
        }
    }
?>