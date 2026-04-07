/* ========================================
   CAROUSEL - Hero Slider with Swiper.js
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

    console.log('✓ Hero carousel initialized');
    return heroSwiper;
}
