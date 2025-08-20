// user/user_script.js
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const sidebar = document.querySelector('.sidebar');

    if (mobileMenuBtn && sidebar) {
        mobileMenuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    }

    // --- Custom Toast Notification Function ---
    function showToast(message, type = 'success') {
        const container = document.getElementById('toastContainer');
        if (!container) return;
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.innerHTML = `<i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-times-circle'}"></i> ${message}`;
        container.appendChild(toast);
        setTimeout(() => {
            toast.remove();
        }, 5000);
    }

    // --- Custom Confirmation Modal Function ---
    const confirmModal = document.getElementById('confirmModal');
    const confirmTitle = document.getElementById('confirmTitle');
    const confirmMessage = document.getElementById('confirmMessage');
    const confirmBtn = document.getElementById('confirmBtn');
    const cancelBtn = document.getElementById('cancelBtn');

    function showConfirm(title, message, onConfirm) {
        if (!confirmModal) return; 
        confirmTitle.textContent = title;
        confirmMessage.textContent = message;
        confirmModal.classList.add('show');
        const newConfirmBtn = confirmBtn.cloneNode(true);
        confirmBtn.parentNode.replaceChild(newConfirmBtn, confirmBtn);
        const newCancelBtn = cancelBtn.cloneNode(true);
        cancelBtn.parentNode.replaceChild(newCancelBtn, cancelBtn);
        newConfirmBtn.onclick = () => {
            confirmModal.classList.remove('show');
            onConfirm();
        };
        newCancelBtn.onclick = () => {
            confirmModal.classList.remove('show');
        };
    }

    // --- Booking Deletion Logic ---
    const bookingsTableBody = document.getElementById('bookingsTableBody');
    if (bookingsTableBody) {
        bookingsTableBody.addEventListener('click', function(e) {
            const target = e.target.closest('button.delete-booking-btn');
            if (target) {
                const row = target.closest('tr');
                const id = row.dataset.id;
                showConfirm('Delete Booking?', 'Are you sure you want to permanently delete this booking?', () => {
                    const formData = new FormData();
                    formData.append('action', 'delete_booking');
                    formData.append('booking_id', id);
                    fetch('user_operations.php', { method: 'POST', body: formData })
                    .then(response => response.json())
                    .then(data => {
                        showToast(data.message, data.status);
                        if (data.status === 'success') {
                           row.style.transition = 'opacity 0.5s';
                           row.style.opacity = '0';
                           setTimeout(() => row.remove(), 500);
                        }
                    });
                });
            }
        });
    }

    // --- Package Booking Logic ---
    const packageGrid = document.getElementById('packageGrid');
    if (packageGrid) {
        packageGrid.addEventListener('click', function(e) {
            const target = e.target.closest('button.book-now-btn');
            if (target) {
                const packageId = target.dataset.packageId;
                showConfirm('Confirm Booking', 'Are you sure you want to book this package?', () => {
                    const formData = new FormData();
                    formData.append('action', 'book_package');
                    formData.append('package_id', packageId);
                    fetch('user_operations.php', { method: 'POST', body: formData })
                    .then(response => response.json())
                    .then(data => {
                        showToast(data.message, data.status);
                    });
                });
            }
        });
    }

    // --- Payment Form Submission Logic ---
    const paymentForm = document.getElementById('paymentForm');
    if (paymentForm) {
        paymentForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            formData.append('action', 'submit_payment');
            if (!formData.get('cardholder_name') || !formData.get('card_number') || !formData.get('expiry_date') || !formData.get('cvc')) {
                showToast('Please fill in all card details.', 'error');
                return;
            }
            showConfirm('Confirm Payment', 'Are you sure you want to proceed with the payment?', () => {
                fetch('user_operations.php', { method: 'POST', body: formData })
                .then(response => response.json())
                .then(data => {
                    showToast(data.message, data.status);
                    if (data.status === 'success') {
                        setTimeout(() => { window.location.href = 'my_bookings.php'; }, 2000);
                    }
                });
            });
        });
    }

    // --- NEW: Feedback Form Submission Logic ---
    const feedbackForm = document.getElementById('feedbackForm');
    if (feedbackForm) {
        feedbackForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            formData.append('action', 'submit_feedback');

            fetch('user_operations.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                showToast(data.message, data.status);
                if (data.status === 'success') {
                    feedbackForm.reset();
                }
            });
        });
    }
});
