/**
 * Toggle Switch Component
 * Initializes a button-style toggle switch with smooth transitions
 */
export function initToggleSwitch(toggleId) {
    const checkbox = document.getElementById(toggleId);
    if (!checkbox) return;

    const label = checkbox.closest('label');
    const spans = label.querySelectorAll('span');

    checkbox.addEventListener('change', function() {
        if (this.checked) {
            // Checked state - highlight second button (active label)
            spans[0].classList.remove('bg-blue-200', 'text-gray-800');
            spans[0].classList.add('text-gray-600', 'bg-transparent');
            spans[1].classList.remove('text-gray-600', 'bg-transparent');
            spans[1].classList.add('bg-blue-200', 'text-gray-800');
        } else {
            // Unchecked state - highlight first button (inactive label)
            spans[0].classList.remove('text-gray-600', 'bg-transparent');
            spans[0].classList.add('bg-blue-200', 'text-gray-800');
            spans[1].classList.remove('bg-blue-200', 'text-gray-800');
            spans[1].classList.add('text-gray-600', 'bg-transparent');
        }
    });
}