/**
 * Ocean Lilly Tours - Package Detail JS
 * Elegant Phase 4 Redesign
 */

function getUrlParameter(paramName) {
  const urlParams = new URLSearchParams(window.location.search);
  return urlParams.get(paramName);
}

async function loadPackageDetails() {
  try {
    const packageId = getUrlParameter('id');
    if (!packageId) return showError();

    const pkg = await API.getPackage(packageId);
    if (!pkg || !pkg.id) return showError();

    displayPackageDetails(pkg);
  } catch (err) {
    console.error('Error loading package:', err);
    showError();
  }
}

function displayPackageDetails(pkg) {
  // Hide loading
  document.getElementById('loading').classList.add('hidden');
  document.getElementById('package-content').classList.remove('hidden');

  // Page Title & Meta (SEO)
  document.title = `${pkg.seo_title || pkg.name} | Ocean Lilly Tours`;
  // Optionally, set meta description manually if you have access to <head> dynamically

  // Hero Section
  document.getElementById('hero-image').src = pkg.image_url || '../assets/uploads/placeholder.jpg';
  document.getElementById('hero-image').alt = pkg.name;
  
  document.getElementById('package-title').textContent = pkg.name;
  
  if (pkg.sub_heading && document.getElementById('package-subheading')) {
      document.getElementById('package-subheading').textContent = pkg.sub_heading;
  }

  const primaryCat = (pkg.categories && pkg.categories.length > 0) ? pkg.categories[0] : (pkg.category || {name: 'Premium Tour'});
  document.getElementById('package-category').textContent = primaryCat.name;
  
  // Quick Info Bar Data
  document.getElementById('package-days').textContent = `${pkg.duration_days} Days`;
  document.getElementById('duration-info').textContent = `${pkg.duration_days} Days`;
  document.getElementById('type-info').textContent = pkg.tour_type || 'Adventure & Relaxation';
  document.getElementById('best-for-info').textContent = `${pkg.max_persons || 10} Persons Max`;
  
  if(document.getElementById('group-info')) {
      document.getElementById('group-info').textContent = `Max ${pkg.max_persons || 10} Pax`;
  }
  
  if(document.getElementById('location-count-info') && pkg.location_count) {
      document.getElementById('location-count-info').textContent = pkg.location_count;
  }

  // Price
  const priceStr = parseFloat(pkg.price).toLocaleString('en-US');
  document.getElementById('price-info').textContent = `$${priceStr}`;

  // About Description
  document.getElementById('long-description').innerHTML = pkg.description || '<p>No description available.</p>';

  // Itinerary Timeline Builder
  const destinationsList = document.getElementById('destinations-list');
  if (pkg.itineraries && pkg.itineraries.length > 0) {
    destinationsList.innerHTML = pkg.itineraries.map((itin, index) => {
        // Timeline block structure
        return `
        <div class="timeline-item bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow group">
            <div class="timeline-badge">${itin.day_number}</div>
            
            <div class="flex flex-col md:flex-row gap-6 items-center">
                <div class="flex-1 w-full">
                    <h4 class="text-xl font-bold text-secondary mb-3">Day ${itin.day_number} : ${itin.title}</h4>
                    <div class="prose prose-sm max-w-none text-gray-600">
                        ${itin.description || '<p>Detailed activities provided upon confirmation.</p>'}
                    </div>
                </div>
                ${itin.image_url ? `
                <div class="w-full md:w-1/3 flex-shrink-0">
                    <img src="${itin.image_url}" class="w-full h-40 object-cover rounded-xl shadow-sm transform group-hover:scale-105 transition-transform duration-500" alt="Day ${itin.day_number} Destination">
                </div>
                ` : ''}
            </div>
        </div>
        `;
    }).join('');
  } else {
    destinationsList.innerHTML = `<p class="italic text-gray-500">Detailed itinerary block is being updated. Please inquire.</p>`;
  }

  // Journey Highlights (HTML)
  const inclusionsList = document.getElementById('inclusions-list');
  if (pkg.journey_highlights) {
    inclusionsList.innerHTML = pkg.journey_highlights;
  } else {
    inclusionsList.innerHTML = `<p>We offer premium standard inclusions on all our packages.</p>`;
  }

  // Map Embed Code
  const mapContainer = document.getElementById('map-container');
  if (pkg.map_embed_code && mapContainer) {
      // The admin puts a raw iframe string from Google Maps into the database
      mapContainer.innerHTML = pkg.map_embed_code;
      // Force iframe to be fully responsive
      const iframe = mapContainer.querySelector('iframe');
      if(iframe) {
          iframe.style.width = '100%';
          iframe.style.height = '100%';
          iframe.style.border = 'none';
      }
  } else if (mapContainer) {
      mapContainer.innerHTML = `<div class="text-gray-400 text-center"><i class="fas fa-map w-12 h-12 mb-2 block mx-auto opacity-20"></i><p class="text-sm">Route map not available</p></div>`;
  }

  // Insightful Tips (HTML)
  if (document.getElementById('tips-container')) {
      const tipsHtml = pkg.insightful_tips ? pkg.insightful_tips : '<p>Don\'t forget adequate sun protection and an adventurous spirit!</p>';
      document.getElementById('tips-container').innerHTML = tipsHtml;
  }

  // FAQ Content (HTML)
  if (document.getElementById('faq-container')) {
      const faqHtml = pkg.faq_content ? pkg.faq_content : '<p>Reach out to our agents regarding any questions you have.</p>';
      document.getElementById('faq-container').innerHTML = faqHtml;
  }
}

function showError() {
  document.getElementById('loading').classList.add('hidden');
  // If we had an error div we could show it here, or redirect
  document.body.innerHTML = `
    <div class="flex flex-col items-center justify-center h-screen bg-slate-50">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Package Not Found</h1>
        <p class="text-gray-500 mb-8">This tour may have been removed or updated.</p>
        <a href="packages.html" class="bg-blue-600 text-white px-6 py-3 rounded-full font-bold">Back to Packages</a>
    </div>
  `;
}

document.addEventListener('DOMContentLoaded', loadPackageDetails);
