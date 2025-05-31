<?php
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if($_POST) {
    $post = $_POST;

    // Validate all fields
    if($post['otp']) {
        $otp = $post['otp'];
        if($fn->getSession('otp') == $otp){
            $fn->setalert('email is verified !');
            $fn->redirect('../change-password.php');
        }else{  
            $fn->seterror('incorrect otp entered !');
            $fn->redirect('../verification.php');
        }
    }else{
        $fn->seterror('Please Enter 6 digit Code sended to your email id');
        $fn->redirect('../verification.php');
    }
} else {
    $fn->redirect('../verification.php');
}