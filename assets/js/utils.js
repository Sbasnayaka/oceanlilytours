/* ========================================
   UTILITIES - Helper Functions
   ======================================== */

/**
 * Toggle visibility of an element with optional callback
 * @param {HTMLElement} element - Element to toggle
 * @param {Function} callback - Optional callback after toggle
 */
export function toggleElement(element, callback) {
    if (element) {
        element.classList.toggle('active');
        if (callback) callback();
    }
}

/**
 * Add 'active' class to element
 * @param {HTMLElement} element - Element to activate
 */
export function activate(element) {
    if (element) element.classList.add('active');
}

/**
 * Remove 'active' class from element
 * @param {HTMLElement} element - Element to deactivate
 */
export function deactivate(element) {
    if (element) element.classList.remove('active');
}

/**
 * Check if element has 'active' class
 * @param {HTMLElement} element - Element to check
 * @returns {Boolean}
 */
export function isActive(element) {
    return element ? element.classList.contains('active') : false;
}

/**
 * Prevent body scroll (for modals, menus)
 * @param {Boolean} prevent - True to prevent, false to allow
 */
export function preventBodyScroll(prevent) {
    document.body.style.overflow = prevent ? 'hidden' : '';
}
