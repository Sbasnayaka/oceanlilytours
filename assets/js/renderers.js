/**
 * Ocean Lilly Tours - Dynamic Renderers
 * =====================================
 * This script transforms API data into DOM elements.
 */

(function() {
  const tourCategoryColorMap = {
    'nature-wellness': 'bg-tertiary',
    'romantic-luxury': 'bg-secondary',
    'cultural-heritage': 'bg-primary',
    'adventure-combo': 'bg-tertiary',
    'spa-wellness': 'bg-secondary',
    'tea-country': 'bg-primary',
    'cultural-deep-dive': 'bg-tertiary',
    'premium-luxury': 'bg-secondary'
  };

  async function renderPackages() {
    const container = document.getElementById('packages-grid-container');
    if (!container) return;

    container.innerHTML = '<p class="text-on-surface-variant p-4">Loading packages...</p>';
    
    // We fetch ALL Packages for index.html currently (based on layout).
    const packages = await window.API.getPackages(); 
    container.innerHTML = '';
    
    if (packages.length === 0) {
      container.innerHTML = '<p class="text-on-surface-variant p-4">No packages found.</p>';
      return;
    }

    packages.forEach(pkg => {
      const primaryCat = (pkg.categories && pkg.categories.length > 0) ? pkg.categories[0] : pkg.category;
      const categorySlug = primaryCat ? primaryCat.slug : 'default';
      const categoryName = primaryCat ? primaryCat.name : 'Tour';
      const badgeColor = tourCategoryColorMap[categorySlug] || 'bg-primary';

      // Ensure price is formatted nicely string like "1,250"
      const priceStr = parseFloat(pkg.price).toLocaleString('en-US');

      const cardHTML = `
        <div class="w-[280px] sm:w-[300px] md:w-[320px] flex-shrink-0 flex-grow-0 group flex flex-col h-full min-h-[380px] sm:min-h-[430px] md:min-h-[520px]">
          <div class="relative h-[220px] sm:h-[280px] md:h-[340px] rounded-xl overflow-hidden mb-3 sm:mb-4 md:mb-5">
            <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="${pkg.image_url}"/>
            <div class="absolute top-3 left-3 sm:top-4 sm:left-4 ${badgeColor} text-white text-xs font-bold px-2 sm:px-3 py-1 rounded-full">${categoryName}</div>
          </div>
          <div class="space-y-2 sm:space-y-2 md:space-y-3 flex flex-col flex-grow justify-between">
            <div class="flex flex-col sm:flex-row sm:flex-wrap justify-between items-start sm:items-center gap-2">
              <h3 class="text-base sm:text-lg md:text-xl font-headline font-bold line-clamp-2">${pkg.name}</h3>
              <span class="bg-secondary-container text-secondary text-xs font-bold px-2 sm:px-3 py-1 rounded-lg flex-shrink-0">From $${priceStr}</span>
            </div>
            <p class="text-on-surface-variant line-clamp-2 text-xs sm:text-sm">${pkg.description}</p>
            <a href="pages/package-detail.html?id=${pkg.id}" class="w-full py-2 sm:py-2.5 md:py-3 rounded-full border border-primary text-primary font-bold hover:bg-primary hover:text-on-primary transition-all text-xs sm:text-sm block text-center">View Full Details</a>
          </div>
        </div>
      `;
      container.insertAdjacentHTML('beforeend', cardHTML);
    });
  }

  async function renderBlogs() {
    const container = document.getElementById('blog-grid-container');
    if (!container) return;

    container.innerHTML = '<p class="text-on-surface-variant p-4">Loading journals...</p>';
    const posts = await window.API.getFeaturedBlog();
    container.innerHTML = '';
    
    if (posts.length === 0) {
      container.innerHTML = '<p class="text-on-surface-variant p-4">No content found.</p>';
      return;
    }

    posts.forEach(post => {
      const categoryName = post.category ? post.category.name : 'Journal';
      
      const cardHTML = `
        <article class="space-y-3 sm:space-y-4 md:space-y-6 flex flex-col">
          <div class="overflow-hidden rounded-xl h-40 sm:h-48 md:h-64 flex-shrink-0">
            <img class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" src="${post.featured_image}"/>
          </div>
          <div class="flex gap-2">
            <span class="text-xs font-bold px-3 py-1 bg-primary/10 text-primary rounded-full">${categoryName}</span>
          </div>
          <h3 class="text-xl md:text-2xl font-headline font-bold hover:text-primary cursor-pointer transition-colors line-clamp-2"><a href="pages/blog-post.html?slug=${post.slug}">${post.title}</a></h3>
          <p class="text-on-surface-variant text-sm line-clamp-3">${post.excerpt}</p>
        </article>
      `;
      container.insertAdjacentHTML('beforeend', cardHTML);
    });
  }
  
  async function renderServices() {
    const container = document.getElementById('services-grid-container');
    if (!container) return;

    container.innerHTML = '<p class="text-on-surface-variant p-4">Loading services...</p>';
    const services = await window.API.getServices();
    container.innerHTML = '';
    
    if (!services || services.length === 0) {
      container.innerHTML = '<p class="text-on-surface-variant p-4">No services available yet.</p>';
      return;
    }

    const colors = ['primary', 'secondary', 'tertiary'];

    services.forEach((service, index) => {
      const color = colors[index % colors.length];
      
      const cardHTML = `
        <div class="bg-surface-container-lowest p-4 sm:p-6 md:p-8 rounded-xl hover:shadow-xl transition-all group border border-outline-variant/10">
          <div class="w-12 h-12 md:w-14 md:h-14 bg-${color}/10 rounded-2xl flex items-center justify-center mb-3 sm:mb-4 md:mb-6 group-hover:bg-${color} group-hover:text-on-primary transition-colors flex-shrink-0">
            <span class="material-symbols-outlined text-xl sm:text-2xl md:text-3xl">${service.icon_name || 'volunteer_activism'}</span>
          </div>
          <h3 class="text-base sm:text-lg md:text-xl font-headline font-bold mb-2 md:mb-3">${service.name}</h3>
          <p class="text-on-surface-variant leading-relaxed text-xs sm:text-sm mb-3 sm:mb-4 md:mb-6">${service.description}</p>
          <a class="text-primary font-bold inline-flex items-center gap-2 text-xs sm:text-sm hover:gap-3 transition-all" href="#contact">Contact Us <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
        </div>
      `;
      container.insertAdjacentHTML('beforeend', cardHTML);
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
      renderPackages();
      renderBlogs();
      renderServices();
    });
  } else {
    renderPackages();
    renderBlogs();
    renderServices();
  }
})();
