/**
 * Ocean Lilly Tours - Standalone Navigation Initializer
 * ======================================================
 * This is a plain (non-module) script that handles the
 * mobile hamburger menu on all sub-pages (blog, gallery,
 * packages, etc.).  It does NOT use import/export so it
 * can be loaded with a normal <script> tag.
 */

(function () {
    function initNavigation() {
        var hamburgerBtn  = document.getElementById('hamburgerBtn');
        var hamburgerIcon = document.getElementById('hamburgerIcon');
        var mobileMenu    = document.getElementById('mobileMenu');
        var menuOverlay   = document.getElementById('menuOverlay');
        var mobileLinks   = document.querySelectorAll('.mobile-nav-link');

        if (!hamburgerBtn || !mobileMenu) return;

        function toggleMobileMenu() {
            if (hamburgerIcon) hamburgerIcon.classList.toggle('active');
            mobileMenu.classList.toggle('active');
            if (menuOverlay) menuOverlay.classList.toggle('active');
            document.body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
        }

        hamburgerBtn.addEventListener('click', toggleMobileMenu);
        if (menuOverlay) menuOverlay.addEventListener('click', toggleMobileMenu);

        mobileLinks.forEach(function (link) {
            link.addEventListener('click', toggleMobileMenu);
        });

        // Scroll-based nav transparency
        var nav = document.querySelector('nav');
        if (nav) {
            window.addEventListener('scroll', function () {
                if (window.scrollY > 50) {
                    nav.classList.remove('bg-black/40');
                    nav.classList.add('bg-black/80');
                } else {
                    nav.classList.remove('bg-black/80');
                    nav.classList.add('bg-black/40');
                }
            });
        }

        console.log('✓ Navigation initialized (standalone)');
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initNavigation);
    } else {
        initNavigation();
    }
})();
