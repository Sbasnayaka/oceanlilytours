const contactForm = document.getElementById('contact-form');
const submitBtn = document.getElementById('submit-btn');
const formMessage = document.getElementById('form-message');

function showMessage(message, isError = false) {
  formMessage.textContent = message;
  formMessage.className = `${isError ? 'bg-red-100 text-red-700 border border-red-300' : 'bg-green-100 text-green-700 border border-green-300'} p-4 rounded-lg`;
  formMessage.classList.remove('hidden');
  
  if (!isError) {
    setTimeout(() => {
      contactForm.reset();
      formMessage.classList.add('hidden');
    }, 3000);
  }
}

async function handleFormSubmit(e) {
  e.preventDefault();
  
  submitBtn.disabled = true;
  submitBtn.textContent = 'Sending...';
  
  try {
    const formData = {
      name: document.getElementById('name').value,
      email: document.getElementById('email').value,
      phone: document.getElementById('phone').value,
      subject: document.getElementById('subject').value,
      message: document.getElementById('message').value
    };
    
    const result = await API.submitContact(formData);
    
    if (result.success || result.status === 'sent') {
      showMessage('Thank you! Your message has been sent. We\'ll get back to you soon.', false);
    } else {
      showMessage(result.message || 'Error sending message. Please try again.', true);
    }
  } catch (error) {
    console.error('Contact form error:', error);
    showMessage('Error sending message. Please try again later.', true);
  } finally {
    submitBtn.disabled = false;
    submitBtn.textContent = 'Send Message';
  }
}

contactForm.addEventListener('submit', handleFormSubmit);
