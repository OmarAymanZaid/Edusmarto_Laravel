// Toggles //////////////////////////////////////////////////////////////////////////////
document.addEventListener('DOMContentLoaded', () => {
    const toggles = {
        user: {
            button: document.getElementById('userToggle'),
            menu: document.getElementById('userDropdown'),
        },
        announcements: {
            button: document.getElementById('announcementToggle'),
            menu: document.getElementById('announcementDropdown'),
        },
        notifications: {
            button: document.getElementById('notificationToggle'),
            menu: document.getElementById('notificationDropdown'),
        },
    };

    function closeAllMenus() {
        Object.values(toggles).forEach(({ menu }) => menu.style.display = 'none');
    }

    function toggleMenu(menu) {
        const isVisible = menu.style.display === 'block';
        closeAllMenus();
        menu.style.display = isVisible ? 'none' : 'block';
    }

    toggles.user.button.addEventListener('click', () => toggleMenu(toggles.user.menu));
    toggles.announcements.button.addEventListener('click', () => toggleMenu(toggles.announcements.menu));
    toggles.notifications.button.addEventListener('click', () => toggleMenu(toggles.notifications.menu));

    // Close on outside click
    document.addEventListener('click', (e) => {
        const isClickInside = Object.values(toggles).some(({ button, menu }) =>
            button.contains(e.target) || menu.contains(e.target)
        );

        if (!isClickInside) {
            closeAllMenus();
        }
    });
});

// Delete Pop-up Modal ///////////////////////////////////////////////////////////////////////
document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('globalDeleteModal');
        const cancelBtn = document.getElementById('modalCancel');
        const confirmBtn = document.getElementById('modalConfirm');
        const message = document.getElementById('modalMessage');
        let currentForm = null;

        // Open modal
        document.querySelectorAll('.open-delete-modal').forEach(button => {
            button.addEventListener('click', () => {
                const formSelector = button.dataset.form;
                const name = button.dataset.name || 'this item';
                currentForm = document.querySelector(formSelector);

                message.textContent = `Are you sure you want to delete ${name}?`;
                modal.classList.add('show');
            });
        });

        // Cancel
        cancelBtn.addEventListener('click', () => {
            modal.classList.remove('show');
            currentForm = null;
        });

        // Confirm
        confirmBtn.addEventListener('click', () => {
            if (currentForm) currentForm.submit();
        });
});

//DismissNotification///////////////////////////////////////////////////////////////
        function dismissNotification(button, id) {
          const url  = button.dataset.url;
          const token = document.querySelector('meta[name="csrf-token"]').content;  

          fetch(url, {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': token,
              'Accept': 'application/json',
              'X-Requested-With': 'XMLHttpRequest',
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({})
          })
          .then(async response => {
            if (response.ok) {
              const el = document.getElementById(`notification-${id}`);
              if (el) {
                // small fade + slide animation
                el.style.transition = 'opacity 200ms ease, transform 200ms ease';
                el.style.opacity = 0;
                el.style.transform = 'translateX(12px)';
                setTimeout(() => el.remove(), 220);
              }
            } else {
              const payload = await response.json().catch(() => null);
              console.error('Dismiss failed', response.status, payload);
              alert(payload?.error || 'Could not dismiss notification.');
            }
          })
          .catch(err => {
            console.error('Network error', err);
            alert('Network error. Try again.');
          });
        }
