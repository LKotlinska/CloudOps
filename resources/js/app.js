import './bootstrap';

// Alert fade
document.addEventListener('DOMContentLoaded', () => {
    const alert = document.querySelector('.alert');
    if (alert) {
        setTimeout(() => alert.style.opacity = '0', 4000);
    }
});