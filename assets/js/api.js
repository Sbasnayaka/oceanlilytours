/**
 * Ocean Lilly Tours - API Bridge
 * ==============================
 * This file handles ALL communication between frontend and backend
 * - Tries to fetch from backend API endpoints first
 * - Falls back to temporary .js data files if API not ready
 * - Will work seamlessly when Laravel backend is deployed
 * 
 * Created: April 9, 2026
 * Status: SAFE - Includes fallback strategy
 */

const API = {
  // ===== PACKAGES =====
  
  /**
   * Get all packages from backend
   * Fallback: Uses window.packages from assets/data/packages.js
   */
  getPackages: async () => {
    try {
      console.log('🔄 Fetching packages from API...');
      const response = await fetch('/api/packages');
      if (response.ok) {
        console.log('✅ API packages loaded successfully');
        return response.json();
      }
    } catch (err) {
      console.warn('⚠️ Backend API not ready, using local data');
    }
    // Fallback to local .js file if API not available
    return window.packages || [];
    // Returns: [{id:1, name:"Nature Explorer", price:2500, ...}, ...]
  },

  /**
   * Get single package by ID
   * Fallback: Uses window.packages array
   */
  getPackage: async (id) => {
    try {
      console.log(`🔄 Fetching package ${id} from API...`);
      const response = await fetch(`/api/packages/${id}`);
      if (response.ok) {
        console.log(`✅ Package ${id} loaded successfully`);
        return response.json();
      }
    } catch (err) {
      console.warn(`⚠️ Backend API not ready, using local data`);
    }
    // Fallback to local .js file
    const packages = window.packages || [];
    return packages.find(p => p.id === parseInt(id)) || {};
    // Returns: {id:1, name:"Nature Explorer", price:2500, days:7, itinerary:[...], ...}
  },

  /**
   * Get 5 featured packages
   * Fallback: Uses window.packages array
   */
  getFeaturedPackages: async () => {
    try {
      console.log('🔄 Fetching featured packages from API...');
      const response = await fetch('/api/packages?featured=true');
      if (response.ok) {
        console.log('✅ Featured packages loaded successfully');
        return response.json();
      }
    } catch (err) {
      console.warn('⚠️ Backend API not ready, using local data');
    }
    // Fallback to local .js file - return first 5
    const packages = window.packages || [];
    return packages.slice(0, 5);
    // Returns: 5 featured packages
  },

  // ===== BLOG =====

  /**
   * Get all blog posts
   * Fallback: Uses window.blogPosts from assets/data/blog-posts.js
   */
  getBlog: async () => {
    try {
      console.log('🔄 Fetching blog posts from API...');
      const response = await fetch('/api/blog');
      if (response.ok) {
        console.log('✅ Blog posts loaded successfully');
        return response.json();
      }
    } catch (err) {
      console.warn('⚠️ Backend API not ready, using local data');
    }
    // Fallback to local .js file
    return window.blogPosts || [];
    // Returns: [{id:1, title:"Misty Ella", slug:"misty-ella", content:"...", ...}, ...]
  },

  /**
   * Get single blog post by slug
   * Fallback: Uses window.blogPosts array
   */
  getBlogPost: async (slug) => {
    try {
      console.log(`🔄 Fetching blog post "${slug}" from API...`);
      const response = await fetch(`/api/blog?slug=${slug}`);
      if (response.ok) {
        console.log(`✅ Blog post "${slug}" loaded successfully`);
        return response.json();
      }
    } catch (err) {
      console.warn(`⚠️ Backend API not ready, using local data`);
    }
    // Fallback to local .js file
    const posts = window.blogPosts || [];
    return posts.find(p => p.slug === slug) || {};
    // Returns: Single blog post object
  },

  /**
   * Get 3 featured blog posts
   * Fallback: Uses window.blogPosts array
   */
  getFeaturedBlog: async () => {
    try {
      console.log('🔄 Fetching featured blog posts from API...');
      const response = await fetch('/api/blog?featured=true');
      if (response.ok) {
        console.log('✅ Featured blog posts loaded successfully');
        return response.json();
      }
    } catch (err) {
      console.warn('⚠️ Backend API not ready, using local data');
    }
    // Fallback to local .js file - return first 3
    const posts = window.blogPosts || [];
    return posts.slice(0, 3);
    // Returns: 3 featured blog posts
  },

  // ===== GALLERY =====

  /**
   * Get all gallery images
   * Fallback: Uses window.galleryImages from assets/data/gallery.js
   */
  getGallery: async () => {
    try {
      console.log('🔄 Fetching gallery images from API...');
      const response = await fetch('/api/gallery');
      if (response.ok) {
        console.log('✅ Gallery images loaded successfully');
        return response.json();
      }
    } catch (err) {
      console.warn('⚠️ Backend API not ready, using local data');
    }
    // Fallback to local .js file
    return window.galleryImages || [];
    // Returns: [{id:1, title:"...", url:"...", ...}, ...]
  },

  // ===== TESTIMONIALS =====

  /**
   * Get all testimonials
   * Fallback: Uses window.testimonials from assets/data/testimonials.js
   */
  getTestimonials: async () => {
    try {
      console.log('🔄 Fetching testimonials from API...');
      const response = await fetch('/api/testimonials');
      if (response.ok) {
        console.log('✅ Testimonials loaded successfully');
        return response.json();
      }
    } catch (err) {
      console.warn('⚠️ Backend API not ready, using local data');
    }
    // Fallback to local .js file
    return window.testimonials || [];
    // Returns: [{id:1, name:"Sarah", rating:5, text:"...", ...}, ...]
  },

  // ===== CONTACT FORM =====

  /**
   * Submit contact form
   * Sends to backend API
   * @param {Object} data - {name, email, message}
   */
  submitContact: async (data) => {
    try {
      console.log('🔄 Submitting contact form...');
      const response = await fetch('/api/contact', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data) // {name, email, message}
      });
      
      if (response.ok) {
        console.log('✅ Contact form submitted successfully');
        return response.json();
      }
      
      throw new Error(`HTTP error! status: ${response.status}`);
    } catch (err) {
      console.error('❌ Contact form submission failed:', err);
      return {
        success: false,
        message: 'Failed to submit form. Please try again.'
      };
    }
    // Returns: {success: true, message: "Email sent"}
  },
};

// Export for use globally
window.API = API;

console.log('✅ api.js loaded successfully - API bridge ready');
