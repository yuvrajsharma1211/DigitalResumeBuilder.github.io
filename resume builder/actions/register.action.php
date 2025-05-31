<?php
session_start();
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';
if($_POST){
    $post = $_POST;
    if($_POST["full_name"] && $_POST["email_id"] && $_POST["password"]){
        $full_name = $db->real_escape_string($post['full_name']);
        $email_id = $db->real_escape_string($post['email_id']);
        $password = md5($db->real_escape_string($post['password']));


        $result = $db->query("SELECT COUNT(*) AS USER FROM USERS WHERE (email_id = '$email_id' && password = '$password')");
        $result = $result->fetch_assoc();


        if($result['user']){
            $fn->seterror($email_id.'is already registered !');
            $fn->redirect('../register.php');   
            die();
        }
        try{
            $db->query("INSERT INTO users(full_name,email_id,password) VALUES('$full_name','$email_id','$password')");
            $fn->setalert("You register successfuly !");
            $fn->redirect('../login.php');
        }catch(Exception $error){
            $fn->seterror($error->getMessage());
            $fn->redirect('../register.php');
        }

    }else{
        $fn->seterror('Please fill the form !');  
    }
}else{
    $fn->redirect('../register.php');
}