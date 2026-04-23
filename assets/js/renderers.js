/**
 * Ocean Lilly Tours - Dynamic Renderers
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
    
    if (!packages || !Array.isArray(packages) || packages.length === 0) {
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
    
    if (!posts || !Array.isArray(posts) || posts.length === 0) {
      container.innerHTML = '<p class="text-on-surface-variant p-4">No content found.</p>';
      return;
    }

    const displayPosts = posts.slice(0, 3);
    
    displayPosts.forEach(post => {
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
    
    if (!services || !Array.isArray(services) || services.length === 0) {
      container.innerHTML = '<p class="text-on-surface-variant p-4">No services available yet.</p>';
      return;
    }

    const colors = ['primary', 'secondary', 'tertiary'];

    services.forEach((service, index) => {
      const color = colors[index % colors.length];
      
      const cardHTML = `
        <div class="bg-surface-container-lowest p-4 sm:p-6 md:p-8 rounded-xl hover:shadow-xl transition-all group border border-outline-variant/10">
          <div class="w-12 h-12 md:w-14 md:h-14 bg-${color}/10 rounded-2xl flex items-center justify-center mb-3 sm:mb-4 md:mb-6 group-hover:bg-${color} group-hover:text-on-primary transition-colors flex-shrink-0">
            <span class="material-symbols-outlined text-xl sm:text-2xl md:text-3xl">${service.icon || 'volunteer_activism'}</span>
          </div>
          <h3 class="text-base sm:text-lg md:text-xl font-headline font-bold mb-2 md:mb-3">${service.title}</h3>
          <p class="text-on-surface-variant leading-relaxed text-xs sm:text-sm mb-3 sm:mb-4 md:mb-6">${service.description}</p>
          <a class="text-primary font-bold inline-flex items-center gap-2 text-xs sm:text-sm hover:gap-3 transition-all" href="#contact">Contact Us <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
        </div>
      `;
      container.insertAdjacentHTML('beforeend', cardHTML);
    });
  }

  async function renderTestimonials() {
    const container = document.getElementById('testimonials-swiper-wrapper');
    if (!container) return;

    const testimonials = await window.API.getTestimonials();

    if (!testimonials || !Array.isArray(testimonials) || testimonials.length === 0) {
      // No admin data yet — keep the hardcoded static slides, do nothing
      return;
    }

    // Clear existing static slides and replace with DB data
    container.innerHTML = '';

    const cardStyles = ['glass-panel border border-outline-variant/10', 'bg-primary/5 border border-primary/10'];

    testimonials.forEach((t, index) => {
      // Build star icons based on rating (1-5)
      const rating = parseInt(t.rating) || 5;
      let starsHTML = '';
      for (let i = 1; i <= 5; i++) {
        const filled = i <= rating ? "'FILL' 1" : "'FILL' 0";
        starsHTML += `<span class="material-symbols-outlined" style="font-variation-settings: ${filled};">star</span>`;
      }

      // Profile image or letter avatar fallback
      const avatarHTML = t.profile_image
        ? `<img class="w-full h-full object-cover" src="${t.profile_image}" alt="${t.name}"/>`
        : `<div class="w-full h-full flex items-center justify-center bg-primary/20 text-primary font-bold text-lg">${t.name.charAt(0).toUpperCase()}</div>`;

      const cardClass = cardStyles[index % cardStyles.length];

      const slideHTML = `
        <div class="swiper-slide h-auto">
          <div class="${cardClass} p-4 sm:p-6 md:p-10 rounded-xl space-y-3 sm:space-y-4 md:space-y-6 h-full flex flex-col">
            <div class="flex gap-1 text-primary">${starsHTML}</div>
            <p class="italic text-on-surface-variant leading-relaxed text-xs sm:text-sm md:text-base flex-grow">"${t.review_text}"</p>
            <div class="flex items-center gap-3 sm:gap-4 mt-auto">
              <div class="w-10 h-10 md:w-12 md:h-12 rounded-full overflow-hidden flex-shrink-0">
                ${avatarHTML}
              </div>
              <div>
                <p class="font-headline font-bold text-xs sm:text-sm">${t.name}</p>
                <p class="text-xs text-on-surface-variant">${t.location || ''}</p>
              </div>
            </div>
          </div>
        </div>
      `;
      container.insertAdjacentHTML('beforeend', slideHTML);
    });

    // Reinitialize Swiper so the new slides register properly
    if (window.testimonialsSwiper) {
      window.testimonialsSwiper.update();
    }
  }

  async function renderPartners() {
    const container = document.getElementById('partners-logos-container');
    if (!container) return;

    const partners = await window.API.getPartners();

    if (!partners || !Array.isArray(partners) || partners.length === 0) {
      // Hide the entire section if no partners yet
      const section = document.getElementById('partners-section');
      if (section) section.style.display = 'none';
      return;
    }

    container.innerHTML = '';

    partners.forEach(partner => {
      const logoHTML = partner.logo_image
        ? `<img src="${partner.logo_image}" alt="${partner.name}" class="h-10 sm:h-12 md:h-14 w-auto max-w-[120px] sm:max-w-[150px] object-contain grayscale hover:grayscale-0 hover:scale-110 transition-all duration-300" />`
        : `<span class="text-on-surface-variant font-bold text-sm">${partner.name}</span>`;

      const wrapperHTML = partner.profile_link
        ? `<a href="${partner.profile_link}" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center p-3 sm:p-4 rounded-xl hover:bg-surface-container transition-all" title="${partner.name}">${logoHTML}</a>`
        : `<div class="flex items-center justify-center p-3 sm:p-4 rounded-xl" title="${partner.name}">${logoHTML}</div>`;

      container.insertAdjacentHTML('beforeend', wrapperHTML);
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
      renderPackages();
      renderBlogs();
      renderServices();
      renderTestimonials();
      renderPartners();
    });
  } else {
    renderPackages();
    renderBlogs();
    renderServices();
    renderTestimonials();
    renderPartners();
  }
})();
