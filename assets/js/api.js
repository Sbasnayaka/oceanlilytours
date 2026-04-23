/**
 * Ocean Lilly Tours - API Bridge
 * ==============================
 * Handles ALL communication between frontend and backend.
 * - Tries to fetch from backend API endpoints first
 * - Falls back to temporary .js data files if API returns any error
 *
 * FIXED: All endpoints now throw on non-OK responses so the catch
 *        block always runs and triggers the local-data fallback.
 */

const API_BASE_URL = window.location.hostname.includes('jerzy.lk')
  ? '/oceanlilly/backend_laravel/public/api'
  : '/api';

const API = {

  // ===== PACKAGES =====

  getPackages: async () => {
    try {
      const response = await fetch(`${API_BASE_URL}/packages`);
      if (!response.ok) throw new Error(`HTTP ${response.status}`);
      const data = await response.json();
      console.log('✅ Packages loaded from API');
      return Array.isArray(data) ? data : [];
    } catch (err) {
      console.warn('⚠️ Packages API error, using local data:', err.message);
      return window.packages || [];
    }
  },

  getPackage: async (id) => {
    try {
      const response = await fetch(`${API_BASE_URL}/packages/${id}`);
      if (!response.ok) throw new Error(`HTTP ${response.status}`);
      const data = await response.json();
      console.log(`✅ Package ${id} loaded from API`);
      return data;
    } catch (err) {
      console.warn(`⚠️ Package API error, using local data:`, err.message);
      const packages = window.packages || [];
      return packages.find(p => p.id === parseInt(id)) || null;
    }
  },

  getFeaturedPackages: async () => {
    try {
      const response = await fetch(`${API_BASE_URL}/packages?featured=true`);
      if (!response.ok) throw new Error(`HTTP ${response.status}`);
      const data = await response.json();
      console.log('✅ Featured packages loaded from API');
      return Array.isArray(data) ? data : [];
    } catch (err) {
      console.warn('⚠️ Featured packages API error, using local data:', err.message);
      return (window.packages || []).slice(0, 5);
    }
  },

  // ===== BLOG =====

  getBlog: async () => {
    try {
      const response = await fetch(`${API_BASE_URL}/blog`);
      if (!response.ok) throw new Error(`HTTP ${response.status}`);
      const data = await response.json();
      console.log('✅ Blog posts loaded from API');
      return Array.isArray(data) ? data : [];
    } catch (err) {
      console.warn('⚠️ Blog API error, using local data:', err.message);
      return window.blogPosts || [];
    }
  },

  getBlogPost: async (slug) => {
    try {
      const response = await fetch(`${API_BASE_URL}/blog?slug=${slug}`);
      if (!response.ok) throw new Error(`HTTP ${response.status}`);
      const data = await response.json();
      console.log(`✅ Blog post "${slug}" loaded from API`);
      return data;
    } catch (err) {
      console.warn(`⚠️ Blog post API error, using local data:`, err.message);
      const posts = window.blogPosts || [];
      return posts.find(p => p.slug === slug) || null;
    }
  },

  getFeaturedBlog: async () => {
    try {
      const response = await fetch(`${API_BASE_URL}/blog?featured=true`);
      if (!response.ok) throw new Error(`HTTP ${response.status}`);
      const data = await response.json();
      console.log('✅ Featured blog loaded from API');
      return Array.isArray(data) ? data.slice(0, 3) : [];
    } catch (err) {
      console.warn('⚠️ Featured blog API error, using local data:', err.message);
      return (window.blogPosts || []).slice(0, 3);
    }
  },

  // ===== SERVICES =====

  getServices: async () => {
    try {
      const response = await fetch(`${API_BASE_URL}/services`);
      if (!response.ok) throw new Error(`HTTP ${response.status}`);
      const data = await response.json();
      console.log('✅ Services loaded from API');
      return Array.isArray(data) ? data : [];
    } catch (err) {
      console.warn('⚠️ Services API error, using local data:', err.message);
      return window.services || [];
    }
  },

  // ===== GALLERY =====

  getGallery: async () => {
    try {
      const response = await fetch(`${API_BASE_URL}/gallery`);
      if (!response.ok) throw new Error(`HTTP ${response.status}`);
      const data = await response.json();
      console.log('✅ Gallery loaded from API');
      return Array.isArray(data) ? data : [];
    } catch (err) {
      console.warn('⚠️ Gallery API error, using local data:', err.message);
      return window.galleryImages || [];
    }
  },

  // ===== TESTIMONIALS =====

  getTestimonials: async () => {
    try {
      const response = await fetch(`${API_BASE_URL}/testimonials`);
      if (!response.ok) throw new Error(`HTTP ${response.status}`);
      const data = await response.json();
      console.log('✅ Testimonials loaded from API');
      return Array.isArray(data) ? data : [];
    } catch (err) {
      console.warn('⚠️ Testimonials API error, using local data:', err.message);
      return window.testimonials || [];
    }
  },

  // ===== PARTNERS =====

  getPartners: async () => {
    try {
      const response = await fetch(`${API_BASE_URL}/partners`);
      if (!response.ok) throw new Error(`HTTP ${response.status}`);
      const data = await response.json();
      console.log('✅ Partners loaded from API');
      return Array.isArray(data) ? data : [];
    } catch (err) {
      console.warn('⚠️ Partners API error, using local data:', err.message);
      return window.partners || [];
    }
  },

  // ===== HERO SLIDES =====

  getHeroSlides: async () => {
    try {
      const response = await fetch(`${API_BASE_URL}/hero-slides`);
      if (!response.ok) throw new Error(`HTTP ${response.status}`);
      const data = await response.json();
      console.log('✅ Hero slides loaded from API');
      return Array.isArray(data) ? data : [];
    } catch (err) {
      console.warn('⚠️ Hero slides API error, using local data:', err.message);
      return window.heroSlides || [];
    }
  },

  // ===== CONTACT FORM =====

  submitContact: async (data) => {
    try {
      const response = await fetch(`${API_BASE_URL}/contact`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
      });
      if (!response.ok) throw new Error(`HTTP ${response.status}`);
      console.log('✅ Contact form submitted successfully');
      return await response.json();
    } catch (err) {
      console.error('❌ Contact form submission failed:', err.message);
      return { success: false, message: 'Failed to submit form. Please try again.' };
    }
  },
};

window.API = API;
console.log('✅ api.js loaded — API bridge ready');
