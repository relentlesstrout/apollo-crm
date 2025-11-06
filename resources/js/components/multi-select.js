/**
 * Multi-Select Component
 * Initializes a multi-select dropdown with search, select all, and clear all functionality
 */
export function initMultiSelect(containerId) {
    const container = document.getElementById(containerId);
    if (!container) return;

    const btn = container.querySelector('.multiselect-btn');
    const dropdown = container.querySelector('.multiselect-dropdown');
    const searchInput = container.querySelector('.search-input');
    const optionItems = container.querySelectorAll('.option-item');
    const checkboxes = container.querySelectorAll('.option-checkbox');
    const selectedCount = container.querySelector('.selected-count');
    const chevron = container.querySelector('.chevron');
    const clearAllBtn = container.querySelector('.clear-all');
    const selectAllBtn = container.querySelector('.select-all');

    let isOpen = false;

    function toggleDropdown() {
        isOpen = !isOpen;
        if (isOpen) {
            dropdown.style.display = 'block';
            setTimeout(() => {
                dropdown.classList.remove('opacity-0', 'scale-95');
                dropdown.classList.add('opacity-100', 'scale-100');
                dropdown.classList.remove('pointer-events-none');
            }, 10);
            chevron.style.transform = 'rotate(180deg)';
        } else {
            dropdown.classList.remove('opacity-100', 'scale-100');
            dropdown.classList.add('opacity-0', 'scale-95');
            dropdown.classList.add('pointer-events-none');
            chevron.style.transform = 'rotate(0deg)';
            setTimeout(() => {
                dropdown.style.display = 'none';
            }, 200);
        }
    }

    function updateSelectedCount() {
        const count = Array.from(checkboxes).filter(cb => cb.checked).length;
        if (count > 0) {
            selectedCount.textContent = count;
            selectedCount.style.display = 'inline-block';
        } else {
            selectedCount.style.display = 'none';
        }
    }

    function filterOptions() {
        const searchTerm = searchInput.value.toLowerCase();
        optionItems.forEach(item => {
            const text = item.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    }

    // Initialize selected count on page load
    updateSelectedCount();

    btn.addEventListener('click', (e) => {
        e.stopPropagation();
        toggleDropdown();
    });

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectedCount);
    });

    searchInput.addEventListener('input', filterOptions);

    clearAllBtn.addEventListener('click', () => {
        checkboxes.forEach(cb => cb.checked = false);
        updateSelectedCount();
    });

    selectAllBtn.addEventListener('click', () => {
        optionItems.forEach(item => {
            if (item.style.display !== 'none') {
                item.querySelector('.option-checkbox').checked = true;
            }
        });
        updateSelectedCount();
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
        if (!container.contains(e.target) && isOpen) {
            toggleDropdown();
        }
    });

    // Prevent dropdown from closing when clicking inside
    dropdown.addEventListener('click', (e) => {
        e.stopPropagation();
    });
}

/**
 * Dependent Multi-Select Component
 * Creates a parent-child relationship between two multi-selects where the child options
 * are filtered based on the parent selections.
 *
 * @param {string} parentContainerId - ID of the parent multi-select container
 * @param {string} childContainerId - ID of the child multi-select container
 * @param {Object} options - Configuration options
 * @param {boolean} options.uncheckHidden - Whether to uncheck child options when they become hidden (default: true)
 * @param {boolean} options.showAllWhenEmpty - Whether to show all child options when no parent is selected (default: true)
 *
 * Usage:
 * Add data-parent-values attribute to child option items with JSON array of parent values.
 * Example: <div class="option-item" data-parent-values='["value1","value2"]'>
 */
export function initDependentMultiSelect(parentContainerId, childContainerId, options = {}) {
    const defaults = {
        uncheckHidden: true,
        showAllWhenEmpty: true
    };

    const config = { ...defaults, ...options };

    const parentContainer = document.getElementById(parentContainerId);
    const childContainer = document.getElementById(childContainerId);

    if (!parentContainer || !childContainer) {
        console.error('Parent or child container not found');
        return;
    }

    const parentCheckboxes = parentContainer.querySelectorAll('.option-checkbox');
    const childOptionItems = childContainer.querySelectorAll('.option-item');
    const childCheckboxes = childContainer.querySelectorAll('.option-checkbox');

    function filterChildOptions() {
        // Get selected parent values
        const selectedParentValues = Array.from(parentCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);

        // If no parent selected, show all or hide all based on config
        if (selectedParentValues.length === 0) {
            childOptionItems.forEach(item => {
                if (config.showAllWhenEmpty) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                    if (config.uncheckHidden) {
                        const checkbox = item.querySelector('.option-checkbox');
                        if (checkbox) checkbox.checked = false;
                    }
                }
            });
            updateChildSelectedCount();
            return;
        }

        // Filter child options based on parent selections
        childOptionItems.forEach(item => {
            const parentValuesAttr = item.getAttribute('data-parent-values');

            // If no data-parent-values attribute, always show the option
            if (!parentValuesAttr) {
                item.style.display = 'flex';
                return;
            }

            try {
                const parentValues = JSON.parse(parentValuesAttr);

                // Show if any selected parent value matches
                const shouldShow = parentValues.some(val =>
                    selectedParentValues.includes(val)
                );

                if (shouldShow) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                    // Uncheck if hidden and config says so
                    if (config.uncheckHidden) {
                        const checkbox = item.querySelector('.option-checkbox');
                        if (checkbox) checkbox.checked = false;
                    }
                }
            } catch (e) {
                console.error('Invalid data-parent-values JSON:', parentValuesAttr);
                item.style.display = 'flex'; // Show by default if invalid
            }
        });

        updateChildSelectedCount();
    }

    function updateChildSelectedCount() {
        const selectedCount = childContainer.querySelector('.selected-count');
        if (!selectedCount) return;

        const count = Array.from(childCheckboxes).filter(cb => cb.checked).length;
        if (count > 0) {
            selectedCount.textContent = count;
            selectedCount.style.display = 'inline-block';
        } else {
            selectedCount.style.display = 'none';
        }
    }

    // Listen to parent checkbox changes
    parentCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', filterChildOptions);
    });

    // Also listen to parent's clear all and select all buttons
    const parentClearAll = parentContainer.querySelector('.clear-all');
    const parentSelectAll = parentContainer.querySelector('.select-all');

    if (parentClearAll) {
        parentClearAll.addEventListener('click', () => {
            setTimeout(filterChildOptions, 0); // Delay to let checkboxes update
        });
    }

    if (parentSelectAll) {
        parentSelectAll.addEventListener('click', () => {
            setTimeout(filterChildOptions, 0); // Delay to let checkboxes update
        });
    }

    // Initial filter on page load
    filterChildOptions();
}