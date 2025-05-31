<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | ResumeCraft</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Clean and Professional Styling */
        body {  
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
        }

        .glass-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            display: flex;
            align-items: center;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            color: #2c3e50;
        }

        .logo i {
            margin-right: 0.5rem;
            color: #3498db;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        .nav-link {
            text-decoration: none;
            color: #2c3e50;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #3498db;
        }

        .about-container {
            max-width: 1200px;
            margin: 3rem auto;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .about-container h1, .about-container h2 {
            font-family: 'Montserrat', sans-serif;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 2rem;
        }

        .about-container h1 {
            font-size: 2.5rem;
        }

        .about-container h2 {
            font-size: 2rem;
            margin-top: 3rem;
        }

        .about-container p {
            font-size: 1.1rem;
            color: #555;
            margin-bottom: 1.5rem;
            line-height: 1.8;
        }

        .highlight {
            color: #3498db;
            font-weight: 600;
        }

        .team-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .team-member {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .team-member:hover {
            transform: translateY(-5px);
        }

        .team-member h3 {
            color: #2c3e50;
            margin-bottom: 0.5rem;
            font-size: 1.3rem;
        }

        .team-member .role {
            color: #3498db;
            font-weight: 500;
            margin-bottom: 1rem;
            display: block;
        }

        .team-member ul {
            list-style-type: disc;
            padding-left: 1.2rem;
            color: #555;
        }

        .team-member li {
            margin-bottom: 0.5rem;
        }

        footer {
            background: #2c3e50;
            color: #fff;
            padding: 3rem 1rem;
            text-align: center;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
        }

        .footer-logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #3498db;
            display: flex;
            align-items: center;
        }

        .footer-logo i {
            margin-right: 0.5rem;
        }

        .footer-links {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .footer-links a {
            color: #ecf0f1;
            text-decoration: none;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: #3498db;
        }

        .social-links {
            display: flex;
            gap: 1.5rem;
        }

        .social-links a {
            color: #ecf0f1;
            font-size: 1.3rem;
            transition: color 0.3s ease;
        }

        .social-links a:hover {
            color: #3498db;
        }

        .copyright {
            margin-top: 1.5rem;
            color: #bdc3c7;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .about-container {
                padding: 1.5rem;
            }
            
            .about-container h1 {
                font-size: 2rem;
            }
            
            .about-container h2 {
                font-size: 1.7rem;
            }
            
            .nav-links {
                gap: 1rem;
            }
            
            .footer-links {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="glass-nav">
        <div class="logo">
            <i class="fas fa-file-alt"></i>
            <span>ResumeCraft</span>
        </div>
        <ul class="nav-links">
            <li><a href="index.php" class="nav-link">Home</a></li>
            <li><a href="about.php" class="nav-link">About Us</a></li>
            <li><a href="index.php" class="nav-link">Contact</a></li>
        </ul>
    </nav>

    <!-- About Us Section -->
    <section class="about-us">
        <div class="about-container">
            <h1>About <span class="highlight">ResumeCraft</span></h1>
            <p>ResumeCraft is your one-stop solution for creating professional, visually appealing resumes that help you stand out in the job market. Our platform is designed to make resume building simple, efficient, and accessible to everyone.</p>
            <p>With features like customizable templates, multiple export options, and an easy-to-use interface, ResumeCraft empowers job seekers to showcase their skills and experience in the best possible way.</p>
            <p>Whether you're a recent graduate or an experienced professional, ResumeCraft is here to support you every step of the way. Our goal is to help you land your dream job with a resume that truly represents your potential.</p>
            
            <h2>Our <span class="highlight">Team</span></h2>
            <p>ResumeCraft was created by a dedicated team of developers, each contributing their unique skills to build this comprehensive resume builder.</p>
            
            <div class="team-section">
                <div class="team-member">
                    <h3>Ashish</h3>
                    <span class="role">Backend Developer</span>
                    <ul>
                        <li>Developed the PHP backend system</li>
                        <li>Implemented database management</li>
                        <li>Created CRUD operations (Create, Read, Update, Delete)</li>
                        <li>Designed data access layers</li>
                        <li>Contributed to HTML/CSS structure</li>
                    </ul>
                </div>
                
                <div class="team-member">
                    <h3>Yuvraj</h3>
                    <span class="role">Backend Developer</span>
                    <ul>
                        <li>Built user registration system</li>
                        <li>Implemented secure login functionality</li>
                        <li>Developed resume management backend</li>
                        <li>Created resume CRUD operations</li>
                        <li>Ensured data security and validation</li>
                    </ul>
                </div>
                
                <div class="team-member">
                    <h3>Satyam</h3>
                    <span class="role">Frontend Developer</span>
                    <ul>
                        <li>Implemented resume editing features</li>
                        <li>Added delete functionality</li>
                        <li>Developed print and download options</li>
                        <li>Created image upload capability</li>
                        <li>Implemented dark mode toggle</li>
                    </ul>
                </div>
                
                <div class="team-member">
                    <h3>Nilanshu</h3>
                    <span class="role">Frontend Developer</span>
                    <ul>
                        <li>Designed and implemented the navigation system</li>
                        <li>Implemented the glassmorphism design elements</li>
                        <li>Created animated background effects</li>
                        <li>Developed the user interface components</li>
                        <li>Designed the hero section and feature cards</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-logo">
                <i class="fas fa-file-alt"></i> ResumeCraft
            </div>
            <div class="footer-links">
                <a href="index.php">Home</a>
                <a href="about.php">About Us</a>
                <a href="#contact">Contact</a>
                <a href="#">Privacy Policy</a>
            </div>
            <div class="social-links">
                <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                <a href="https://x.com/?lang=en-in"><i class="fab fa-twitter"></i></a>
                <a href="https://www.linkedin.com/login"><i class="fab fa-linkedin-in"></i></a>
                <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
            </div>
            <p class="copyright">&copy; 2025 ResumeCraft. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>