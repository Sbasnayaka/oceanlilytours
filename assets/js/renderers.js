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
      const categorySlug = pkg.category ? pkg.category.slug : 'default';
      const categoryName = pkg.category ? pkg.category.name : 'Tour';
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
  
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
      renderPackages();
      renderBlogs();
    });
  } else {
    renderPackages();
    renderBlogs();
  }
})();
