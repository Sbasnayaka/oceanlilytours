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

const API_BASE_URL = window.location.hostname.includes('jerzy.lk') 
  ? '/oceanlilly/backend_laravel/public/api' 
  : '/api';

const API = {
  // ===== PACKAGES =====
  
  /**
   * Get all packages from backend
   * Fallback: Uses window.packages from assets/data/packages.js
   */
  getPackages: async () => {
    try {
      console.log('🔄 Fetching packages from API...');
      const response = await fetch(`${API_BASE_URL}/packages`);
      if (response.ok) {
        console.log('✅ API packages loaded successfully');
        return response.json();
      }
    } catch (err) {
      console.warn('⚠️ Backend API not ready, using local data');
    }
    return window.packages || [];
  },

  /**
   * Get single package by ID
   */
  getPackage: async (id) => {
    try {
      console.log(`🔄 Fetching package ${id} from API...`);
      const response = await fetch(`${API_BASE_URL}/packages/${id}`);
      if (response.ok) {
        console.log(`✅ Package ${id} loaded successfully`);
        return response.json();
      }
    } catch (err) {
      console.warn(`⚠️ Backend API not ready, using local data`);
    }
    const packages = window.packages || [];
    return packages.find(p => p.id === parseInt(id)) || {};
  },

  /**
   * Get 5 featured packages
   */
  getFeaturedPackages: async () => {
    try {
      console.log('🔄 Fetching featured packages from API...');
      const response = await fetch(`${API_BASE_URL}/packages?featured=true`);
      if (response.ok) {
        console.log('✅ Featured packages loaded successfully');
        return response.json();
      }
    } catch (err) {
      console.warn('⚠️ Backend API not ready, using local data');
    }
    const packages = window.packages || [];
    return packages.slice(0, 5);
  },

  // ===== BLOG =====

  /**
   * Get all blog posts
   */
  getBlog: async () => {
    try {
      console.log('🔄 Fetching blog posts from API...');
      const response = await fetch(`${API_BASE_URL}/blog`);
      if (response.ok) {
        console.log('✅ Blog posts loaded successfully');
        return response.json();
      }
    } catch (err) {
      console.warn('⚠️ Backend API not ready, using local data');
    }
    return window.blogPosts || [];
  },

  /**
   * Get single blog post by slug
   */
  getBlogPost: async (slug) => {
    try {
      console.log(`🔄 Fetching blog post "${slug}" from API...`);
      const response = await fetch(`${API_BASE_URL}/blog?slug=${slug}`);
      if (response.ok) {
        console.log(`✅ Blog post "${slug}" loaded successfully`);
        return response.json();
      }
    } catch (err) {
      console.warn(`⚠️ Backend API not ready, using local data`);
    }
    const posts = window.blogPosts || [];
    return posts.find(p => p.slug === slug) || {};
  },

  /**
   * Get 3 featured blog posts
   */
  getFeaturedBlog: async () => {
    try {
      console.log('🔄 Fetching featured blog posts from API...');
      const response = await fetch(`${API_BASE_URL}/blog?featured=true`);
      if (response.ok) {
        console.log('✅ Featured blog posts loaded successfully');
        return response.json();
      }
    } catch (err) {
      console.warn('⚠️ Backend API not ready, using local data');
    }
    const posts = window.blogPosts || [];
    return posts.slice(0, 3);
  },

  // ===== SERVICES =====

  getServices: async () => {
    try {
      console.log('🔄 Fetching services from API...');
      const response = await fetch(`${API_BASE_URL}/services`);
      if (response.ok) {
        console.log('✅ Services loaded successfully');
        return response.json();
      }
    } catch (err) {
      console.warn('⚠️ Backend API not ready, using local data');
    }
    return window.services || [];
  },

  // ===== GALLERY =====

  getGallery: async () => {
    try {
      console.log('🔄 Fetching gallery images from API...');
      const response = await fetch(`${API_BASE_URL}/gallery`);
      if (response.ok) {
        console.log('✅ Gallery images loaded successfully');
        return response.json();
      }
    } catch (err) {
      console.warn('⚠️ Backend API not ready, using local data');
    }
    return window.galleryImages || [];
  },

  // ===== TESTIMONIALS =====

  getTestimonials: async () => {
    try {
      console.log('🔄 Fetching testimonials from API...');
      const response = await fetch(`${API_BASE_URL}/testimonials`);
      if (response.ok) {
        console.log('✅ Testimonials loaded successfully');
        return response.json();
      }
    } catch (err) {
      console.warn('⚠️ Backend API not ready, using local data');
    }
    return window.testimonials || [];
  },

  // ===== HERO SLIDES =====

  getHeroSlides: async () => {
    try {
      console.log('🔄 Fetching hero slides from API...');
      const response = await fetch(`${API_BASE_URL}/hero-slides`);
      if (response.ok) {
        console.log('✅ Hero slides loaded successfully');
        return response.json();
      }
    } catch (err) {
      console.warn('⚠️ Backend API not ready, using local data');
    }
    return window.heroSlides || [];
  },

  // ===== CONTACT FORM =====

  submitContact: async (data) => {
    try {
      console.log('🔄 Submitting contact form...');
      const response = await fetch(`${API_BASE_URL}/contact`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
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
  },
};

// Export for use globally
window.API = API;

console.log('✅ api.js loaded successfully - API bridge ready');
