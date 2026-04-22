function renderGalleryImage(image) {
  return `
    <div class="overflow-hidden rounded-lg h-48 sm:h-40 md:h-56 cursor-pointer hover:shadow-luxury transition-shadow duration-300 group" onclick="openLightbox('${image.image_url}', '${image.title}')">
      <img src="${image.image_url}" alt="${image.title}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"/>
    </div>
  `;
}

// Lightbox logic
function openLightbox(imageUrl, title) {
    const lightbox = document.getElementById('gallery-lightbox');
    const lightboxImg = document.getElementById('lightbox-image');
    const lightboxTitle = document.getElementById('lightbox-title');
    
    if(lightbox && lightboxImg) {
        lightboxImg.src = imageUrl;
        if(lightboxTitle) lightboxTitle.textContent = title || '';
        
        lightbox.classList.remove('hidden');
        // trigger reflow
        void lightbox.offsetWidth;
        lightbox.classList.remove('opacity-0');
        lightboxImg.classList.remove('scale-95');
    }
}

function closeLightbox() {
    const lightbox = document.getElementById('gallery-lightbox');
    const lightboxImg = document.getElementById('lightbox-image');
    
    if(lightbox && lightboxImg) {
        lightbox.classList.add('opacity-0');
        lightboxImg.classList.add('scale-95');
        
        setTimeout(() => {
            lightbox.classList.add('hidden');
            lightboxImg.src = '';
        }, 300);
    }
}

async function loadGallery() {
  try {
    const galleryContainer = document.getElementById('gallery-grid');
    if (!galleryContainer) return;

    galleryContainer.innerHTML = `<div class="col-span-full text-center py-8"><p class="text-on-surface-variant">Loading gallery...</p></div>`;

    const images = await API.getGallery();

    if (!images || images.length === 0) {
      galleryContainer.innerHTML = `<div class="col-span-full text-center py-12"><p class="text-on-surface-variant">No images available yet.</p></div>`;
      return;
    }

    galleryContainer.innerHTML = images.map(renderGalleryImage).join('');
    
    // Setup close listeners once gallery is loaded
    setupLightboxListeners();
  } catch (error) {
    console.error('Error loading gallery:', error);
    const galleryContainer = document.getElementById('gallery-grid');
    if (galleryContainer) {
      galleryContainer.innerHTML = `<div class="col-span-full text-center py-12"><p class="text-red-600">Error loading gallery. Please try again later.</p></div>`;
    }
  }
}

function setupLightboxListeners() {
    const closeBtn = document.getElementById('close-lightbox');
    const lightbox = document.getElementById('gallery-lightbox');
    
    if(closeBtn) {
        closeBtn.addEventListener('click', closeLightbox);
    }
    
    // Close on background click
    if(lightbox) {
        lightbox.addEventListener('click', (e) => {
            if(e.target === lightbox) {
                closeLightbox();
            }
        });
    }
    
    // Close on ESC key
    document.addEventListener('keydown', (e) => {
        if(e.key === 'Escape' && lightbox && !lightbox.classList.contains('hidden')) {
            closeLightbox();
        }
    });
}

document.addEventListener('DOMContentLoaded', loadGallery);
