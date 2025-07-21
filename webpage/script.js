document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('.header');
    const featureCards = document.querySelectorAll('.feature-card');

    // Add shadow to header on scroll
    window.addEventListener('scroll', () => {
        if (window.scrollY > 10) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // Intersection Observer for fade-in animations on scroll
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                // Add a delay based on the card's index for a staggered effect
                setTimeout(() => {
                    entry.target.classList.add('visible');
                }, index * 150);
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    featureCards.forEach(card => {
        observer.observe(card);
    });
    
    // Note: Mobile menu functionality is not implemented in this snippet
    // but the hamburger icon is present for layout purposes. A real implementation
    // would add a click event listener to the .menu-toggle element.
});
