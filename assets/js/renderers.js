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

    posts.slice(0, 3).forEach(post => {
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
    if (!testimonials || testimonials.length === 0) return;

    container.innerHTML = '';
    const cardStyles = ['glass-panel border border-outline-variant/10', 'bg-primary/5 border border-primary/10'];

    testimonials.forEach((t, index) => {
      const rating = parseInt(t.rating) || 5;
      let starsHTML = '';
      for (let i = 1; i <= 5; i++) {
        const filled = i <= rating ? "'FILL' 1" : "'FILL' 0";
        starsHTML += `<span class="material-symbols-outlined" style="font-variation-settings: ${filled};">star</span>`;
      }

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

    if (window.testimonialsSwiper) {
        window.testimonialsSwiper.destroy();
        // Trigger re-init via main.js or local re-init
        const { initCarousel } = await import('./carousel.js');
        initCarousel();
    }
  }

  async function renderAboutUs() {
    const section = document.getElementById('about');
    if (!section) return;

    const about = await window.API.getAboutUs();
    if (about) {
        const h2 = document.getElementById('about-title');
        const p = document.getElementById('about-description');
        const img = section.querySelector('img');
        
        if (h2 && about.title) h2.textContent = about.title;
        if (p && about.description) p.textContent = about.description;
        if (img && about.team_image) img.src = about.team_image;

        // Mission
        if (about.mission_text) {
            document.getElementById('about-mission').textContent = about.mission_text;
            document.getElementById('about-mission-container').classList.remove('hidden');
        }
        // Vision
        if (about.vision_text) {
            document.getElementById('about-vision').textContent = about.vision_text;
            document.getElementById('about-vision-container').classList.remove('hidden');
        }
        // Values
        if (about.values_text) {
            document.getElementById('about-values').textContent = about.values_text;
            document.getElementById('about-values-container').classList.remove('hidden');
        }

        const featuresContainer = document.getElementById('about-features');
        if (featuresContainer) {
            const features = await window.API.getWhyChooseUs();
            if (features && features.length > 0) {
                featuresContainer.innerHTML = '';
                features.forEach(f => {
                    featuresContainer.insertAdjacentHTML('beforeend', `
                        <div class="flex gap-3 sm:gap-4 items-start">
                            <span class="material-symbols-outlined text-primary p-2 bg-primary/10 rounded-lg flex-shrink-0">${f.icon_class || 'verified_user'}</span>
                            <div class="min-w-0">
                                <h4 class="font-headline font-bold text-sm sm:text-base">${f.title}</h4>
                                <p class="text-xs sm:text-sm text-on-surface-variant">${f.description}</p>
                            </div>
                        </div>
                    `);
                });
            }
        }
    }
  }

  async function renderPartners() {
    const container = document.getElementById('partners-logos-container');
    if (!container) return;

    const partners = await window.API.getPartners();
    if (!partners || partners.length === 0) {
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

  async function renderHeroSlides() {
    const wrapper = document.getElementById('heroSwiperWrapper');
    if (!wrapper) return;

    const slides = await window.API.getHeroSlides();
    if (!slides || slides.length === 0) return;

    wrapper.innerHTML = '';
    slides.forEach(slide => {
      const slideHTML = `
        <div class="swiper-slide relative">
          <img class="w-full h-full object-cover" src="${slide.image_url}" alt="${slide.title}">
          <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-transparent"></div>
          <div class="absolute inset-0 flex flex-col justify-center px-3 sm:px-6 md:px-8 pt-8 sm:pt-0 hero-overlay-content">
            <div class="max-w-7xl mx-auto w-full">
              <div class="max-w-full sm:max-w-2xl space-y-3 sm:space-y-4 md:space-y-8">
                <div class="inline-flex items-center gap-2 px-3 sm:px-4 py-1 sm:py-1.5 rounded-full bg-secondary-container/30 backdrop-blur-md border border-secondary/20">
                  <span class="w-2 h-2 rounded-full bg-secondary flex-shrink-0"></span>
                  <span class="text-xs font-headline font-bold uppercase tracking-widest text-white">${slide.badge_text || ''}</span>
                </div>
                <h1 class="text-2xl sm:text-4xl md:text-6xl lg:text-8xl font-headline font-extrabold text-white leading-tight tracking-tighter">
                  ${slide.title}
                </h1>
                <p class="text-xs sm:text-base md:text-lg lg:text-xl text-white/90 font-light leading-relaxed max-w-lg">
                  ${slide.description || ''}
                </p>
                <div class="flex flex-wrap gap-2 sm:gap-4">
                  <a href="${slide.button_url || '#contact'}" class="bg-primary text-on-primary px-4 sm:px-6 md:px-10 py-2 sm:py-3 md:py-5 rounded-full font-headline font-bold text-xs sm:text-base md:text-lg shadow-2xl hover:scale-105 transition-all inline-block">${slide.cta_primary_text || 'Start Your Journey'}</a>
                  <button class="flex items-center gap-2 text-white font-headline font-bold px-4 sm:px-6 md:px-8 py-2 sm:py-3 md:py-5 group text-xs sm:text-base">
                    <span class="material-symbols-outlined rounded-full border border-white/40 p-1 sm:p-2 group-hover:bg-white group-hover:text-primary transition-all text-base sm:text-lg">play_arrow</span>
                    <span class="hidden sm:inline">${slide.cta_secondary_text || 'Watch Experience'}</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      `;
      wrapper.insertAdjacentHTML('beforeend', slideHTML);
    });

    if (window.heroSwiper) {
        window.heroSwiper.destroy();
        const { initCarousel } = await import('./carousel.js');
        initCarousel();
    }
  }

  async function renderNavbar() {
    const desktopContainer = document.querySelector('.hidden.md\\:flex.gap-6.lg\\:gap-8');
    const mobileContainer = document.getElementById('mobileMenu');
    if (!desktopContainer || !mobileContainer) return;

    const items = await window.API.getNavbarItems();
    if (items && items.length > 0) {
        desktopContainer.innerHTML = '';
        const links = mobileContainer.querySelectorAll('.mobile-nav-link');
        links.forEach(l => l.remove());

        items.forEach(item => {
            const dLink = document.createElement('a');
            dLink.className = 'nav-link font-bold tracking-tight text-sm text-white border-b-2 border-transparent hover:border-white pb-1 transition-all duration-300';
            dLink.href = item.url;
            dLink.textContent = item.label;
            desktopContainer.appendChild(dLink);

            const mLink = document.createElement('a');
            mLink.className = 'mobile-nav-link';
            mLink.href = item.url;
            mLink.textContent = item.label;
            if (item.url && item.url.startsWith('#')) mLink.setAttribute('onclick', 'toggleMobileMenu()');
            mobileContainer.insertBefore(mLink, mobileContainer.querySelector('button'));
        });
    }
  }

  async function renderFooter() {
    const footer = document.querySelector('footer');
    if (!footer) return;

    const items = await window.API.getFooterContent();
    if (items && items.length > 0) {
        const sections = {};
        items.forEach(item => {
            if (!sections[item.section]) sections[item.section] = [];
            sections[item.section].push(item);
        });

        const grid = footer.querySelector('.grid');
        if (!grid) return;
        
        const columns = grid.querySelectorAll('.space-y-3');
        columns.forEach(col => {
            const title = col.querySelector('h4')?.textContent;
            if (title && sections[title]) {
                const ul = col.querySelector('ul');
                if (ul) {
                    ul.innerHTML = '';
                    sections[title].forEach(link => {
                        ul.insertAdjacentHTML('beforeend', `<li><a class="text-slate-400 hover:text-sky-300 transition-colors text-xs sm:text-sm" href="${link.value}">${link.key_name}</a></li>`);
                    });
                }
            }
        });
    }
  }

  async function applySEO() {
    let pageName = 'home';
    const path = window.location.pathname;
    
    if (path.includes('packages.html')) pageName = 'packages';
    else if (path.includes('package-detail.html')) pageName = 'package-detail';
    else if (path.includes('blog.html')) pageName = 'blog';
    else if (path.includes('gallery.html')) pageName = 'gallery';
    else if (path.includes('contact.html')) pageName = 'contact';

    const seo = await window.API.getSeoData(pageName);
    if (seo) {
        if (seo.meta_title) document.title = seo.meta_title;
        
        const setMeta = (name, content) => {
            if (!content) return;
            let el = document.querySelector(`meta[name="${name}"]`);
            if (!el) {
                el = document.createElement('meta');
                el.name = name;
                document.head.appendChild(el);
            }
            el.content = content;
        };

        const setOg = (property, content) => {
            if (!content) return;
            let el = document.querySelector(`meta[property="${property}"]`);
            if (!el) {
                el = document.createElement('meta');
                el.setAttribute('property', property);
                document.head.appendChild(el);
            }
            el.content = content;
        };

        setMeta('description', seo.meta_description);
        setMeta('keywords', seo.meta_keywords);
        setOg('og:title', seo.og_title || seo.meta_title);
        setOg('og:description', seo.og_description || seo.meta_description);
        if (seo.og_image) {
            setOg('og:image', window.location.origin + (window.location.pathname.includes('oceanlily') ? '/oceanlilly/backend_laravel/public' : '') + seo.og_image);
        }
    }
  }

  const initialize = () => {
    applySEO();
    renderHeroSlides();
    renderNavbar();
    renderAboutUs();
    renderPackages();
    renderBlogs();
    renderServices();
    renderTestimonials();
    renderPartners();
    renderFooter();
  };

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initialize);
  } else {
    initialize();
  }
})();
