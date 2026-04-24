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
    window.heroSwiper = heroSwiper;

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
            768: { slidesPerView: 2.5, spaceBetween: 24 },
            1024: { slidesPerView: 3.5, spaceBetween: 24 }
        }
    });
    window.testimonialsSwiper = testimonialsSwiper;

    console.log('✓ Hero & Testimonials carousels initialized');
    return { heroSwiper, testimonialsSwiper };
}

