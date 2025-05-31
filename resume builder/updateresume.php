
<?php
    $title = "Create Resume | resume builder";
    require './assets/include/header.php';
    require './assets/include/navbar.php';
    $fn->AuthPage();
    $slug=$_GET['resume']??'';
    $resumes =$db->query("SELECT * FROM resumes where (slug='$slug' AND  user_id =".$fn->Auth()['id'].") ");
    $resume = $resumes->fetch_assoc(); 
    if(!$resume){
        $fn->redirect('myresumes.php');
    }

    $exps=$db->query("SELECT * FROM experience where (resume_id=".$resume['id'].") ");
    $exps=$exps->fetch_all(1);
    
    $edus=$db->query("SELECT * FROM educations where (resume_id=".$resume['id'].") ");
    $edus=$edus->fetch_all(1);
    
    $skills=$db->query("SELECT * FROM skills where (resume_id=".$resume['id'].") ");
    $skills=$skills->fetch_all(1);
    ?>
    <div class="container">

        <div class="bg-white rounded shadow p-2 mt-4" style="min-height:80vh">
            <div class="d-flex justify-content-between border-bottom">
                <h5>Create Resume</h5>
                <div>
                    <a href = "myresumes.php" class="text-decoration-none" ><i class="bi bi-arrow-left-circle"></i> Back</a>
                </div>
            </div>

            <div>

                <form class="row g-3 p-3" method="POST" action = "actions/updateresume.action.php">
                <input type="hidden" name="id" value="<?=$resume['id']?>" >
                <input type="hidden" name="slug" value="<?=$resume['slug']?>" >
                <div class="col-md-6">
                        <label class="form-label">Resume Title</label>
                        <input type="text" name = "resume_title" value = "<?=@$resume['resume_title']?>" placeholder="Web Developer Consultant" class="form-control" required>
                    </div>
                
                <h5 class="mt-3 text-secondary"><i class="bi bi-person-badge"></i> Personal Information</h5>
                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text" name = "full_name" value = "<?=@$resume['full_name']?>" placeholder="Dev Ninja" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name = "email_id" value = "<?=@$resume['email_id']?>" placeholder="dev@abc.com" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label for="inputAddress" class="form-label"> Objective</label>
                        <textarea class = "form-control"  name = "objective"><?=@$resume['objective']?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Mobile No</label>
                        <input type="number" name = "mobile_no" value = "<?=@$resume['mobile_no']?>" min="1111111111" placeholder="9569569569" max="9999999999"
                        class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date Of Birth</label>
                        <input type="date" name = "dob" value = "<?=$resume['dob']?>" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Gender</label>
                        <select class="form-select" name = "gender">
                            <option <?=($resume['gender']=='Male')?'selected':''?>>Male</option>
                            <option <?=($resume['gender']=='Female')?'selected':''?> >Female</option>
                            <option <?=($resume['gender']=='Transgender')?'selected':''?> >Transgender</option>




                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Religion</label>
                        <select class="form-select" name  = "religion">
                            <option <?=($resume['religion']=='Hindu')?'selected':''?> >Hindu</option>
                            <option <?=($resume['religion']=='Muslim')?'selected':''?> >Muslim</option>
                            <option <?=($resume['religion']=='Sikh')?'selected':''?> >Sikh</option>
                            <option <?=($resume['religion']=='Christian')?'selected':''?> >Christian</option>



                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Nationality</label>
                        <select class="form-select" name = "nationality">
                            <option <?=($resume['nationality']=='Indian')?'selected':''?> >Indian</option>
                            <option <?=($resume['nationality']=='Non Indian')?'selected':''?> >Non Indian</option>


                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Marital Status</label>
                        <select class="form-select" name = "marital_status">
                            <option <?=($resume['marital_status']=='Married')?'selected':''?> >Married</option>
                            <option <?=($resume['marital_status']=='Single')?'selected':''?> >Single</option>
                            <option <?=($resume['marital_status']=='Divorced')?'selected':''?> >Divorced</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Hobbies</label>
                        <input type="text" name = "hobbies" value="<?=@$resume['hobbies']?>" placeholder="Reading Books, Watching Movies" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Languages Known</label>
                        <input type="text" name = "languages"  placeholder="Hindi,English" value="<?=@$resume['languages']?>" class="form-control" required>
                    </div>

                    <div class="col-12">
                        <label for="inputAddress" class="form-label"> Address</label>
                        <input type="text" value="<?=@$resume['address']?>" class="form-control" id="inputAddress" name = "address" placeholder="1234 Main St" required>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <h5 class=" text-secondary"><i class="bi bi-briefcase"></i> Experience</h5>
                        <div>
                            <a  class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#addexp"><i class="bi bi-file-earmark-plus"></i> Add New</a>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap">

