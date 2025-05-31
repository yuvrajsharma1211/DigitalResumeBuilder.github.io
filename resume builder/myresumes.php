<?php
    $title = "My Resumes | resume builder";
    require './assets/include/header.php';
    require './assets/include/navbar.php';
    $fn->AuthPage();
    $resumes = $db->query('SELECT * FROM resumes where user_id ='.$fn->Auth()['id'].' ORDER BY id DESC');
    $resumes = $resumes->fetch_all(1);
?>
    <div class="container">

        <div class="bg-white rounded shadow p-2 mt-4" style="min-height:80vh">
            <div class="d-flex justify-content-between border-bottom pb-3 align-items-center">
                <h5 class="m-0 text-primary fw-bold">My Resumes</h5>
                <div>
                    <a href="createresume.php" class="btn btn-primary btn-sm">
                        <i class="bi bi-file-earmark-plus me-1"></i>Create New Resume
                    </a>
                </div>
            </div>
            
            <?php if($resumes): ?>
            <div class="row mt-4 animate__animated animate__fadeIn">
                <?php foreach($resumes as $resume): ?>
                <div class="col-12 col-md-6 col-lg-4 p-3 resume-card-container">
                    <div class="p-3 border rounded h-100 resume-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <h5 class="text-truncate resume-title"><?=@$resume['resume_title']?></h5>
                            <span class="badge bg-light text-dark"><?=date('M Y', $resume['updated_at'])?></span>
                        </div>
                        <p class="small text-secondary m-0 mt-1">
                            <i class="bi bi-clock-history me-1"></i>
                            Last updated <?=date('d F, Y', $resume['updated_at'])?>
                        </p>
                        
                        <div class="resume-actions mt-3 pt-2 border-top">
                            <a href="resume.php?resume=<?=$resume['slug']?>" target="_blank" 
                               class="btn btn-outline-primary btn-sm action-btn" 
                               data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            <a href="updateresume.php?resume=<?=$resume['slug']?>" 
                               class="btn btn-outline-success btn-sm action-btn"
                               data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="actions/deleteresume.action.php?id=<?=$resume['id']?>" 
                               class="btn btn-outline-danger btn-sm action-btn confirm-delete"
                               data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                <i class="bi bi-trash2"></i>
                            </a>
                            <a href="#" class="btn btn-outline-info btn-sm action-btn"
                               data-bs-toggle="tooltip" data-bs-placement="top" title="Share">
                                <i class="bi bi-share"></i>
                            </a>
                            <a href="#" class="btn btn-outline-secondary btn-sm action-btn"
                               data-bs-toggle="tooltip" data-bs-placement="top" title="Clone">
                                <i class="bi bi-copy"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <div class="text-center py-5 border rounded mt-3 empty-state animate__animated animate__fadeIn" 
                 style="background-color: rgba(236, 236, 236, 0.56);">
                <div class="mb-3">
                    <i class="bi bi-file-text display-4 text-muted"></i>
                </div>
                <h5 class="text-muted">No Resumes Found</h5>
                <p class="text-muted">Get started by creating your first resume</p>
                <a href="createresume.php" class="btn btn-primary mt-2">
                    <i class="bi bi-file-earmark-plus me-1"></i>Create Resume
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
    
    <style>
        /* Custom CSS for enhanced styling */
        .resume-card {
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            background: linear-gradient(to bottom, #ffffff, #f9f9f9);
            position: relative;
            overflow: hidden;
        }
        
        .resume-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            border-color: #0d6efd !important;
        }
        
        .resume-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 0;
            background: #0d6efd;
            transition: height 0.3s ease;
        }
        
        .resume-card:hover::before {
            height: 100%;
        }
        
        .resume-title {
            font-weight: 600;
            color: #333;
            max-width: 80%;
        }
        
        .resume-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        
        .action-btn {
            transition: all 0.2s ease;
            border-radius: 50% !important;
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }
        
        .action-btn:hover {
            transform: scale(1.1);
        }
        
        .empty-state {
            transition: all 0.3s ease;
        }
        
        .empty-state:hover {
            transform: scale(1.01);
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        /* Animation for cards when scrolling */
        .resume-card-container {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease;
        }
        
        .resume-card-container.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        @media (max-width: 768px) {
            .resume-card {
                padding: 1rem !important;
            }
            
            .resume-title {
                font-size: 1rem;
            }
        }
    </style>
    
    <script>
        // Intersection Observer for scroll animations
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            // Delete confirmation
            document.querySelectorAll('.confirm-delete').forEach(link => {
                link.addEventListener('click', function(e) {
                    if(!confirm('Are you sure you want to delete this resume?')) {
                        e.preventDefault();
                    }
                });
            });
            
            // Scroll animation for cards
            const resumeCards = document.querySelectorAll('.resume-card-container');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, { threshold: 0.1 });
            
            resumeCards.forEach(card => {
                observer.observe(card);
            });
        });
    </script>
<?php
    require './assets/include/footer.php';
?>