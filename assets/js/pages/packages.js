/**
 * Ocean Lilly Tours - Packages Page JavaScript
 * =============================================
 * Fetches all packages from API and renders them in a grid
 * Uses fallback data files when backend not ready
 * Date: April 9, 2026
 */

/**
 * Render a single package card
 * @param {Object} pkg - Package object from API
 * @returns {string} HTML for package card
 */
function renderPackageCard(pkg) {
  return `
    <div class="group flex flex-col h-full rounded-xl overflow-hidden hover:shadow-luxury transition-all duration-300 border border-outline-variant/10 bg-surface-container-lowest">
      <!-- Package Image -->
      <div class="relative h-56 sm:h-64 md:h-72 rounded-t-xl overflow-hidden">
        <img 
          class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" 
          src="${pkg.image_url || '../assets/uploads/placeholder.jpg'}" 
          alt="${pkg.name}"
        />
        <div class="absolute top-3 left-3 sm:top-4 sm:left-4 bg-primary text-white text-xs font-bold px-3 py-1 rounded-full truncate max-w-xs">
          ${(pkg.categories && pkg.categories.length > 0) ? pkg.categories[0].name : (pkg.category ? pkg.category.name : 'Tour')}
        </div>
        <div class="absolute top-3 right-3 sm:top-4 sm:right-4 bg-on-surface text-surface text-xs font-bold px-3 py-1 rounded-full">
          ${pkg.duration_days} Days
        </div>
      </div>

      <!-- Package Info -->
      <div class="p-4 sm:p-5 md:p-6 flex flex-col flex-grow">
        <!-- Title -->
        <div class="mb-3">
          <h3 class="text-base sm:text-lg md:text-xl font-headline font-bold text-on-surface line-clamp-2 group-hover:text-primary transition-colors">
            ${pkg.name}
          </h3>
        </div>

        <!-- Description -->
        <p class="text-on-surface-variant text-xs sm:text-sm leading-relaxed mb-4 line-clamp-2 flex-grow">
          ${pkg.description}
        </p>

        <!-- Destinations (if available) -->
        ${pkg.destinations && pkg.destinations.length > 0 ? `
          <div class="mb-4 flex flex-wrap gap-2">
            ${pkg.destinations.slice(0, 3).map(dest => `
              <span class="text-xs px-2.5 py-1 rounded-full bg-secondary-container text-secondary font-medium">
                ${dest}
              </span>
            `).join('')}
            ${pkg.destinations.length > 3 ? `<span class="text-xs px-2.5 py-1 text-on-surface-variant">+${pkg.destinations.length - 3} more</span>` : ''}
          </div>
        ` : ''}

        <!-- Pricing and Button -->
        <div class="flex items-center justify-between pt-4 border-t border-outline-variant/20">
          <div>
            <span class="text-xs text-on-surface-variant">Starting from</span>
            <p class="text-lg sm:text-xl font-bold text-primary">$${pkg.price ? pkg.price.toLocaleString() : 'Contact'}</p>
          </div>
          <a href="package-detail.html?id=${pkg.id}" class="px-4 sm:px-5 py-2 sm:py-2.5 rounded-full border-2 border-primary text-primary font-headline font-bold text-xs sm:text-sm hover:bg-primary hover:text-on-primary transition-all duration-300 whitespace-nowrap">
            Details
          </a>
        </div>
      </div>
    </div>
  `;
}

/**
 * Load and render all packages
 * Called when page loads
 */
async function loadPackages() {
  try {
    // Show loading indicator
    document.getElementById('loading').classList.remove('hidden');

    // Get packages from API (with fallback)
    console.log('📦 Loading packages...');
    const packages = await API.getPackages();

    // Hide loading indicator
    document.getElementById('loading').classList.add('hidden');

    if (!packages || packages.length === 0) {
      console.warn('⚠️ No packages found');
      document.getElementById('packages-grid').innerHTML = `
        <div class="col-span-full text-center py-12 md:py-20">
          <div class="text-6xl mb-4">📦</div>
          <h2 class="text-2xl md:text-3xl font-bold text-on-surface mb-3">No Packages Available</h2>
          <p class="text-on-surface-variant mb-6 max-w-md mx-auto">
            Please check back soon for new exciting travel packages.
          </p>
          <a href="../index.html" class="inline-block bg-primary text-on-primary px-6 py-3 rounded-full font-bold hover:bg-primary-container transition-all">
            Back to Home
          </a>
        </div>
      `;
      return;
    }

    // Render packages
    const grid = document.getElementById('packages-grid');
    grid.innerHTML = packages.map(pkg => renderPackageCard(pkg)).join('');

    console.log(`✅ Successfully loaded ${packages.length} packages`);
  } catch (err) {
    console.error('❌ Error loading packages:', err);
    document.getElementById('loading').classList.add('hidden');
    document.getElementById('packages-grid').innerHTML = `
      <div class="col-span-full text-center py-12 md:py-20">
        <div class="text-6xl mb-4">⚠️</div>
        <h2 class="text-2xl md:text-3xl font-bold text-on-surface mb-3">Error Loading Packages</h2>
        <p class="text-on-surface-variant mb-6 max-w-md mx-auto">
          Sorry, we encountered an error while loading the packages. Please try again later.
        </p>
        <button onclick="location.reload()" class="inline-block bg-primary text-on-primary px-6 py-3 rounded-full font-bold hover:bg-primary-container transition-all">
          Retry
        </button>
      </div>
    `;
  }
}

/**
 * Initialize page when DOM is ready
 */
document.addEventListener('DOMContentLoaded', loadPackages);
