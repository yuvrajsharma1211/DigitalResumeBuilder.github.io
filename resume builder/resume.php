<?php
   require 'assets/class/database.class.php';
   require 'assets/class/function.class.php';
    $fn->AuthPage();
    $slug=$_GET['resume']??'';
    $resumes =$db->query("SELECT * FROM resumes where (slug='$slug') ");
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Premium Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="icon" href="./assets/images/logo.png">
    <title><?=$resume['full_name'].'|'.$resume['resume_title']?></title>
    <!-- html2pdf with enhanced configuration -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #34495e;
            --accent-color: #3498db;
            --text-color: #2c3e50;
            --light-bg: #f8f9fa;
            --section-spacing: 1.5rem;
            --current-font: 'Poppins', sans-serif;
        }

        /* PDF-specific styles */
        @media print {
            body {
                background: white !important;
            }
            .page {
                box-shadow: none !important;
                margin: 0 !important;
                padding: 1.5cm !important;
            }
            .action-buttons {
                display: none !important;
            }
            #photoModal {
                display: none !important;
            }
        }

        /* Base styles */
        body {
            font-family: var(--current-font);
            font-size: 14px;
            color: var(--text-color);
            background: #f5f7fa;
            line-height: 1.6;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .pdf-export {
            background: white;
            color: var(--text-color);
        }

        .action-buttons {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            display: flex;
            gap: 10px;
            background: white;
            padding: 12px 15px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }

        .action-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
        }

        .action-btn:hover {
            background: var(--accent-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .font-options {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            padding: 10px;
            display: none;
            width: 180px;
            z-index: 1001;
        }

        .font-option {
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 4px;
            transition: all 0.2s;
            font-size: 14px;
        }

        .font-option:hover {
            background: #f0f4f8;
            transform: translateX(3px);
        }

        .page {
            width: 21cm;
            min-height: 29.7cm;
            padding: 2cm;
            margin: 1.5cm auto;
            background: white;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .page::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        }

        .header {
            text-align: center;
            margin-bottom: 2.5rem;
            position: relative;
        }

        .header h1 {
            font-size: 2.4rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .header h1::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: var(--accent-color);
            margin: 0.8rem auto;
            border-radius: 2px;
        }

        .contact-info {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1.2rem;
            margin-bottom: 1rem;
        }

        .contact-info div {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-title {
            font-size: 1.3rem;
            color: var(--secondary-color);
            margin: 1.8rem 0 1rem;
            font-weight: 600;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--accent-color);
        }

        .experience, .education {
            margin-bottom: 1.8rem;
            position: relative;
            padding-left: 1.8rem;
        }

        .experience::before, .education::before {
            content: '';
            position: absolute;
            left: 0;
            top: 8px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--accent-color);
        }

        .job-role, .course {
            font-weight: 600;
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        .company, .institute {
            font-weight: 500;
            color: var(--secondary-color);
            margin: 0.4rem 0;
        }

        .work-period, .study-period {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 0.6rem;
            display: inline-block;
            padding: 0.3rem 0.8rem;
            background: #f0f4f8;
            border-radius: 4px;
        }

        .skills-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
        }

        .skill {
            background: #e3f2fd;
            color: var(--primary-color);
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .signature {
            margin-top: 3rem;
            padding-top: 1.5rem;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-between;
        }

        /* Photo styles */
        .photo-container {
    position: absolute;
    top: 60px; /* Increased from 30px to move it down */
    left: 70px; /* Already moved right from previous adjustment */
    width: 140px;
    height: 140px;
    border: 3px solid var(--accent-color);
    border-radius: 50%;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f8f9fa;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
.photo-placeholder {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: #666;
    font-size: 12px;
    padding: 10px;
    border-radius: 50%; /* Make placeholder circular too */
}

.photo-placeholder i {
    font-size: 32px; /* Made icon larger */
    margin-bottom: 5px;
    color: var(--accent-color);
}

        .photo-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
        /* Modal styles */
        .modal-content {
            border-radius: 10px;
            border: none;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }

        .modal-header {
            background: var(--primary-color);
            color: white;
            border-bottom: none;
            border-radius: 10px 10px 0 0;
        }

        .modal-body {
            padding: 25px;
        }

        .photo-option-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            border: 2px dashed #ddd;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            margin-bottom: 15px;
            text-align: center;
            height: 100%;
        }

        .photo-option-btn:hover {
            border-color: var(--accent-color);
            background: #f8f9fa;
        }

        .photo-option-btn i {
            font-size: 36px;
            margin-bottom: 10px;
            color: var(--accent-color);
        }

        .camera-preview {
            width: 100%;
            height: 300px;
            background: #f1f1f1;
            margin-bottom: 15px;
            display: none;
        }

        .camera-preview video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .capture-btn {
            display: none;
            width: 100%;
            margin-top: 10px;
        }

        .preview-image {
            max-width: 100%;
            max-height: 300px;
            display: none;
            margin: 0 auto 15px;
        }

        /* Font-specific styles */
        .font-poppins { font-family: 'Poppins', sans-serif; }
        .font-playfair { font-family: 'Playfair Display', serif; }
        .font-source { font-family: 'Source Sans Pro', sans-serif; }
        .font-merriweather { font-family: 'Merriweather', serif; }
        .font-raleway { font-family: 'Raleway', sans-serif; }
    </style>
</head>

<body>

    <div class="action-buttons">
        <button class="action-btn" id="printBtn">
            <i class="bi bi-printer"></i> Print
        </button>
        
        <button class="action-btn" id="shareBtn">
            <i class="bi bi-share"></i> Share
        </button>
        
        <div style="position: relative;">
            <button class="action-btn" id="fontBtn">
                <i class="bi bi-fonts"></i> Font
            </button>
            <div class="font-options" id="fontOptions">
                <div class="font-option font-poppins" data-font="'Poppins', sans-serif">Poppins (Modern)</div>
                <div class="font-option font-playfair" data-font="'Playfair Display', serif">Playfair (Elegant)</div>
                <div class="font-option font-source" data-font="'Source Sans Pro', sans-serif">Source Sans (Clean)</div>
                <div class="font-option font-merriweather" data-font="'Merriweather', serif">Merriweather (Classic)</div>
                <div class="font-option font-raleway" data-font="'Raleway', sans-serif">Raleway (Professional)</div>
            </div>
        </div>
        
        <button class="action-btn" id="downloadBtn">
            <i class="bi bi-download"></i> Download PDF
        </button>
        
        <button class="action-btn" id="photoBtn">
            <i class="bi bi-camera"></i> Add Photo
        </button>
    </div>

    <!-- Photo Upload Modal -->
    <div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="photoModalLabel">Add Your Photo</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="photo-option-btn" id="uploadPhotoBtn">
                                <i class="bi bi-upload"></i>
                                <h6>Upload Photo</h6>
                                <p class="small text-muted">From your computer</p>
                                <input type="file" id="fileInput" accept="image/*" style="display: none;">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="photo-option-btn" id="takePhotoBtn">
                                <i class="bi bi-camera"></i>
                                <h6>Take Photo</h6>
                                <p class="small text-muted">Using your camera</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="camera-preview" id="cameraPreview">
                        <video id="video" autoplay playsinline></video>
                    </div>
                    
                    <img id="previewImage" class="preview-image" alt="Preview">
                    
                    <div class="d-flex gap-2">
                        <button class="btn btn-primary flex-grow-1" id="captureBtn" style="display: none;">
                            <i class="bi bi-camera"></i> Capture Photo
                        </button>
                        <button class="btn btn-outline-secondary flex-grow-1" id="retakeBtn" style="display: none;">
                            <i class="bi bi-arrow-repeat"></i> Retake
                        </button>
                    </div>
                    
                    <div class="d-grid gap-2 mt-3">
                        <button class="btn btn-success" id="savePhotoBtn" style="display: none;">
                            <i class="bi bi-check-circle"></i> Save Photo
                        </button>
                        <button class="btn btn-danger" id="removePhotoBtn">
                            <i class="bi bi-trash"></i> Remove Photo
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page" id="resume-content">
        <div class="subpage pdf-export">
            <!-- Photo Container -->
            <div class="photo-container" id="photoContainer">
                <div class="photo-placeholder" id="photoPlaceholder">
                    <i class="bi bi-person-square"></i>
                    <span>Your Photo</span>
                </div>
                <img id="photoImg" class="photo-img" style="display: none;">
            </div>
            
            <div class="header">
                <h1><?=$resume['full_name']?></h1>
                <p><?=$resume['resume_title']?></p>
            </div>

            <div class="personal-info">
                <div class="contact-info">
                    <div><i class="bi bi-telephone"></i> +91-<?=$resume['mobile_no']?></div>
                    <div><i class="bi bi-envelope"></i> <?=$resume['email_id']?></div>
                    <div><i class="bi bi-geo-alt"></i> <?=$resume['address']?></div>
                </div>
            </div>

            <div class="section">
                <div class="section-title">Objective</div>
                <div class="section-content">
                    <?=$resume['objective']?>
                </div>
            </div>

            <div class="section">
                <div class="section-title">Experience</div>
                <div class="section-content">
                    <?php if($exps): ?>
                        <?php foreach($exps as $exp): ?>
                            <div class="experience">
                                <div class="job-role"><?=$exp['position']?></div>
                                <div class="company"><?=$exp['company']?></div>
                                <div class="work-period">
                                    <?=$exp['started']?> – <?=$exp['ended']?>
                                </div>
                                <?php if(!empty($exp['job_desc'])): ?>
                                <div class="work-description"><?=$exp['job_desc']?></div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="experience">
                            <div class="company">I am a Fresher</div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="section">
                <div class="section-title">Education</div>
                <div class="section-content">
                    <?php if($edus): ?>
                        <?php foreach($edus as $edu): ?>
                            <div class="education">
                                <div class="course"><?=$edu['course']?></div>
                                <div class="institute"><?=$edu['institute']?></div>
                                <div class="study-period">
                                    <?=$edu['started']?> – <?=$edu['ended']?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="education">
                            <div class="institute">No education details available</div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="section">
                <div class="section-title">Skills</div>
                <div class="section-content">
                    <div class="skills-list">
                        <?php if($skills): ?>
                            <?php foreach($skills as $skill): ?>
                                <div class="skill"><?=$skill['skill']?></div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="skill">No skills listed</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="section">
                <div class="section-title">Personal Details</div>
                <div class="section-content">
                    <table class="pd-table">
                        <tr>
                            <td>Date of Birth</td>
                            <td><?=date('d F Y',strtotime($resume['dob']))?></td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td><?=$resume['gender']?></td>
                        </tr>
                        <tr>
                            <td>Religion</td>
                            <td><?=$resume['religion']?></td>
                        </tr>
                        <tr>
                            <td>Nationality</td>
                            <td><?=$resume['nationality']?></td>
                        </tr>
                        <tr>
                            <td>Marital Status</td>
                            <td><?=$resume['marital_status']?></td>
                        </tr>
                        <tr>
                            <td>Hobbies</td>
                            <td><?=$resume['hobbies']?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="section">
                <div class="section-title">Languages Known</div>
                <div class="section-content">
                    <?=$resume['languages']?>
                </div>
            </div>

            <div class="section">
                <div class="section-title">Declaration</div>
                <div class="section-content">
                    I hereby declare that above information is correct to the best of my
                    knowledge and can be supported by relevant documents as and when
                    required.
                </div>
            </div>

            <div class="signature">
                <div class="date"><?=date('d F Y',$resume['updated_at'])?></div>
                <div class="name"><?=$resume['full_name']?></div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Initialize Bootstrap modal
        const photoModal = new bootstrap.Modal(document.getElementById('photoModal'));
        
        // Font changer functionality
        const fontBtn = document.getElementById('fontBtn');
        const fontOptions = document.getElementById('fontOptions');
        
        fontBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            fontOptions.style.display = fontOptions.style.display === 'block' ? 'none' : 'block';
        });
        
        document.querySelectorAll('.font-option').forEach(option => {
            option.addEventListener('click', (e) => {
                e.stopPropagation();
                const fontFamily = option.getAttribute('data-font');
                document.documentElement.style.setProperty('--current-font', fontFamily);
                document.body.style.fontFamily = fontFamily;
                fontOptions.style.display = 'none';
            });
        });
        
        document.addEventListener('click', () => {
            fontOptions.style.display = 'none';
        });

        // Print functionality
        document.getElementById('printBtn').addEventListener('click', () => {
            window.print();
        });

        // Share functionality
        document.getElementById('shareBtn').addEventListener('click', async () => {
            try {
                const title = "<?=$resume['full_name']?> - <?=$resume['resume_title']?>";
                const url = window.location.href;
                
                if (navigator.share) {
                    await navigator.share({
                        title: title,
                        text: 'Check out my professional resume',
                        url: url,
                    });
                } else {
                    const shareUrl = `mailto:?subject=${encodeURIComponent(title)}&body=${encodeURIComponent(`Check out my resume: ${url}`)}`;
                    window.location.href = shareUrl;
                }
            } catch (err) {
                navigator.clipboard.writeText(window.location.href).then(() => {
                    alert('Resume link copied to clipboard!');
                });
            }
        });

        // Enhanced PDF Download
        document.getElementById('downloadBtn').addEventListener('click', () => {
            const element = document.getElementById('resume-content');
            const opt = {
                margin: [15, 5, 15, 5],
                filename: '<?=$resume['full_name']?>_Resume.pdf',
                image: { 
                    type: 'jpeg', 
                    quality: 0.98 
                },
                html2canvas: { 
                    scale: 2,
                    letterRendering: true,
                    useCORS: true,
                    allowTaint: true,
                    logging: true,
                    backgroundColor: '#FFFFFF'
                },
                jsPDF: { 
                    unit: 'mm', 
                    format: 'a4', 
                    orientation: 'portrait',
                    compress: true
                },
                pagebreak: { 
                    mode: ['avoid-all', 'css', 'legacy'] 
                }
            };
            
            // Show loading state
            const btn = document.getElementById('downloadBtn');
            const originalHTML = btn.innerHTML;
            btn.innerHTML = '<i class="bi bi-hourglass"></i> Preparing PDF...';
            btn.disabled = true;
            
            // Add a small delay to allow the button state to update
            setTimeout(() => {
                html2pdf().set(opt).from(element).save().then(() => {
                    btn.innerHTML = originalHTML;
                    btn.disabled = false;
                });
            }, 300);
        });

        // Photo upload functionality
        document.getElementById('photoBtn').addEventListener('click', () => {
            photoModal.show();
        });

        // Check if there's a saved photo in localStorage
        const savedPhoto = localStorage.getItem('resumePhoto');
        if (savedPhoto) {
            document.getElementById('photoImg').src = savedPhoto;
            document.getElementById('photoImg').style.display = 'block';
            document.getElementById('photoPlaceholder').style.display = 'none';
        }

        // Upload photo from file
        document.getElementById('uploadPhotoBtn').addEventListener('click', () => {
            document.getElementById('fileInput').click();
        });

        document.getElementById('fileInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('previewImage').src = event.target.result;
                    document.getElementById('previewImage').style.display = 'block';
                    document.getElementById('cameraPreview').style.display = 'none';
                    document.getElementById('captureBtn').style.display = 'none';
                    document.getElementById('retakeBtn').style.display = 'none';
                    document.getElementById('savePhotoBtn').style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

        // Take photo with camera
        let stream = null;
        document.getElementById('takePhotoBtn').addEventListener('click', async () => {
            document.getElementById('cameraPreview').style.display = 'block';
            document.getElementById('previewImage').style.display = 'none';
            
            try {
                stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
                document.getElementById('video').srcObject = stream;
                document.getElementById('captureBtn').style.display = 'block';
                document.getElementById('savePhotoBtn').style.display = 'none';
            } catch (err) {
                alert('Could not access the camera. Please make sure you have granted camera permissions.');
                console.error(err);
            }
        });

        // Capture photo from camera
        document.getElementById('captureBtn').addEventListener('click', () => {
            const video = document.getElementById('video');
            const canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
            
            const imageDataUrl = canvas.toDataURL('image/png');
            document.getElementById('previewImage').src = imageDataUrl;
            document.getElementById('previewImage').style.display = 'block';
            document.getElementById('captureBtn').style.display = 'none';
            document.getElementById('retakeBtn').style.display = 'block';
            document.getElementById('savePhotoBtn').style.display = 'block';
        });

        // Retake photo
        document.getElementById('retakeBtn').addEventListener('click', () => {
            document.getElementById('previewImage').style.display = 'none';
            document.getElementById('captureBtn').style.display = 'block';
            document.getElementById('retakeBtn').style.display = 'none';
            document.getElementById('savePhotoBtn').style.display = 'none';
        });

        // Save photo
        document.getElementById('savePhotoBtn').addEventListener('click', () => {
            const imageSrc = document.getElementById('previewImage').src;
            if (imageSrc) {
                document.getElementById('photoImg').src = imageSrc;
                document.getElementById('photoImg').style.display = 'block';
                document.getElementById('photoPlaceholder').style.display = 'none';
                localStorage.setItem('resumePhoto', imageSrc);
                photoModal.hide();
                
                // Stop camera stream if active
                if (stream) {
                    stream.getTracks().forEach(track => track.stop());
                    stream = null;
                }
            }
        });

        // Remove photo
        document.getElementById('removePhotoBtn').addEventListener('click', () => {
            document.getElementById('photoImg').style.display = 'none';
            document.getElementById('photoPlaceholder').style.display = 'flex';
            localStorage.removeItem('resumePhoto');
            photoModal.hide();
            
            // Stop camera stream if active
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                stream = null;
            }
            
            // Reset preview
            document.getElementById('previewImage').style.display = 'none';
            document.getElementById('previewImage').src = '';
            document.getElementById('cameraPreview').style.display = 'none';
            document.getElementById('captureBtn').style.display = 'none';
            document.getElementById('retakeBtn').style.display = 'none';
            document.getElementById('savePhotoBtn').style.display = 'none';
            document.getElementById('fileInput').value = '';
        });

        // Clean up camera stream when modal is closed
        document.getElementById('photoModal').addEventListener('hidden.bs.modal', function () {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                stream = null;
            }
            
            // Reset preview
            document.getElementById('previewImage').style.display = 'none';
            document.getElementById('previewImage').src = '';
            document.getElementById('cameraPreview').style.display = 'none';
            document.getElementById('captureBtn').style.display = 'none';
            document.getElementById('retakeBtn').style.display = 'none';
            document.getElementById('savePhotoBtn').style.display = 'none';
            document.getElementById('fileInput').value = '';
        });

        // Ensure fonts are loaded before PDF generation
        document.fonts.ready.then(() => {
            console.log('All fonts loaded');
        });
    </script>

</body>
</html>