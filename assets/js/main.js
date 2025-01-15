document.addEventListener('DOMContentLoaded', function(){

    // BURGER MENU
    const mobileMenuButton = document.querySelector('.mobile-menu-button');
    const mobileMenu = document.querySelector('.mobile-menu');

    if(mobileMenuButton){
    mobileMenuButton.addEventListener('click', function() {
        mobileMenu.classList.toggle('hidden');
        if (!mobileMenu.classList.contains('hidden')) {
            mobileMenu.style.opacity = '0';
            setTimeout(() => {
                mobileMenu.style.opacity = '1';
            }, 100);
        }
    });
    }

    // Testimonials Carousel
    const initTestimonialsCarousel = () => {
        const track = document.querySelector('.testimonials-track');
        const slides = document.querySelectorAll('.testimonial-card');
        const nextButton = document.querySelector('.testimonial-next');
        const prevButton = document.querySelector('.testimonial-prev');
        const dotsContainer = document.querySelector('.testimonial-dots');

        let currentIndex = 0;
        let slidesPerView = window.innerWidth >= 768 ? 3 : 1;
        const totalSlides = slides.length;

        // Create dots
        for (let i = 0; i < Math.ceil(totalSlides / slidesPerView); i++) {
            const dot = document.createElement('button');
            dot.classList.add('w-3', 'h-3', 'rounded-full', 'bg-gray-300', 'hover:bg-blue-600', 'transition-colors');
            dot.addEventListener('click', () => goToSlide(i * slidesPerView));
            dotsContainer.appendChild(dot);
        }

        const updateDots = () => {
            const dots = dotsContainer.querySelectorAll('button');
            dots.forEach((dot, index) => {
                if (index === Math.floor(currentIndex / slidesPerView)) {
                    dot.classList.remove('bg-gray-300');
                    dot.classList.add('bg-blue-600');
                } else {
                    dot.classList.add('bg-gray-300');
                    dot.classList.remove('bg-blue-600');
                }
            });
        };

        const updateSlideWidth = () => {
            slidesPerView = window.innerWidth >= 768 ? 3 : 1;
            slides.forEach(slide => {
                slide.style.width = `${100 / slidesPerView}%`;
            });
            goToSlide(currentIndex);
        };

        const goToSlide = (index) => {
            const maxIndex = totalSlides - slidesPerView;
            currentIndex = Math.max(0, Math.min(index, maxIndex));
            const offset = -(currentIndex * (100 / slidesPerView));
            track.style.transform = `translateX(${offset}%)`;
            updateDots();
        };

        // Add touch support
        let touchStartX = 0;
        let touchEndX = 0;

        track.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        });

        track.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        const handleSwipe = () => {
            const swipeThreshold = 50;
            const diff = touchStartX - touchEndX;

            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    // Swipe left
                    goToSlide(currentIndex + 1);
                } else {
                    // Swipe right
                    goToSlide(currentIndex - 1);
                }
            }
        };

        // Event listeners
        nextButton.addEventListener('click', () => {
            goToSlide(currentIndex + 1);
        });

        prevButton.addEventListener('click', () => {
            goToSlide(currentIndex - 1);
        });

        window.addEventListener('resize', updateSlideWidth);

        // Auto-play functionality
        let autoplayInterval;
        const startAutoplay = () => {
            autoplayInterval = setInterval(() => {
                goToSlide((currentIndex + 1) % totalSlides);
            }, 5000);
        };

        const stopAutoplay = () => {
            clearInterval(autoplayInterval);
        };

        // Start/stop autoplay on hover
        track.addEventListener('mouseenter', stopAutoplay);
        track.addEventListener('mouseleave', startAutoplay);

        // Initialize
        updateSlideWidth();
        startAutoplay();
    };

    // Initialize carousel when DOM is loaded
    if (document.querySelector('.testimonials-carousel')) {
        initTestimonialsCarousel();
    }

    // Registration Form Handling
    const registerForm = document.getElementById('registerForm');

    if (registerForm) {
        registerForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const firstName = document.getElementById('firstName').value.trim();
            const lastName = document.getElementById('lastName').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();
            const termsAccepted = document.getElementById('terms')?.checked;

            let isValid = true;
            let errorMessage = '';

            // Validation checks
            if (!firstName || !lastName || !email || !password) {
                errorMessage += 'Veuillez remplir tous les champs.\n';
                isValid = false;
            }

            // Validate first name and last name
            const nameRegex = /^[a-zA-Z- ]{2,}$/;
            if (!nameRegex.test(firstName) || !nameRegex.test(lastName)) {
                errorMessage += 'Veuillez entrer un prénom et un nom valide.\n';
                isValid = false;
            }

            if (!termsAccepted) {
                errorMessage += 'Vous devez accepter les conditions d\'utilisation.\n';
                isValid = false;
            }

            // Validate email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                errorMessage += 'Veuillez entrer une adresse email valide.\n';
                isValid = false;
            }

            // Validate password
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            if (!passwordRegex.test(password)) {
                errorMessage += 'Le mot de passe doit contenir au moins 8 caractères, une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.\n';
                isValid = false;
            }

            if (isValid) {
                registerForm.submit();
            } else {
                alert(errorMessage);
            }
        });
    }


});