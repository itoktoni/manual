import './bootstrap';
import Swal from 'sweetalert2';

// Global functions for user data page
function confirmDelete(url, name) {
    Swal.fire({
        title: 'Are you sure?',
        text: `You are about to delete user "${name}". This action cannot be undone!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}

function confirmBulkDelete() {
    const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
    if (checkedBoxes.length === 0) {
        Swal.fire('No Selection', 'Please select at least one user to delete.', 'warning');
        return;
    }

    const ids = Array.from(checkedBoxes).map(cb => cb.value);
    const count = ids.length;

    Swal.fire({
        title: 'Are you sure?',
        text: `You are about to delete ${count} user(s). This action cannot be undone!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete them!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('bulk-delete-ids').value = ids.join(',');
            document.getElementById('bulk-delete-form').submit();
        }
    });
}

// Make functions global
window.confirmDelete = confirmDelete;
window.confirmBulkDelete = confirmBulkDelete;

// Show success message if exists
const successElement = document.getElementById('success-message');
if (successElement && successElement.dataset.message) {
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: successElement.dataset.message,
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => {
            const timer = Swal.getTimerLeft();
            const progressBar = Swal.getTimerProgressBar();
            if (progressBar) {
                progressBar.style.display = 'block';
            }
            setTimeout(() => {
                Swal.close();
            }, 2000);
        }
    });
}
document.addEventListener('DOMContentLoaded', function() {

    // Checkbox functionality
    const checkAlls = document.querySelectorAll('.checkall');
    const checkboxes = document.querySelectorAll('.row-checkbox');
    const bulkDeleteBtn = document.getElementById('bulk-delete-btn');

    checkAlls.forEach(checkAll => {
        checkAll.addEventListener('change', function() {
            checkboxes.forEach(cb => cb.checked = this.checked);
            updateBulkDeleteButton();
        });
    });

    // Update check all state based on individual checkboxes
    checkboxes.forEach(cb => {
        cb.addEventListener('change', function() {
            const allChecked = Array.from(checkboxes).every(c => c.checked);
            const someChecked = Array.from(checkboxes).some(c => c.checked);
            checkAlls.forEach(checkAll => {
                checkAll.checked = allChecked;
                checkAll.indeterminate = someChecked && !allChecked;
            });
            updateBulkDeleteButton();
        });
    });

    function updateBulkDeleteButton() {
        if (bulkDeleteBtn) {
            const checkedCount = document.querySelectorAll('.row-checkbox:checked').length;
            bulkDeleteBtn.disabled = checkedCount === 0;
            bulkDeleteBtn.classList.toggle('disabled', checkedCount === 0);
        }
    }

    // Sidebar and menu functionality
    let sidebarOpen = false;
    let selectedMenu = "system";

    document.querySelectorAll(".nav-item").forEach((item) => {
        item.addEventListener("click", function(e) {
            // Get the href attribute from the clicked item
            const href = this.getAttribute("href");

            // If a real href exists (and it's not just "#"),
            // stop this function and let the link navigate normally.
            if (href && href !== "#") {
                return;
            }

            // --- The rest of the code only runs if there is no href ---

            // Prevent the default action (like jumping to the top for href="#")
            e.preventDefault();

            const menuId = this.getAttribute("data-menu");
            selectedMenu = menuId;

            // Update active class
            document
                .querySelectorAll(".nav-item")
                .forEach((nav) => nav.classList.remove("active"));
            this.classList.add("active");

            // Hide all sub-menus
            document
                .querySelectorAll(".sub-menu")
                .forEach((sub) => (sub.style.display = "none"));

            // Show selected sub-menu
            const subMenu = document.getElementById(menuId + "-submenu");
            if (subMenu) {
                subMenu.style.display = "block";
            }
        });
    });

    // Mobile menu toggle
    document
        .getElementById("mobile-menu-button")
        .addEventListener("click", function() {
            sidebarOpen = !sidebarOpen;
            const sidebar = document.getElementById("sidebar-container");
            sidebar.classList.toggle("open", sidebarOpen);
            document
                .getElementById("overlay")
                .classList.toggle("active", sidebarOpen);
        });

    // Overlay click to close
    document.getElementById("overlay").addEventListener("click", function() {
        sidebarOpen = false;
        document.getElementById("sidebar-container").classList.remove("open");
        this.classList.remove("active");
    });

    // Profile dropdown toggle
    document
        .getElementById("profile-icon")
        .addEventListener("click", function() {
            const dropdown = document.getElementById("profile-dropdown");
            dropdown.classList.toggle("active");
            document
                .getElementById("notification-drawer")
                .classList.remove("open");
        });

    // Notification toggle
    document
        .getElementById("notification-icon")
        .addEventListener("click", function() {
            const drawer = document.getElementById("notification-drawer");
            drawer.classList.toggle("open");
            document
                .getElementById("profile-dropdown")
                .classList.remove("active");
        });

    // Close notification drawer
    document
        .querySelector(".notification-close")
        .addEventListener("click", function() {
            document
                .getElementById("notification-drawer")
                .classList.remove("open");
        });

    // Close on outside click
    document.addEventListener("click", function(e) {
        if (!e.target.closest(".profile-icon")) {
            document
                .getElementById("profile-dropdown")
                .classList.remove("active");
        }
        if (
            !e.target.closest(".notification-icon") &&
            !e.target.closest(".notification-drawer")
        ) {
            document
                .getElementById("notification-drawer")
                .classList.remove("open");
        }
    });

    // Filter toggle functionality
    let filtersVisible = true;
    const toggleButton = document.getElementById('toggle-filters');
    if (toggleButton) {
        toggleButton.addEventListener('click', function() {
            filtersVisible = !filtersVisible;
            const form = document.getElementById('filter-form');
            const buttonText = this.querySelector('span');
            if (filtersVisible) {
                form.style.display = 'block';
                buttonText.textContent = 'Hide';
            } else {
                form.style.display = 'none';
                buttonText.textContent = 'Show';
            }
        });
    }

    // Handle perpage change
    const perpageSelect = document.getElementById('perpage-select');
    if (perpageSelect) {
        perpageSelect.addEventListener('change', function() {
            const url = new URL(window.location);
            url.searchParams.set('perpage', this.value);
            window.location.href = url.toString();
        });
    }

    // Custom Select Functionality
    document.querySelectorAll('.custom-select-wrapper').forEach(function(wrapper) {
        const input = wrapper.querySelector('.custom-select-input');
        const dropdown = wrapper.querySelector('.custom-select-dropdown');
        const searchInput = wrapper.querySelector('.custom-select-search');
        const options = wrapper.querySelectorAll('.custom-select-option');
        const hiddenContainer = wrapper.querySelector('.custom-select-hidden-inputs');
        const hiddenInput = wrapper.querySelector('input[type="hidden"]');
        const placeholder = wrapper.querySelector('.custom-select-placeholder');
        const isMultiple = wrapper.dataset.multiple === 'true';

        let selectedValues = [];
        let selectedTexts = [];

        // Initialize selected values
        options.forEach(option => {
            if (option.dataset.selected === 'true') {
                const value = option.dataset.value;
                const text = option.textContent.trim();
                selectedValues.push(value);
                selectedTexts.push(text);
                option.classList.add('selected');
            }
        });

        updateDisplay();

        // Toggle dropdown
        input.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const isOpen = dropdown.style.display === 'block';
            closeAllDropdowns();
            if (!isOpen) {
                dropdown.style.display = 'block';
                input.classList.add('open');
                if (searchInput) {
                    searchInput.value = '';
                    searchInput.focus();
                }
                // Show all options
                options.forEach(option => option.style.display = 'block');
            }
        });

        // Search functionality
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                options.forEach(option => {
                    const text = option.textContent.toLowerCase();
                    option.style.display = text.includes(searchTerm) ? 'block' : 'none';
                });
            });
        }

        // Option selection
        options.forEach(option => {
            option.addEventListener('click', function() {
                const value = this.dataset.value;
                const text = this.textContent.trim();
                if (value === '') return; // Don't select placeholder option

                if (isMultiple) {
                    const index = selectedValues.indexOf(value);
                    if (index > -1) {
                        // Remove
                        selectedValues.splice(index, 1);
                        selectedTexts.splice(index, 1);
                        this.classList.remove('selected');
                    } else {
                        // Add
                        selectedValues.push(value);
                        selectedTexts.push(text);
                        this.classList.add('selected');
                    }
                } else {
                    // Single select
                    selectedValues = [value];
                    selectedTexts = [text];
                    options.forEach(opt => opt.classList.remove('selected'));
                    this.classList.add('selected');
                    closeAllDropdowns();
                }

                updateDisplay();
            });
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!wrapper.contains(e.target)) {
                closeAllDropdowns();
            }
        });

        function updateDisplay() {
            const selectedItemsContainer = wrapper.querySelector('.custom-select-selected-items');
            if (isMultiple) {
                if (selectedTexts.length > 0) {
                    placeholder.textContent = `${selectedTexts.length} selected`;
                    placeholder.classList.remove('empty');
                    if (selectedItemsContainer) {
                        selectedItemsContainer.innerHTML = selectedTexts.map(text => `<span class="custom-select-tag">${text} <span class="custom-select-tag-remove" data-value="${selectedValues[selectedTexts.indexOf(text)]}">×</span></span>`).join('');
                    }
                } else {
                    placeholder.textContent = wrapper.querySelector('.custom-select-placeholder').dataset.placeholder || 'Select options';
                    placeholder.classList.add('empty');
                    if (selectedItemsContainer) {
                        selectedItemsContainer.innerHTML = '';
                    }
                }
            } else {
                placeholder.textContent = selectedTexts.length > 0 ? selectedTexts[0] : (wrapper.querySelector('.custom-select-placeholder').dataset.placeholder || 'Select an option');
                placeholder.classList.toggle('empty', selectedTexts.length === 0);
            }

            if (isMultiple) {
                if (hiddenContainer) {
                    hiddenContainer.innerHTML = '';
                    selectedValues.forEach(value => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = hiddenContainer.dataset.name;
                        input.value = value;
                        hiddenContainer.appendChild(input);
                    });
                }
            } else {
                if (hiddenInput) {
                    hiddenInput.value = selectedValues[0] || '';
                }
            }
        }

        // Handle tag removal for multiple select
        if (isMultiple) {
            const selectedItemsContainer = wrapper.querySelector('.custom-select-selected-items');
            if (selectedItemsContainer) {
                selectedItemsContainer.addEventListener('click', function(e) {
                    if (e.target.classList.contains('custom-select-tag-remove')) {
                        e.stopPropagation();
                        const value = e.target.dataset.value;
                        const index = selectedValues.indexOf(value);
                        if (index > -1) {
                            selectedValues.splice(index, 1);
                            selectedTexts.splice(index, 1);
                            wrapper.querySelector(`[data-value="${value}"]`).classList.remove('selected');
                            updateDisplay();
                        }
                    }
                });
            }
        }
    });

    function closeAllDropdowns() {
        document.querySelectorAll('.custom-select-dropdown').forEach(d => {
            d.style.display = 'none';
            d.closest('.custom-select-wrapper').querySelector('.custom-select-input').classList.remove('open');
        });
    }

    // Image popup cursor styling
    const popupImages = document.querySelectorAll('.image-popup-cursor');
    popupImages.forEach(img => {
        img.style.cursor = 'pointer';
        img.title = 'Click to enlarge';
    });
});

