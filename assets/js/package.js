 // Toggle Day Itinerary
    function toggleDay(element) {
        const content = element.querySelector('.day-content');
        content?.classList.toggle('hidden');
    }

    // Toggle FAQ
    function toggleFAQ(element) {
        const answer = element.querySelector('.faq-answer');
        answer?.classList.toggle('hidden');
    }

    // Form Submission
    function handleFormSubmit(e) {
        e.preventDefault();
        alert('Thank you for your inquiry! We will contact you within 24 hours.');
        e.target.reset();
    }