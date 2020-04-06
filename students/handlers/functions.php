<?php
function catch_empty_values($post_array, $redirect){
    $error = [];
    $_SESSION['form_values'] = $post_array;

    foreach ($post_array as $key => $value) {
        if (empty(trim($value))) {
            $key = ucfirst(str_replace("_", " ", $key)) . " is required <br>";
            array_push($error, $key);
        }
    }
    if (count($error) > 0) {
        $_SESSION['error'] = implode("", $error);
        header("location: ../$redirect");
        die();
    }
}

function sanitise_string($string){
    $string = filter_var($string, FILTER_SANITIZE_STRING);
    $string = trim($string);
    $string = stripslashes($string);
    $string = htmlentities($string);
    return $string;
}