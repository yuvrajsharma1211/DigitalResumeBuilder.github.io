<?php
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if($_POST) {
    $post = $_POST;

    // Validate all fields
    if(empty($post['email_id']) || empty($post['password'])) {
        $fn->seterror('Please fill all fields!');
        $fn->redirect('../register.php');
        die();
    }

    $email_id = $db->real_escape_string($post['email_id']);
    $password = md5($db->real_escape_string($post['password']));

    // Check if email exists
    $result = $db->query("SELECT id,full_name FROM users WHERE (email_id = '$email_id' && password = '$password')");
    $result = $result->fetch_assoc();
    if($result){
        $fn->setAuth($result);
        $fn->setAlert('logged in !');
        $fn->redirect('../myresumes.php');
    }else{
        $fn->seterror('Incorrect email id or password');
        $fn->redirect('../login.php');
    }
} else {
    $fn->redirect('../login.php');
}