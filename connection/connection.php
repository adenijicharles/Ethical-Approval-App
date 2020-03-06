<?php 
require_once "constants.php";
try {
    $connection = new PDO("mysql:host=".CONNECTION_DETAILS['HOST'].";dbname=".CONNECTION_DETAILS['DBNAME'], CONNECTION_DETAILS['USER'], CONNECTION_DETAILS['PASS']);
}catch (\PDOException $e){
    print 'Error connection to database'. $e->getMessage();
    die();
}