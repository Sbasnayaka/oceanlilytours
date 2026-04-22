let galleryImages = [];
let currentIndex = 0;

function renderGalleryImage(image, index) {
  return `
    <div class="overflow-hidden rounded-lg h-48 sm:h-40 md:h-56 cursor-pointer hover:shadow-luxury transition-shadow duration-300 group" onclick="openLightbox(${index})">
      <img src="${image.image_url}" alt="${image.title || 'Gallery Image'}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"/>
    </div>
  `;
}

// Lightbox logic function
function openLightbox(index) {
    currentIndex = index;
    updateLightboxContent();
    
    const lightbox = document.getElementById('gallery-lightbox');
    const lightboxImg = document.getElementById('lightbox-image');
    
    if(lightbox && lightboxImg) {
        lightbox.classList.remove('hidden');
        lightbox.classList.remove('flex-col');
        lightbox.classList.add('flex');
        
        // trigger reflow
        void lightbox.offsetWidth;
        lightbox.classList.remove('opacity-0');
        lightboxImg.classList.remove('scale-95');
    }
}

function updateLightboxContent() {
    if (galleryImages.length === 0) return;
    
    const image = galleryImages[currentIndex];
    
    const lightboxImg = document.getElementById('lightbox-image');
    const lightboxDesc = document.getElementById('lightbox-desc');
    const lightboxCaptionContainer = document.getElementById('lightbox-caption-container');
    const lightboxCounter = document.getElementById('lightbox-counter');
    
    if(lightboxImg) lightboxImg.src = image.image_url;
    if(lightboxCounter) lightboxCounter.textContent = `${currentIndex + 1}/${galleryImages.length}`;
    
    // In Gallery we have description. But backend API response usually gives image_url, title, maybe description.
    // Let's fallback to title if description is not available, or empty.
    const captionText = image.description || image.title || '';
    
    if (captionText.trim() !== '') {
        if(lightboxDesc) lightboxDesc.textContent = captionText;
        if(lightboxCaptionContainer) lightboxCaptionContainer.classList.remove('hidden');
    } else {
        if(lightboxCaptionContainer) lightboxCaptionContainer.classList.add('hidden');
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
            lightbox.classList.remove('flex');
            lightboxImg.src = '';
        }, 300);
    }
}

function nextImage(e) {
    if(e) e.stopPropagation();
    if (galleryImages.length === 0) return;
    currentIndex = (currentIndex + 1) % galleryImages.length;
    updateLightboxContent();
}

function prevImage(e) {
    if(e) e.stopPropagation();
    if (galleryImages.length === 0) return;
    currentIndex = (currentIndex - 1 + galleryImages.length) % galleryImages.length;
    updateLightboxContent();
}

async function loadGallery() {
  try {
    const galleryContainer = document.getElementById('gallery-grid');
    if (!galleryContainer) return;

    galleryContainer.innerHTML = `<div class="col-span-full text-center py-8"><p class="text-on-surface-variant">Loading gallery...</p></div>`;

    galleryImages = await API.getGallery();

    if (!galleryImages || galleryImages.length === 0) {
      galleryContainer.innerHTML = `<div class="col-span-full text-center py-12"><p class="text-on-surface-variant">No images available yet.</p></div>`;
      return;
    }

    galleryContainer.innerHTML = galleryImages.map((img, idx) => renderGalleryImage(img, idx)).join('');
    
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
    const nextBtn = document.getElementById('next-lightbox');
    const prevBtn = document.getElementById('prev-lightbox');
    const lightbox = document.getElementById('gallery-lightbox');
    
    if(closeBtn) closeBtn.addEventListener('click', closeLightbox);
    if(nextBtn) nextBtn.addEventListener('click', nextImage);
    if(prevBtn) prevBtn.addEventListener('click', prevImage);
    
    // Close on background click
    if(lightbox) {
        lightbox.addEventListener('click', (e) => {
            // only close if they clicked the darkened background directly
            if(e.target === lightbox || e.target.classList.contains('p-4') || e.target.classList.contains('sm:p-12')) {
                closeLightbox();
            }
        });
    }
    
    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if(lightbox && !lightbox.classList.contains('hidden')) {
            if(e.key === 'Escape') closeLightbox();
            if(e.key === 'ArrowRight') nextImage();
            if(e.key === 'ArrowLeft') prevImage();
        }
    });
}

document.addEventListener('DOMContentLoaded', loadGallery);
