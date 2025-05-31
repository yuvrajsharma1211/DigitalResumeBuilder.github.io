<?php
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if($_GET) {
    $post = $_GET;
    
    if(isset($post['id']) && !empty($post['id'])) {
        $resumeId = $post['id'];
        $authId = $fn->Auth()['id'];
        
        try {
            // Start transaction
            $db->begin_transaction();
            
            // Delete from skills table
            $stmt = $db->prepare("DELETE FROM skills WHERE resume_id = ? AND EXISTS (SELECT 1 FROM resumes WHERE id = ? AND user_id = ?)");
            $stmt->bind_param("iii", $resumeId, $resumeId, $authId);
            $stmt->execute();
            $skillsDeleted = $stmt->affected_rows;
            $stmt->close();
            
            // Delete from educations table
            $stmt = $db->prepare("DELETE FROM educations WHERE resume_id = ? AND EXISTS (SELECT 1 FROM resumes WHERE id = ? AND user_id = ?)");
            $stmt->bind_param("iii", $resumeId, $resumeId, $authId);
            $stmt->execute();
            $educationsDeleted = $stmt->affected_rows;
            $stmt->close();
            
            // Delete from experience table
            $stmt = $db->prepare("DELETE FROM experience WHERE resume_id = ? AND EXISTS (SELECT 1 FROM resumes WHERE id = ? AND user_id = ?)");
            $stmt->bind_param("iii", $resumeId, $resumeId, $authId);
            $stmt->execute();
            $experienceDeleted = $stmt->affected_rows;
            $stmt->close();
            
            // Delete from resumes table
            $stmt = $db->prepare("DELETE FROM resumes WHERE id = ? AND user_id = ?");
            $stmt->bind_param("ii", $resumeId, $authId);
            $stmt->execute();
            $resumeDeleted = $stmt->affected_rows;
            $stmt->close();
            
            // Commit transaction
            $db->commit();
            
            if($resumeDeleted > 0) {
                $message = "Resume completely deleted from database!";
                if($skillsDeleted > 0) {
                    $message .= " Deleted " . $skillsDeleted . " skill record(s).";
                }
                if($educationsDeleted > 0) {
                    $message .= " Deleted " . $educationsDeleted . " education record(s).";
                }
                if($experienceDeleted > 0) {
                    $message .= " Deleted " . $experienceDeleted . " experience record(s).";
                }
                $fn->setalert($message);
            } else {
                $fn->setalert("No matching resume found or you don't have permission to delete it.");
            }
            
            $fn->redirect('../myresumes.php');
        } catch(Exception $error) {
            // Rollback transaction on error
            $db->rollback();
            $fn->seterror($error->getMessage());
            $fn->redirect('../myresumes.php');
        }
    } else {
        $fn->seterror('Please provide a valid resume ID!');
        $fn->redirect('../myresumes.php');
    }
} else {
    $fn->redirect('../myresumes.php');
}
?>