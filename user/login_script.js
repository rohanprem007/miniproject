// This script is for adding animations and interactivity to the login page.

document.addEventListener('DOMContentLoaded', function() {
    
    // Select the form wrapper
    const formWrapper = document.querySelector('.login-form-wrapper');

    // We can add a class to trigger animations after the page is loaded,
    // though the current CSS handles this with an animation-delay.
    // This is here for potential future use or more complex animations.
    if (formWrapper) {
        // Forcing a reflow can sometimes help ensure animations play correctly on load.
        void formWrapper.offsetWidth; 
    }

    // Example of future interactivity:
    // You could add form validation logic here.
    const loginForm = document.querySelector('.login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            // Since backend is not connected, we'll just log to the console for now.
            // In a real scenario, you'd let the form submit or handle it with AJAX.
            console.log('Form submitted!');
            
            // To prevent actual submission for this demo, uncomment the next line:
            // event.preventDefault(); 
        });
    }

});
