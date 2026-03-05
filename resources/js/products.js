// ── CHIPS ──
document.querySelectorAll('.chip').forEach(chip => {
    chip.addEventListener('click', () => {
        const pressed = chip.getAttribute('aria-pressed') === 'true';
        chip.setAttribute('aria-pressed', String(!pressed));
        chip.classList.toggle('selected', !pressed);
    });
});

// ── CATEGORY TOGGLE (show/hide fields in form) ──
function toggleFields() {
    const cat = document.getElementById('prod-cat')?.value;
    const showLiquid = cat === 'eliquid' || cat === 'nicsalt';
    document.getElementById('field-nicotine').style.display = showLiquid ? '' : 'none';
    document.getElementById('field-volume').style.display   = showLiquid ? '' : 'none';
    document.getElementById('field-flavors').style.display  = showLiquid ? '' : 'none';
}

document.getElementById('prod-cat')?.addEventListener('change', toggleFields);