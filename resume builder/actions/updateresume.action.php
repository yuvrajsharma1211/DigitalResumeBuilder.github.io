<?php
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if($_POST){
    $post = $_POST;
    if($post['full_name'] && $post['email_id'] && $post['objective'] && $post['mobile_no'] && $post['dob'] && $post['gender'] && $post['religion'] && $post['nationality'] && $post['marital_status'] && $post['hobbies'] && $post['languages'] && $post['address']){
        $columns = '';
        $values = '';
        $post2=$post;
        unset($post2['id']);
        unset($post2['slug']);
        foreach($post2 as $index=>$value){
            $value = $db->real_escape_string($value);
            $columns.= $index."='$value',";
           
        }
        
        $columns.='updated_at='.time();
       
        try{
            $query = "UPDATE resumes SET ";
            $query .= $columns;
            $query .= " WHERE id='".$post['id']."' AND slug='".$db->real_escape_string($post['slug'])."'";
            $db->query($query);
            $fn->setalert("resume updated !");
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