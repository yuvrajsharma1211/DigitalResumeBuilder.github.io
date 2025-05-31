<?php
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if($_GET){
    $post = $_GET;

   

    if($post['id'] && $post['resume_id']){
        


        try{
            $query = "DELETE FROM educations WHERE id={$post['id']} AND resume_id={$post['resume_id']}";
            
            $db->query($query);
            $fn->setalert("education deleted !");
            $fn->redirect('../updateresume.php?resume='.$post['slug']);
        }catch(Exception $error){
            $fn->seterror($error->getMessage());
            $fn->redirect('../updateresume.php?resume='.$post['slug']);
        }
    }else{
        $fn->seterror('Please fill the form !');
        $fn->redirect('../updateresume.php?resume='.$post['slug']);
    }
}else{
    $fn->redirect('../updateresume.php?resume='.$post['slug']);
}

?>