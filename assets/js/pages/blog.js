/**
 * Blog Page JavaScript - Renders all blog posts
 */
function renderBlogCard(post) {
  const categoryName = post.category ? post.category.name : 'Journal';
  const postDate = post.created_at ? new Date(post.created_at).toLocaleDateString() : 'Recent';
  
  return `
    <a href="blog-post.html?slug=${post.slug}" class="group flex flex-col bg-surface-container-lowest rounded-xl overflow-hidden hover:shadow-luxury transition-all border border-outline-variant/10">
      <div class="relative h-48 sm:h-56 md:h-64 overflow-hidden">
        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="${post.featured_image}" alt="${post.title}"/>
        <div class="absolute top-3 left-3 bg-secondary text-white text-xs font-bold px-3 py-1 rounded-full">${categoryName}</div>
      </div>
      <div class="p-4 sm:p-5 md:p-6 flex flex-col flex-grow">
        <h3 class="text-base sm:text-lg md:text-xl font-headline font-bold text-on-surface line-clamp-2 group-hover:text-primary transition-colors mb-3">${post.title}</h3>
        <p class="text-on-surface-variant text-xs sm:text-sm leading-relaxed mb-4 line-clamp-2 flex-grow">${post.excerpt}</p>
        <div class="flex items-center justify-between text-xs text-on-surface-variant">
          <span>${postDate}</span>
          <span>5 min read</span>
        </div>
      </div>
    </a>
  `;
}

async function loadBlog() {
  try {
    const posts = await API.getBlog();
    if (!posts || posts.length === 0) {
      document.getElementById('blog-grid').innerHTML = '<div class="col-span-full text-center py-12">No blog posts available</div>';
      return;
    }
    document.getElementById('blog-grid').innerHTML = posts.map(post => renderBlogCard(post)).join('');
    console.log(`✅ Loaded ${posts.length} blog posts`);
  } catch (err) {
    console.error('❌ Error loading blog:', err);
  }
}

document.addEventListener('DOMContentLoaded', loadBlog);
