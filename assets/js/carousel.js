/* ========================================
   CAROUSEL - Hero Slider with Swiper.js & Reviews Slider
   ======================================== */

/**
 * Initialize hero carousel using Swiper
 * Note: Swiper library must be loaded before this script
 */
export function initCarousel() {
    // Check if Swiper is available
    if (typeof Swiper === 'undefined') {
        console.warn('⚠ Swiper library not found. Hero carousel not initialized.');
        return;
    }

    const heroSwiper = new Swiper('.heroSwiper', {
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
        effect: 'slide',
        speed: 800
    });

        // Testimonials Swiper
    const testimonialsSwiper = new Swiper('.testimonialsSwiper', {
        slidesPerView: 1.5,
        spaceBetween: 24,
        loop: true,
        navigation: {
            nextEl: '.testimonials-next',
            prevEl: '.testimonials-prev',
        },
        pagination: {
            el: '.testimonials-pagination',
            clickable: true,
        },
        breakpoints: {
            768: { // tablet
                slidesPerView: 2.5,
                spaceBetween: 24,
            },
            1024: { // desktop
                slidesPerView: 3.5,
                spaceBetween: 24,
            }
        }
    });

    console.log('✓ Hero carousel initialized');
    initReviewsCarousel();
    return heroSwiper;
}

/**
 * Initialize reviews slide carousel with button navigation
 * Supports smooth sliding between reviews with next/previous buttons
 */
export function initReviewsCarousel() {
    const container = document.getElementById('reviewsCarousel');
    const carousel = document.getElementById('reviewsSlider');
    const prevBtn = document.getElementById('reviewsPrev');
    const nextBtn = document.getElementById('reviewsNext');
    
    // Exit safely if elements don't exist
    if (!container || !carousel || !prevBtn || !nextBtn) {
        console.warn('⚠ Reviews carousel elements not found.');
        return;
    }

    let currentSlide = 0;
    const reviewCards = carousel.querySelectorAll('.review-card');
    const totalReviews = reviewCards.length;
    const cardsToShow = window.innerWidth < 640 ? 3.5 : window.innerWidth < 1024 ? 3.5 : 3;
    const cardWidth = window.innerWidth < 640 ? 320 : window.innerWidth < 1024 ? 340 : 360;
    const gap = window.innerWidth < 640 ? 8 : window.innerWidth < 1024 ? 16 : 24;
    const slideSteps = Math.max(1, Math.ceil((totalReviews - cardsToShow) / 1));

    /**
     * Update carousel position
     */
    function updateCarousel() {
        const offset = currentSlide > 0 ? 8 + (currentSlide * (cardWidth + gap)) : 0; // Account for initial spacer
        carousel.style.transform = `translateX(-${offset}px)`;
        carousel.style.transition = 'transform 0.5s ease-in-out';
        console.log(`🔄 Review slide: ${currentSlide + 1}/${slideSteps + 1}`);
    }

    /**
     * Handle next slide
     */
    function goNext() {
        if (currentSlide < slideSteps) {
            currentSlide++;
            updateCarousel();
        }
    }

    /**
     * Handle previous slide
     */
    function goPrev() {
        if (currentSlide > 0) {
            currentSlide--;
            updateCarousel();
        }
    }

    // Event listeners for navigation buttons
    nextBtn.addEventListener('click', goNext);
    prevBtn.addEventListener('click', goPrev);

    console.log('✓ Reviews carousel initialized with ' + totalReviews + ' reviews');
}
