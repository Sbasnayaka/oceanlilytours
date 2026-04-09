function renderGalleryImage(image) {
  return `
    <div class="overflow-hidden rounded-lg h-48 sm:h-40 md:h-56 cursor-pointer hover:shadow-luxury transition-shadow duration-300 group">
      <img src="${image.image_url}" alt="${image.title}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"/>
    </div>
  `;
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
  } catch (error) {
    console.error('Error loading gallery:', error);
    const galleryContainer = document.getElementById('gallery-grid');
    if (galleryContainer) {
      galleryContainer.innerHTML = `<div class="col-span-full text-center py-12"><p class="text-red-600">Error loading gallery. Please try again later.</p></div>`;
    }
  }
}

document.addEventListener('DOMContentLoaded', loadGallery);