<?php
if($exps){
    foreach($exps as $exp){
        ?>
<div class="col-12 col-md-6 p-2">
                            <div class="p-2 border rounded">
                                <div class="d-flex justify-content-between">
                                    <h6><?=$exp['position']?></h6>
                                    <a href="actions/deleteexp.action.php?id=<?=$exp['id']?>&resume_id=<?=$resume['id']?>&slug=<?=$resume['slug']?>"><i class="bi bi-x-lg"></i></a>
                                </div>

                                <p class="small text-secondary m-0" style="">
                                    <i class="bi bi-buildings"></i> <?=$exp['company']?> (<?=$exp['started'].' - '.$exp['ended']?>)
                                </p>
                                <p class="small text-secondary m-0" style="">
                                   <?=$exp['job_desc']?>
                                </p>

                            </div>
                        </div>

        <?php
    }
}else{
    
    ?>
<div class="col-12 col-md-6 p-2">
                            <div class="p-2 border rounded">
                                <div class="d-flex justify-content-between">
                                    <h6>I am Fresher</h6>
            
                                </div>

                               
                                <p class="small text-secondary m-0" style="">
                                    If you have experience, you can add it
                                </p>

                            </div>
                        </div>

<?php

}
?>
                        
                        
                        
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <h5 class=" text-secondary"><i class="bi bi-book"></i> Education</h5>
                        <div>
                            <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#addedu"><i class="bi bi-file-earmark-plus"></i> Add New</a>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap">
<?php
if($edus){
    foreach($edus as $edu){
        ?>
<div class="col-12 col-md-6 p-2">
                            <div class="p-2 border rounded">
                                <div class="d-flex justify-content-between">
                                    <h6><?=$edu['course']?></h6>
                                    <a href="actions/deleteedu.action.php?id=<?=$edu['id']?>&resume_id=<?=$resume['id']?>&slug=<?=$resume['slug']?>"><i class="bi bi-x-lg"></i></a>
                                </div>

                                <p class="small text-secondary m-0" style="">
                                    <i class="bi bi-buildings"></i> <?=$edu['institute']?> 
                                </p>
                                <p class="small text-secondary m-0" style="">
                                <?=$edu['started'].' - '.$edu['ended']?>
                                </p>

                            </div> 
                        </div>

        <?php
    }
}else{

    ?>
<div class="col-12 col-md-6 p-2">
                            <div class="p-2 border rounded">
                                <div class="d-flex justify-content-between">
                                    <h6>I have no education</h6>
            
                                </div>

                               
                                <p class="small text-secondary m-0" style="">
                                    If you have education, you can add it
                                </p>

                            </div>
                        </div>

<?php

}
?>                   
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <h5 class=" text-secondary"><i class="bi bi-boxes"></i> Skills</h5>
                        <div>
                            <a href="" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#addskill"><i class="bi bi-file-earmark-plus"></i> Add New</a>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap">
