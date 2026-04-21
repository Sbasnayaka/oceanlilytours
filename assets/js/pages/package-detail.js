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

  // Hero Image (Our API saves this to pkg.image_url)
  document.getElementById('hero-image').src = pkg.image_url || '../assets/uploads/placeholder.jpg';
  document.getElementById('hero-image').alt = pkg.name;

  // Title and Category mapping gracefully from Pivot Array or direct BelongsTo
  const primaryCat = (pkg.categories && pkg.categories.length > 0) ? pkg.categories[0] : (pkg.category || {name: 'Tour'});
  document.getElementById('package-title').textContent = pkg.name;
  document.getElementById('package-category').textContent = primaryCat.name;
  document.getElementById('package-days').textContent = `${pkg.duration_days} Days`;

  // Quick Info
  const priceStr = parseFloat(pkg.price).toLocaleString('en-US');
  document.getElementById('price-info').textContent = `$${priceStr}`;
  document.getElementById('duration-info').textContent = `${pkg.duration_days} Days`;
  document.getElementById('type-info').textContent = pkg.tour_type || 'Tour';
  document.getElementById('best-for-info').textContent = `${pkg.max_persons || 10} Pax`;

  // Description (Requires innerHTML since TinyMCE outputs rich html)
  document.getElementById('long-description').innerHTML = pkg.description || 'No description available.';

  // Inclusions / Journey Highlights (TinyMCE Rich Text)
  const inclusionsList = document.getElementById('inclusions-list');
  // Since Journey Highlights is HTML from TinyMCE, we render it directly rather than loop.
  // We apply CSS reset classes to make the rich text look normal
  if (pkg.journey_highlights) {
    inclusionsList.classList.remove('grid', 'grid-cols-1', 'md:grid-cols-2', 'gap-4', 'md:gap-6');
    inclusionsList.innerHTML = `<div class="prose prose-sm md:prose-base max-w-none text-on-surface-variant">${pkg.journey_highlights}</div>`;
  } else {
    inclusionsList.innerHTML = `<p class="text-on-surface-variant">Standard inclusions apply. Contact us for details.</p>`;
  }

  // Destinations / Day-by-Day Itineraries Arrays
  const destinationsList = document.getElementById('destinations-list');
  if (pkg.itineraries && pkg.itineraries.length > 0) {
    // Reformat container to handle beautiful day blocks instead of small pills
    destinationsList.classList.remove('flex', 'flex-wrap', 'gap-3');
    destinationsList.classList.add('space-y-6', 'w-full');
    
    destinationsList.innerHTML = pkg.itineraries.map(itin => `
      <div class="bg-surface-container-low p-5 md:p-6 rounded-xl border border-outline-variant/30 flex flex-col md:flex-row gap-6">
        ${itin.image_url ? `<img src="${itin.image_url}" class="w-full md:w-1/3 h-48 object-cover rounded-lg shadow-sm" alt="Day image">` : ''}
        <div class="flex-1">
          <div class="flex items-center gap-3 mb-3">
            <span class="bg-primary text-on-primary font-bold px-3 py-1 rounded-lg text-sm">Day ${itin.day_number}</span>
            <h3 class="text-xl font-bold font-headline text-on-surface">${itin.title}</h3>
          </div>
          <div class="prose prose-sm max-w-none text-on-surface-variant">
            ${itin.description || 'Enjoy this beautiful destination.'}
          </div>
        </div>
      </div>
    `).join('');
  } else {
    destinationsList.innerHTML = `<p class="text-on-surface-variant">Detailed itinerary available upon request.</p>`;
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
