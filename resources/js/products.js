// ── CHIPS ──
document.querySelectorAll(".chip").forEach((chip) => {
    chip.addEventListener("click", () => {
        const pressed = chip.getAttribute("aria-pressed") === "true";
        chip.setAttribute("aria-pressed", String(!pressed));
        chip.classList.toggle("selected", !pressed);
    });
});

// ── CLICKABLE ROWS ──
document.querySelectorAll('.clickable-row').forEach(row => {
    row.addEventListener('click', e => {
        if (!e.target.closest('a, button, form')) {
            window.location = row.dataset.href;
        }
    });
});

// ── VAPE FIELDS TOGGLE (create / edit) ──
document.addEventListener('DOMContentLoaded', () => {
    const select = document.getElementById('category_id');
    if (!select) return;

    select.addEventListener('change', toggleVapeFields);
    toggleVapeFields();
});

function toggleVapeFields() {
    const select = document.getElementById('category_id');
    const vapeFields = document.getElementById('vape-fields');
    if (!select || !vapeFields) return;

    const isVape = select.options[select.selectedIndex].text.toLowerCase() === 'vape';

    vapeFields.style.display = isVape ? 'block' : 'none';

    // Fields need to be disabled, so we don't send them when category isn't vape
    vapeFields.querySelectorAll('input, select').forEach(field => {
        field.disabled = !isVape;
    });
}