// Image popup functionality (global function)
window.showImagePopup = function(src, title, maxWidth, maxHeight) {
    // Create overlay
    const overlay = document.createElement('div');
    overlay.className = 'image-popup-overlay';
    overlay.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        cursor: pointer;
    `;

    // Create image container
    const container = document.createElement('div');
    container.style.cssText = `
        position: relative;
        max-width: 90vw;
        max-height: 90vh;
        display: flex;
        flex-direction: column;
        align-items: center;
    `;

    // Create title
    const titleElement = document.createElement('div');
    titleElement.textContent = title;
    titleElement.style.cssText = `
        color: white;
        font-size: 16px;
        margin-bottom: 10px;
        text-align: center;
    `;

    // Create image
    const img = document.createElement('img');
    img.src = src;
    img.alt = title;
    img.style.cssText = `
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    `;

    // Set max dimensions if provided
    if (maxWidth) {
        img.style.maxWidth = maxWidth + 'px';
    }
    if (maxHeight) {
        img.style.maxHeight = maxHeight + 'px';
    }

    // Create close button
    const closeButton = document.createElement('button');
    closeButton.innerHTML = '×';
    closeButton.style.cssText = `
        position: absolute;
        top: -15px;
        right: -15px;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: none;
        font-size: 20px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    `;

    // Add event listeners
    overlay.addEventListener('click', function(e) {
        if (e.target === overlay) {
            document.body.removeChild(overlay);
        }
    });

    closeButton.addEventListener('click', function() {
        document.body.removeChild(overlay);
    });

    // Add escape key listener
    const escapeHandler = function(e) {
        if (e.key === 'Escape') {
            document.body.removeChild(overlay);
            document.removeEventListener('keydown', escapeHandler);
        }
    };
    document.addEventListener('keydown', escapeHandler);

    // Assemble popup
    container.appendChild(titleElement);
    container.appendChild(closeButton);
    container.appendChild(img);
    overlay.appendChild(container);

    // Add to body
    document.body.appendChild(overlay);

    // Focus management for accessibility
    closeButton.focus();
};
