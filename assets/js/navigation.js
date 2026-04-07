/* ========================================
   NAVIGATION - Hamburger Menu & Mobile Nav
   ======================================== */

import { toggleElement, preventBodyScroll, isActive } from './utils.js';

/**
 * Initialize mobile menu functionality
 */
export function initNavigation() {
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const hamburgerIcon = document.getElementById('hamburgerIcon');
    const mobileMenu = document.getElementById('mobileMenu');
    const menuOverlay = document.getElementById('menuOverlay');
    const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');

    if (!hamburgerBtn || !mobileMenu) return; // Exit if elements don't exist

    /**
     * Toggle mobile menu on/off
     */
    function toggleMobileMenu() {
        hamburgerIcon.classList.toggle('active');
        mobileMenu.classList.toggle('active');
        menuOverlay.classList.toggle('active');
        preventBodyScroll(isActive(mobileMenu));
    }

    // Event listeners
    hamburgerBtn.addEventListener('click', toggleMobileMenu);
    menuOverlay.addEventListener('click', toggleMobileMenu);

    // Close menu when clicking nav links
    mobileNavLinks.forEach(link => {
        link.addEventListener('click', toggleMobileMenu);
    });

    console.log('✓ Navigation initialized');
}
