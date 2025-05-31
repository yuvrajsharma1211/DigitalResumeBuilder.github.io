<?php
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if($_POST){
    $post = $_POST;

    // echo "<pre>";
    // print_r($post);
    // die();

    if($post['resume_id'] && $post['skill']){
        
        $resume_id=array_shift($post);
        $post2=$post;
        unset($post['slug']);
        $columns = '';
        $values = '';
        foreach($post as $index=>$value){
            $value = $db->real_escape_string($value);
            $columns.= $index.',';
            $values.= "'$value',";
        }
        
       $columns.='resume_id';
       $values.=$resume_id;


        try{
            $query = "INSERT INTO skills";
            $query.= "($columns)";
            $query.= "VALUES($values)";

           
            $db->query($query);
            $fn->setalert("Skill added !");
            $fn->redirect('../updateresume.php?resume='.$post2['slug']);
        }catch(Exception $error){
            $fn->seterror($error->getMessage());
            $fn->redirect('../updateresume.php?resume='.$post2['slug']);
        }
    }else{
        $fn->seterror('Please fill the form !');
        $fn->redirect('../updateresume.php?resume='.$post2['slug']);
    }
}else{
    $fn->redirect('../updateresume.php?resume='.$post2['slug']);
}

?>