// admin_script.js

document.addEventListener('DOMContentLoaded', function() {

    // --- Mobile Sidebar Toggle ---
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const sidebar = document.querySelector('.sidebar');
    if (mobileMenuBtn && sidebar) {
        mobileMenuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    }

    // --- NEW: Toast Notification Function ---
    function showToast(message, type = 'success') {
        const container = document.getElementById('toastContainer');
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.innerHTML = `<i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-times-circle'}"></i> ${message}`;
        container.appendChild(toast);
        setTimeout(() => {
            toast.remove();
        }, 5000);
    }

    // --- NEW: Custom Confirmation Modal Function ---
    const confirmModal = document.getElementById('confirmModal');
    const confirmTitle = document.getElementById('confirmTitle');
    const confirmMessage = document.getElementById('confirmMessage');
    const confirmBtn = document.getElementById('confirmBtn');
    const cancelBtn = document.getElementById('cancelBtn');

    function showConfirm(title, message, onConfirm) {
        confirmTitle.textContent = title;
        confirmMessage.textContent = message;
        confirmModal.classList.add('show');

        // Use .cloneNode(true) to remove old event listeners
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

    // --- Generic Form Modal Handling ---
    const modals = document.querySelectorAll('.modal');
    const closeBtns = document.querySelectorAll('.close-btn');

    closeBtns.forEach(btn => {
        btn.onclick = function() {
            btn.closest('.modal').style.display = "none";
        }
    });

    window.addEventListener('click', function(event) {
        modals.forEach(modal => {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });
    });
    
    // --- Package Management ---
    const packageModal = document.getElementById('packageModal');
    const addNewPackageBtn = document.getElementById('addNewPackageBtn');
    const packageForm = document.getElementById('packageForm');
    const packagesTableBody = document.getElementById('packagesTableBody');

    if (addNewPackageBtn) {
        addNewPackageBtn.onclick = function() {
            packageForm.reset();
            document.getElementById('modalTitle').innerText = 'Add New Package';
            document.getElementById('packageId').value = '';
            packageModal.style.display = "block";
        }
    }

    if (packageForm) {
        packageForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const packageId = formData.get('package_id');
            formData.append('action', packageId ? 'update_package' : 'add_package');

            fetch('operations.php', { method: 'POST', body: formData })
            .then(response => response.json())
            .then(data => {
                showToast(data.message, data.status);
                if (data.status === 'success') {
                    packageModal.style.display = "none";
                    setTimeout(() => location.reload(), 500);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }

    if (packagesTableBody) {
        packagesTableBody.addEventListener('click', function(e) {
            const target = e.target.closest('button');
            if (!target) return;

            const row = target.closest('tr');
            const id = row.dataset.id;

            if (target.classList.contains('edit-package-btn')) {
                const formData = new FormData();
                formData.append('action', 'get_package');
                formData.append('id', id);

                fetch('operations.php', { method: 'POST', body: formData })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const pkg = data.data;
                        document.getElementById('modalTitle').innerText = 'Edit Package';
                        document.getElementById('packageId').value = pkg.package_id;
                        document.getElementById('packageName').value = pkg.package_name;
                        document.getElementById('destination').value = pkg.destination;
                        document.getElementById('price').value = pkg.price;
                        document.getElementById('duration').value = pkg.duration;
                        document.getElementById('description').value = pkg.description;
                        packageModal.style.display = 'block';
                    } else {
                        showToast(data.message, 'error');
                    }
                });
            }

            if (target.classList.contains('delete-package-btn')) {
                showConfirm('Delete Package?', `Are you sure you want to delete package ID ${id}? This cannot be undone.`, () => {
                    const formData = new FormData();
                    formData.append('action', 'delete_package');
                    formData.append('id', id);

                    fetch('operations.php', { method: 'POST', body: formData })
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

    // --- User Management ---
    const usersTableBody = document.getElementById('usersTableBody');
    if (usersTableBody) {
        usersTableBody.addEventListener('click', function(e) {
            const target = e.target.closest('button.delete-user-btn');
            if (target) {
                const row = target.closest('tr');
                const id = row.dataset.id;
                showConfirm('Delete User?', `Are you sure you want to delete user ID ${id}? This will also delete their associated bookings.`, () => {
                    const formData = new FormData();
                    formData.append('action', 'delete_user');
                    formData.append('id', id);
                    fetch('operations.php', { method: 'POST', body: formData })
                    .then(response => response.json())
                    .then(data => {
                        showToast(data.message, data.status);
                        if(data.status === 'success') {
                            row.style.transition = 'opacity 0.5s';
                            row.style.opacity = '0';
                            setTimeout(() => row.remove(), 500);
                        }
                    });
                });
            }
        });
    }

    // --- Booking Management ---
    const bookingModal = document.getElementById('bookingModal');
    const bookingForm = document.getElementById('bookingForm');
    const bookingsTableBody = document.getElementById('bookingsTableBody');

    if (bookingsTableBody) {
        bookingsTableBody.addEventListener('click', function(e) {
            const target = e.target.closest('button');
            if (!target) return;

            const row = target.closest('tr');
            const id = row.dataset.id;

            if (target.classList.contains('edit-booking-btn')) {
                const formData = new FormData();
                formData.append('action', 'get_booking');
                formData.append('id', id);
                fetch('operations.php', { method: 'POST', body: formData })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const booking = data.data;
                        document.getElementById('bookingId').value = booking.bid;
                        document.getElementById('modalBookingId').innerText = booking.bid;
                        document.getElementById('modalCustomerName').innerText = booking.uname;
                        document.getElementById('modalPackageName').innerText = booking.package_name;
                        document.getElementById('bookingStatus').value = booking.status;
                        bookingModal.style.display = 'block';
                    } else {
                        showToast(data.message, 'error');
                    }
                });
            }
            
            if (target.classList.contains('delete-booking-btn')) {
                showConfirm('Delete Booking?', `Are you sure you want to delete booking ID ${id}?`, () => {
                    const formData = new FormData();
                    formData.append('action', 'delete_booking');
                    formData.append('id', id);
                     fetch('operations.php', { method: 'POST', body: formData })
                    .then(response => response.json())
                    .then(data => {
                        showToast(data.message, data.status);
                        if(data.status === 'success') {
                            row.style.transition = 'opacity 0.5s';
                            row.style.opacity = '0';
                            setTimeout(() => row.remove(), 500);
                        }
                    });
                });
            }
        });
    }
    
    if (bookingForm) {
        bookingForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            formData.append('action', 'update_booking_status');
            fetch('operations.php', { method: 'POST', body: formData })
            .then(response => response.json())
            .then(data => {
                showToast(data.message, data.status);
                if (data.status === 'success') {
                    bookingModal.style.display = "none";
                    setTimeout(() => location.reload(), 500);
                }
            });
        });
    }

    // --- Feedback Management ---
    const feedbackTableBody = document.getElementById('feedbackTableBody');
    if(feedbackTableBody) {
        feedbackTableBody.addEventListener('click', function(e) {
            const target = e.target.closest('button.delete-feedback-btn');
            if (target) {
                const row = target.closest('tr');
                const id = row.dataset.id;
                showConfirm('Delete Feedback?', `Are you sure you want to delete feedback ID ${id}?`, () => {
                    const formData = new FormData();
                    formData.append('action', 'delete_feedback');
                    formData.append('id', id);
                    fetch('operations.php', { method: 'POST', body: formData })
                    .then(response => response.json())
                    .then(data => {
                        showToast(data.message, data.status);
                        if(data.status === 'success') {
                            row.style.transition = 'opacity 0.5s';
                            row.style.opacity = '0';
                            setTimeout(() => row.remove(), 500);
                        }
                    });
                });
            }
        });
    }

    // --- Page Content Management ---
    const pageModal = document.getElementById('pageModal');
    const pageForm = document.getElementById('pageForm');
    const pagesTableBody = document.getElementById('pagesTableBody');

    if (pagesTableBody) {
        pagesTableBody.addEventListener('click', function(e) {
            const target = e.target.closest('button.edit-page-btn');
            if (target) {
                const row = target.closest('tr');
                const pageName = row.dataset.id;
                
                const formData = new FormData();
                formData.append('action', 'get_page_content');
                formData.append('page_name', pageName);

                fetch('operations.php', { method: 'POST', body: formData })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const page = data.data;
                        document.getElementById('pageModalTitle').innerText = `Edit ${page.title}`;
                        document.getElementById('pageName').value = page.page_name;
                        document.getElementById('pageTitle').value = page.title;
                        document.getElementById('pageContentBody').value = page.content_body;
                        pageModal.style.display = 'block';
                    } else {
                        showToast(data.message, 'error');
                    }
                });
            }
        });
    }

    if (pageForm) {
        pageForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            formData.append('action', 'update_page_content');
            fetch('operations.php', { method: 'POST', body: formData })
            .then(response => response.json())
            .then(data => {
                showToast(data.message, data.status);
                if (data.status === 'success') {
                    pageModal.style.display = "none";
                    setTimeout(() => location.reload(), 500);
                }
            });
        });
    }
});
