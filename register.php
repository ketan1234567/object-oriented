<?php



require 'db.php'; // This file contains the database connection setup
require 'FormHandler.php';


$formHandler = new FormHandler();
$message = $formHandler->handle($_POST);
//print_r($_POST);
//exit();
echo $message;



?>
