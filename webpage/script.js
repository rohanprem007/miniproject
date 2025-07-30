document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('.header');
    
    // Add shadow to header on scroll
    if (header) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 10) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    }

    // --- DROPDOWN FUNCTIONALITY ---
    const signInBtn = document.getElementById('signInBtn');
    const signInDropdown = document.getElementById('signInDropdown');

    if (signInBtn && signInDropdown) {
        signInBtn.addEventListener('mouseenter', function(event) {
            event.stopPropagation();
            signInDropdown.classList.toggle('show');
            signInBtn.classList.toggle('active');
        });

        window.addEventListener('click', function(event) {
            if (signInDropdown.classList.contains('show')) {
                if (!signInBtn.contains(event.target) && !signInDropdown.contains(event.target)) {
                    signInDropdown.classList.remove('show');
                    signInBtn.classList.remove('active');
                }
            }
        });
    }
});
