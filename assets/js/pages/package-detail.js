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

function displayPackageDetails(pkg) {
  // Hide loading, show content
  document.getElementById('loading').classList.add('hidden');
  document.getElementById('package-content').classList.remove('hidden');

  // Hero Image (Using safe getImageUrl)
  document.getElementById('hero-image').src = API.getImageUrl(pkg.image_url);
  document.getElementById('hero-image').alt = pkg.name;

  // Title and Category Loop
  document.getElementById('package-title').textContent = pkg.name;
  
  const primaryCat = (pkg.categories && pkg.categories.length > 0) ? pkg.categories[0].name : (pkg.category ? pkg.category.name : 'Tour');
  document.getElementById('package-category').textContent = primaryCat;
  document.getElementById('package-days').textContent = `${pkg.duration_days} Days / ${pkg.duration_days - 1 > 0 ? pkg.duration_days - 1 : 0} Nights`;

  // Quick Info
  document.getElementById('price-info').textContent = `$${pkg.price ? parseFloat(pkg.price).toLocaleString('en-US') : 'Contact'}`;
  document.getElementById('duration-info').textContent = `${pkg.duration_days} Days`;
  document.getElementById('type-info').textContent = pkg.tour_type || 'Adventure';
  document.getElementById('best-for-info').textContent = (pkg.max_persons ? `Up to ${pkg.max_persons} Pax` : 'All Group Sizes');

  // Description (Using innerHTML because TinyMCE saves as HTML)
  document.getElementById('long-description').innerHTML = pkg.description || '';

  // Insightful Tips
  if (pkg.insightful_tips) {
      document.getElementById('tips-section').classList.remove('hidden');
      document.getElementById('insightful-tips-content').innerHTML = pkg.insightful_tips;
  }

  // Journey Highlights
  if (pkg.journey_highlights) {
      document.getElementById('highlights-section').classList.remove('hidden');
      document.getElementById('journey-highlights-content').innerHTML = pkg.journey_highlights;
  }

  // FAQ
  if (pkg.faq_content) {
      document.getElementById('faq-section').classList.remove('hidden');
      document.getElementById('faq-content').innerHTML = pkg.faq_content;
  }

  // Map Embed
  if (pkg.map_embed_code) {
      document.getElementById('map-section').classList.remove('hidden');
      const mapContainer = document.getElementById('map-container');
      mapContainer.innerHTML = pkg.map_embed_code;
      // Force iframe to fit container
      const iframe = mapContainer.querySelector('iframe');
      if(iframe) {
          iframe.style.width = '100%';
          iframe.style.height = '100%';
          iframe.style.border = 'none';
      }
  }

  // Dynamic Itineraries DOM Constructor
  if (pkg.itineraries && pkg.itineraries.length > 0) {
      document.getElementById('itinerary-section').classList.remove('hidden');
      const itinList = document.getElementById('itinerary-list');
      
      itinList.innerHTML = pkg.itineraries.map((day, index) => {
          const isLeft = index % 2 === 0;
          const imageHtml = day.image_url ? 
              `<div class="mt-4 rounded-xl overflow-hidden shadow-md h-48 md:h-64"><img src="${API.getImageUrl(day.image_url)}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700" alt="Day ${day.day_number}"></div>` : '';
              
          return `
          <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
              <!-- Timeline icon -->
              <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-surface bg-primary shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10 transition-transform duration-300 group-hover:scale-110">
                  <span class="text-white font-bold text-sm">${day.day_number}</span>
              </div>
              
              <!-- Content block -->
              <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] p-5 md:p-6 rounded-2xl bg-white shadow-lg border border-outline-variant/10 hover:shadow-xl transition-shadow duration-300">
                  <div class="flex items-center mb-3">
                      <span class="bg-secondary/10 text-secondary text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">Day ${day.day_number}</span>
                  </div>
                  <h3 class="font-headline font-bold text-xl md:text-2xl text-on-surface mb-3">${day.title}</h3>
                  <div class="prose prose-sm md:prose-base max-w-none text-on-surface-variant leading-relaxed">
                      ${day.description || ''}
                  </div>
                  ${imageHtml}
              </div>
          </div>
          `;
      }).join('');
  }

  // Update page title natively and append SEO bindings if they act as standard headers
  document.title = pkg.seo_title || `${pkg.name} | Ocean Lilly Tours`;
  if(pkg.seo_description) {
      const metaDesc = document.querySelector('meta[name="description"]');
      if(metaDesc) metaDesc.setAttribute("content", pkg.seo_description);
  }
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
