document.addEventListener('DOMContentLoaded', function() {
    // Mobile Navigation
    const burger = document.querySelector('.burger');
    const navLinks = document.querySelector('.nav-links');
    const navLinkItems = document.querySelectorAll('.nav-link');
    
    burger.addEventListener('click', () => {
        navLinks.classList.toggle('active');
        burger.classList.toggle('toggle');
    });
    
    navLinkItems.forEach(link => {
        link.addEventListener('click', () => {
            navLinks.classList.remove('active');
            burger.classList.remove('toggle');
        });
    });
    
    // Smooth Scrolling for Navigation Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            window.scrollTo({
                top: targetElement.offsetTop - 80,
                behavior: 'smooth'
            });
        });
    });
    
    // Navbar Scroll Effect
    window.addEventListener('scroll', () => {
        const nav = document.querySelector('.glass-nav');
        nav.classList.toggle('scrolled', window.scrollY > 50);
    });
    
    // Back to Top Button
    const backToTopBtn = document.querySelector('.back-to-top');
    
    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            backToTopBtn.classList.add('active');
        } else {
            backToTopBtn.classList.remove('active');
        }
    });
    
    backToTopBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    // Template Carousel Navigation
    const carousel = document.querySelector('.template-carousel');
    const prevBtn = document.querySelector('.carousel-btn.prev');
    const nextBtn = document.querySelector('.carousel-btn.next');
    
    if (carousel && prevBtn && nextBtn) {
        prevBtn.addEventListener('click', () => {
            carousel.scrollBy({
                left: -300,
                behavior: 'smooth'
            });
        });
        
        nextBtn.addEventListener('click', () => {
            carousel.scrollBy({
                left: 300,
                behavior: 'smooth'
            });
        });
    }
    
    // Form Validation
    const contactForm = document.querySelector('.contact-form form');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            let isValid = true;
            const inputs = this.querySelectorAll('input, textarea');
            
            // Clear previous errors
            document.querySelectorAll('.error-message').forEach(el => {
                el.style.display = 'none';
            });
            
            inputs.forEach(input => {
                input.classList.remove('error');
                
                if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add('error');
                    const errorMsg = document.createElement('div');
                    errorMsg.className = 'error-message';
                    errorMsg.textContent = 'This field is required';
                    input.parentNode.appendChild(errorMsg);
                    errorMsg.style.display = 'block';
                }
            });
            
            if (isValid) {
                // Simulate form submission
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.textContent;
                submitBtn.innerHTML = '<div class="loader"></div>';
                submitBtn.disabled = true;
                
                setTimeout(() => {
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                    
                    // Show success message
                    const successMsg = document.createElement('div');
                    successMsg.className = 'success-message';
                    successMsg.textContent = 'Thank you! Your message has been sent successfully.';
                    this.insertBefore(successMsg, this.firstChild);
                    successMsg.style.display = 'block';
                    
                    // Reset form
                    setTimeout(() => {
                        this.reset();
                        successMsg.style.display = 'none';
                    }, 3000);
                }, 1500);
            }
        });
    }
    
    // Animate Elements on Scroll
    const animateOnScroll = () => {
        const elements = document.querySelectorAll('.feature-card, .testimonial-card, .template-card, .video-wrapper, .contact-form');
        
        elements.forEach(element => {
            const elementPosition = element.getBoundingClientRect().top;
            const screenPosition = window.innerHeight / 1.2;
            
            if (elementPosition < screenPosition) {
                element.classList.add('fade-in');
            }
        });
    };
    
    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll(); // Run once on load
    
    // Ripple Effect for Buttons
    const buttons = document.querySelectorAll('.btn');
    
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            const x = e.clientX - e.target.getBoundingClientRect().left;
            const y = e.clientY - e.target.getBoundingClientRect().top;
            
            const ripple = document.createElement('span');
            ripple.classList.add('ripple');
            ripple.style.left = `${x}px`;
            ripple.style.top = `${y}px`;
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 1000);
        });
    });
    
    // Dark Mode Toggle
    const darkModeToggle = document.createElement('button');
    darkModeToggle.className = 'dark-mode-toggle';
    darkModeToggle.innerHTML = '<i class="fas fa-moon"></i>';
    document.body.appendChild(darkModeToggle);
    
    darkModeToggle.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
        
        if (document.body.classList.contains('dark-mode')) {
            darkModeToggle.innerHTML = '<i class="fas fa-sun"></i>';
            localStorage.setItem('darkMode', 'enabled');
        } else {
            darkModeToggle.innerHTML = '<i class="fas fa-moon"></i>';
            localStorage.setItem('darkMode', 'disabled');
        }
    });
    
    // Check for saved dark mode preference
    if (localStorage.getItem('darkMode') === 'enabled') {
        document.body.classList.add('dark-mode');
        darkModeToggle.innerHTML = '<i class="fas fa-sun"></i>';
    }
    
    // Confetti Effect for CTA Button
    const ctaBtn = document.querySelector('.btn-primary.pulse');
    
    if (ctaBtn) {
        ctaBtn.addEventListener('click', () => {
            createConfetti();
        });
    }
    
    function createConfetti() {
        const colors = ['#6c63ff', '#ff6584', '#4d44db', '#48c774', '#ffdd57'];
        
        for (let i = 0; i < 100; i++) {
            const confetti = document.createElement('div');
            confetti.className = 'confetti';
            confetti.style.left = Math.random() * window.innerWidth + 'px';
            confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
            confetti.style.width = Math.random() * 10 + 5 + 'px';
            confetti.style.height = confetti.style.width;
            document.body.appendChild(confetti);
            
            setTimeout(() => {
                confetti.remove();
            }, 5000);
        }
    }
    
    // Tooltip Initialization
    const tooltipElements = document.querySelectorAll('.tooltip');
    
    tooltipElements.forEach(el => {
        const tooltipText = el.getAttribute('data-tooltip');
        if (tooltipText) {
            const tooltip = document.createElement('span');
            tooltip.className = 'tooltiptext';
            tooltip.textContent = tooltipText;
            el.appendChild(tooltip);
        }
    });
    
    // Video Modal
    const videoModal = document.createElement('div');
    videoModal.className = 'video-modal';
    videoModal.style.display = 'none';
    videoModal.style.position = 'fixed';
    videoModal.style.top = '0';
    videoModal.style.left = '0';
    videoModal.style.width = '100%';
    videoModal.style.height = '100%';
    videoModal.style.backgroundColor = 'rgba(0,0,0,0.9)';
    videoModal.style.zIndex = '10000';
    videoModal.style.display = 'flex';
    videoModal.style.alignItems = 'center';
    videoModal.style.justifyContent = 'center';
    videoModal.style.opacity = '0';
    videoModal.style.visibility = 'hidden';
    videoModal.style.transition = 'all 0.3s ease';
    
    const videoIframe = document.createElement('iframe');
    videoIframe.width = '80%';
    videoIframe.height = '80%';
    videoIframe.src = '';
    videoIframe.frameBorder = '0';
    videoIframe.allowFullscreen = true;
    
    const closeBtn = document.createElement('button');
    closeBtn.innerHTML = '<i class="fas fa-times"></i>';
    closeBtn.style.position = 'absolute';
    closeBtn.style.top = '20px';
    closeBtn.style.right = '20px';
    closeBtn.style.background = 'none';
    closeBtn.style.border = 'none';
    closeBtn.style.color = 'white';
    closeBtn.style.fontSize = '2rem';
    closeBtn.style.cursor = 'pointer';
    
    videoModal.appendChild(videoIframe);
    videoModal.appendChild(closeBtn);
    document.body.appendChild(videoModal);
    
    closeBtn.addEventListener('click', () => {
        videoModal.style.opacity = '0';
        videoModal.style.visibility = 'hidden';
        videoIframe.src = '';
    });
    
    // Template Preview Buttons
    const previewButtons = document.querySelectorAll('.template-overlay .btn-primary');
        previewButtons.forEach(button => {
        button.addEventListener('click', (e) => {
        e.preventDefault();
        const videoUrl = button.getAttribute('data-video-url');
        if (videoUrl) {
            videoIframe.src = videoUrl;
            videoModal.style.opacity = '1';
            videoModal.style.visibility = 'visible';
        }
    });
});
});