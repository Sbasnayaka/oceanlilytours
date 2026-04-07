/* ========================================
   MAIN - Application Entry Point
   ======================================== */

import { initNavigation } from './navigation.js';
import { initCarousel } from './carousel.js';

/**
 * Application initialization
 * Runs when DOM is fully loaded
 */
function initApp() {
    console.log('🚀 Ocean Lilly Tours - Initializing...');

    try {
        // Initialize features
        initNavigation();
        initCarousel();

        console.log('✅ Application initialized successfully');
    } catch (error) {
        console.error('❌ Error during initialization:', error);
    }
}

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initApp);
} else {
    // DOM already loaded
    initApp();
}
