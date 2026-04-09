/**
 * Ocean Lilly Tours - Package Detail Page JavaScript
 * =================================================
 * Extracts package ID from URL and displays full package details
 * Fixes the broken package system - NOW shows correct package per ID
 * Date: April 9, 2026
 */

/**
 * Get URL parameter value
 * @param {string} paramName - Parameter name
 * @returns {string|null} Parameter value or null
 */
function getUrlParameter(paramName) {
  const urlParams = new URLSearchParams(window.location.search);
  return urlParams.get(paramName);
}

/**
 * Load and display package details
 * Called when page loads
 */
async function loadPackageDetails() {
  try {
    // Extract package ID from URL
    const packageId = getUrlParameter('id');

    if (!packageId) {
      console.error('❌ No package ID provided in URL');
      showError();
      return;
    }

    console.log(`📦 Loading package ${packageId}...`);

    // Fetch specific package from API
    const pkg = await API.getPackage(packageId);

    if (!pkg || !pkg.id) {
      console.error('❌ Package not found');
      showError();
      return;
    }

    // Populate page with package data
    displayPackageDetails(pkg);
    console.log(`✅ Package ${packageId} loaded successfully`);

  } catch (err) {
    console.error('❌ Error loading package:', err);
    showError();
  }
}

/**
 * Display package details on page
 * @param {Object} pkg - Package object from API
 */
function displayPackageDetails(pkg) {
  // Hide loading, show content
  document.getElementById('loading').classList.add('hidden');
  document.getElementById('package-content').classList.remove('hidden');

  // Hero Image
  document.getElementById('hero-image').src = pkg.featured_image || 'assets/uploads/placeholder.jpg';
  document.getElementById('hero-image').alt = pkg.name;

  // Title and Category
  document.getElementById('package-title').textContent = pkg.name;
  document.getElementById('package-category').textContent = pkg.category_label || pkg.tag || 'Package';
  document.getElementById('package-days').textContent = `${pkg.duration_days} Days`;

  // Quick Info
  document.getElementById('price-info').textContent = `$${pkg.price ? pkg.price.toLocaleString() : 'Contact'}`;
  document.getElementById('duration-info').textContent = `${pkg.duration_days} Days`;
  document.getElementById('type-info').textContent = pkg.tour_type || 'Tour';
  document.getElementById('best-for-info').textContent = pkg.best_for || 'All';

  // Description
  document.getElementById('long-description').textContent = pkg.long_description || pkg.description;

  // Inclusions
  if (pkg.includes && pkg.includes.length > 0) {
    const inclusionsList = document.getElementById('inclusions-list');
    inclusionsList.innerHTML = pkg.includes.map(inclusion => `
      <li class="flex items-start gap-3 p-4 md:p-5 bg-surface-container-low rounded-lg hover:shadow-md transition-all">
        <span class="material-symbols-outlined text-primary flex-shrink-0 mt-1">check_circle</span>
        <span class="text-on-surface font-medium text-sm md:text-base">${inclusion}</span>
      </li>
    `).join('');
  }

  // Destinations
  if (pkg.destinations && pkg.destinations.length > 0) {
    const destinationsList = document.getElementById('destinations-list');
    destinationsList.innerHTML = pkg.destinations.map(destination => `
      <div class="flex items-center gap-2 px-4 py-2.5 bg-secondary-container rounded-full">
        <span class="material-symbols-outlined text-secondary text-sm">location_on</span>
        <span class="text-secondary font-semibold text-sm">${destination}</span>
      </div>
    `).join('');
  }

  // Update page title
  document.title = `${pkg.name} | Ocean Lilly Tours`;
}

/**
 * Show error message
 */
function showError() {
  document.getElementById('loading').classList.add('hidden');
  document.getElementById('error-message').classList.remove('hidden');
}

/**
 * Initialize page when DOM is ready
 */
document.addEventListener('DOMContentLoaded', loadPackageDetails);
