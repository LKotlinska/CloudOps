import './bootstrap';

// ── TOAST ──
let toastTimer;

function showToast(msg, type = 'green') {
    const t = document.getElementById('toast');
    if (!t) return;
    const colors = { green: 'var(--green)', red: 'var(--red)', amber: 'var(--amber)' };
    t.style.borderLeftColor = colors[type] || colors.green;
    t.textContent = msg;
    t.classList.add('show');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => t.classList.remove('show'), 3000);
}

// Show flash toast from session if present
document.addEventListener('DOMContentLoaded', () => {
    const alert = document.querySelector('.alert');
    if (alert) {
        setTimeout(() => alert.style.opacity = '0', 4000);
    }
});