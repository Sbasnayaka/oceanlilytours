/**
 * Blog Post Page JavaScript - Loads individual blog post by slug
 */
function getUrlParameter(paramName) {
  return new URLSearchParams(window.location.search).get(paramName);
}

async function loadBlogPost() {
  try {
    const slug = getUrlParameter('slug');
    if (!slug) { showError(); return; }
    
    const post = await API.getBlogPost(slug);
    if (!post || !post.id) { showError(); return; }
    
    displayPost(post);
  } catch (err) {
    console.error('Error loading blog post:', err);
    showError();
  }
}

function displayPost(post) {
  document.getElementById('loading').classList.add('hidden');
  document.getElementById('blog-content').classList.remove('hidden');
  
  const categoryName = post.category ? post.category.name : 'Journal';
  const postDate = post.created_at ? new Date(post.created_at).toLocaleDateString() : 'Recent';

  document.getElementById('post-image').src = post.featured_image || 'assets/uploads/placeholder.jpg';
  document.getElementById('post-title').textContent = post.title;
  document.getElementById('post-date').textContent = postDate;
  document.getElementById('post-readtime').textContent = '5 min read';
  document.getElementById('post-category').textContent = categoryName;
  
  // VERY IMPORTANT: Use innerHTML to render TinyMCE Rich Text safely
  document.getElementById('post-body').innerHTML = post.content;
  
  document.title = `${post.title} | Ocean Lilly Tours`;
}

function showError() {
  document.getElementById('loading').classList.add('hidden');
  document.getElementById('error-message').classList.remove('hidden');
}

document.addEventListener('DOMContentLoaded', loadBlogPost);