<?php
if($skills){
    foreach($skills as $skill){
        ?>
     <div class="col-12 p-2">
                            <div class="p-2 border rounded">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6><i class="bi bi-caret-right"></i> <?=$skill['skill']?></h6>
                                    <a href="actions/deleteskill.action.php?id=<?=$skill['id']?>&resume_id=<?=$resume['id']?>&slug=<?=$resume['slug']?>"><i class="bi bi-x-lg"></i></a>
                                </div>
                            </div>
                        </div>

        <?php
    }
}else{
    ?>
    <div class="col-12 p-2">
    <div class="p-2 border rounded">
        <div class="d-flex justify-content-between align-items-center">
            <h6><i class="bi bi-caret-right"></i> I have no skills</h6>
            
        </div>
    </div>
</div>


<?php
}

?>





</div>
<div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Update
                            Resume</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal exp -->
    <div class="modal fade" id="addexp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Experience</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method = "post" class="row g-3" action = "actions/addexperience.action.php">
      <input type="hidden" name="resume_id" value="<?=$resume['id']?>" >
      <input type="hidden" name="slug" value="<?=$resume['slug']?>" >
  <div class="col-12">
    <label for="inputEmail4" class="form-label">Position / Job Role</label>
    <input type="text" class="form-control" name = "position" placeholder = "Web Developer Consultant (2+ Years)" id="inputEmail4" required>
  </div>
  <div class="col-12">
    <label for="inputPassword4" class="form-label">Company</label>
    <input type="text" class="form-control" name = "company" placeholder = "Dominos,New Delhi" id="inputPassword4" required>
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Joined</label>
    <input type="text" name = "started" placeholder = "October 2021" class="form-control" id="inputPassword4" required>
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Resigned</label>
    <input type="text" name = "ended" placeholder = "Currently Pursuing" class="form-control" id="inputPassword4" required>
  </div>
  <div class="col-12">
  <label for="inputPassword4" class="form-label">Job Description</label>
    <textarea class = "form-control" name = "job_desc" required></textarea>
  </div>
  <div class="col-12 text-end">
    <button type="submit" class="btn btn-primary">Add Experience</button>
  </div>
</form>

      </div>
    </div>
  </div>
</div>
<!-- /modal -->
     <!-- modal edu-->
    <div class="modal fade" id="addedu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Education</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method = "post" class="row g-3" action = "actions/addeducation.action.php">
      <input type="hidden" name="resume_id" value="<?=$resume['id']?>" >
      <input type="hidden" name="slug" value="<?=$resume['slug']?>" >
  <div class="col-12">
    <label for="inputEmail4" class="form-label">Course / Degree</label>
    <input type="text" class="form-control" name = "course" placeholder = "Completed 12th Class (Arts Stream)" id="inputEmail4" required>
  </div>
  <div class="col-12">
    <label for="inputPassword4" class="form-label">Institute / Board</label>
    <input type="text" class="form-control" name = "institute" placeholder = " Central Board Of Secondary Education, New Delhi
    
    Passed" id="inputPassword4" required>
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Started</label>
    <input type="text" name = "started" placeholder = "October 2021" class="form-control" id="inputPassword4" required>
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Ended</label>
    <input type="text" name = "ended" placeholder = "Currently Pursuing" class="form-control" id="inputPassword4" required>
  </div>
  <div class="col-12 text-end">
    <button type="submit" class="btn btn-primary">Add Education</button>
  </div>
</form>
      </div>
    </div>
  </div>
</div>
<!-- /modal -->
      <!-- modal Skills-->
      <div class="modal fade" id="addskill" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Skills</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method = "post" class="row g-3" action = "actions/addskill.action.php">
        <input type="hidden" name="resume_id" value="<?=$resume['id']?>" >
        <input type="hidden" name="slug" value="<?=$resume['slug']?>" >
  <div class="col-12"> 
    <label for="inputEmail4" class="form-label">Skills</label>
    <input type="text" class="form-control" name = "skill" placeholder = "Basic Knowledge in Computer & Internet" id="inputEmail4" required>
  </div>
  <div class="col-12 text-end">
    <button type="submit" class="btn btn-primary">Add Skills</button>
  </div>
</form>
      </div>
    </div>
  </div>
</div>
<!-- /modal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
<?php
    require './assets/include/footer.php';
?>