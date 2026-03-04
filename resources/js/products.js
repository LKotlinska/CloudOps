const PRODUCTS = window.PRODUCTS ?? [];
const BRANDS   = window.BRANDS   ?? [];
const FLAVORS  = window.FLAVORS  ?? [];
const COLORS   = window.COLORS   ?? [];

const ICONS         = { vape:'🌬️', eliquid:'💧', nicsalt:'⚗️', accessory:'🔋' };
const BADGE_CLASSES = { vape:'badge-vape', eliquid:'badge-eliquid', nicsalt:'badge-nicsalt', accessory:'badge-accessory' };
const CAT_LABELS    = { vape:'Vape', eliquid:'E-liquid', nicsalt:'Nic Salt', accessory:'Accessory' };

const PER_PAGE = 10;
let currentPage = 1;
let filteredProducts = [...PRODUCTS];

// ── RENDER TABLE ──
function renderTable(products) {
    const start = (currentPage - 1) * PER_PAGE;
    const page  = products.slice(start, start + PER_PAGE);
    const tbody = document.getElementById('product-tbody');

    tbody.innerHTML = page.map(p => {
        const stockClass = p.stock === 0 ? 'stock-out' : p.stock < 10 ? 'stock-low' : 'stock-ok';
        const stockText  = p.stock === 0 ? 'Out of stock' : p.stock < 10 ? `${p.stock} (low)` : p.stock;
        const brandName  = p.brand?.name ?? '—';
        return `
            <tr>
                <td>
                    <div class="product-cell">
                        <div class="product-thumb" aria-hidden="true">${ICONS[p.cat] ?? '📦'}</div>
                        <div>
                            <div class="product-name">${p.name}</div>
                            <div class="product-sku">${p.sku}</div>
                        </div>
                    </div>
                </td>
                <td><span class="badge ${BADGE_CLASSES[p.cat]}">${CAT_LABELS[p.cat]}</span></td>
                <td style="color:var(--text2)">${brandName}</td>
                <td>${p.price} kr</td>
                <td class="${stockClass}" aria-label="Stock: ${stockText}">${stockText}</td>
                <td>
                    <span style="display:flex;align-items:center;gap:6px;">
                        <span class="status-dot ${p.active ? 'active' : 'inactive'}" aria-hidden="true"></span>
                        <span style="font-size:12px;color:var(--text2)">${p.active ? 'Active' : 'Inactive'}</span>
                    </span>
                </td>
                <td>
                    <div style="display:flex;gap:6px">
                        <button class="btn btn-ghost btn-sm" data-action="edit" data-id="${p.id}" aria-label="Edit ${p.name}">✎ Edit</button>
                        <button class="btn btn-danger btn-sm" data-action="delete" data-id="${p.id}" data-name="${p.name}" aria-label="Delete ${p.name}">✕</button>
                    </div>
                </td>
            </tr>
        `;
    }).join('');

    renderPagination(products.length);
}

// ── PAGINATION ──
function renderPagination(total) {
    const totalPages = Math.ceil(total / PER_PAGE);
    const start = Math.min((currentPage - 1) * PER_PAGE + 1, total);
    const end   = Math.min(currentPage * PER_PAGE, total);

    document.getElementById('pagination-info').textContent =
        total === 0 ? 'No products found' : `Showing ${start}–${end} of ${total} products`;

    const btns = document.getElementById('pagination-btns');
    btns.innerHTML = '';

    const prev = document.createElement('button');
    prev.className = 'page-btn';
    prev.setAttribute('aria-label', 'Previous page');
    prev.textContent = '‹';
    prev.disabled = currentPage === 1;
    prev.addEventListener('click', () => { currentPage--; renderTable(filteredProducts); });
    btns.appendChild(prev);

    for (let i = 1; i <= totalPages; i++) {
        const btn = document.createElement('button');
        btn.className = 'page-btn' + (i === currentPage ? ' active' : '');
        btn.textContent = i;
        if (i === currentPage) btn.setAttribute('aria-current', 'page');
        btn.addEventListener('click', () => { currentPage = i; renderTable(filteredProducts); });
        btns.appendChild(btn);
    }

    const next = document.createElement('button');
    next.className = 'page-btn';
    next.setAttribute('aria-label', 'Next page');
    next.textContent = '›';
    next.disabled = currentPage === totalPages;
    next.addEventListener('click', () => { currentPage++; renderTable(filteredProducts); });
    btns.appendChild(next);
}

// ── FILTERS ──
function applyFilters() {
    const search    = document.getElementById('search').value.toLowerCase();
    const brandId   = document.getElementById('brand-filter').value;
    const priceMin  = parseFloat(document.getElementById('price-min').value) || 0;
    const priceMax  = parseFloat(document.getElementById('price-max').value) || Infinity;
    const stockFilter = document.getElementById('stock-filter').value;
    const activeTab = document.querySelector('[data-tab].active')?.dataset.tab ?? 'all';

    filteredProducts = PRODUCTS.filter(p => {
        const matchSearch = p.name.toLowerCase().includes(search) ||
                            p.sku.toLowerCase().includes(search) ||
                            (p.brand?.name ?? '').toLowerCase().includes(search);
        const matchBrand  = !brandId || p.brand_id == brandId;
        const matchPrice  = p.price >= priceMin && p.price <= priceMax;
        const matchStock  = !stockFilter ||
                            (stockFilter === 'in'  && p.stock >= 10) ||
                            (stockFilter === 'low' && p.stock > 0 && p.stock < 10) ||
                            (stockFilter === 'out' && p.stock === 0);
        const matchTab    = activeTab === 'all' || p.cat === activeTab;

        return matchSearch && matchBrand && matchPrice && matchStock && matchTab;
    });

    currentPage = 1;
    renderTable(filteredProducts);
}

document.addEventListener('DOMContentLoaded', () => {

    // ── MODAL ──
    const modal = document.getElementById('product-modal');

    function openModal() {
        modal.classList.add('open');
        document.getElementById('prod-name').focus();
    }

    function closeModal() {
        modal.classList.remove('open');
        document.getElementById('product-form').reset();
        document.getElementById('modal-title').textContent = 'New product';
        document.querySelectorAll('.chip.selected').forEach(c => {
            c.classList.remove('selected');
            c.setAttribute('aria-pressed', 'false');
        });
        toggleFields();
    }

    document.getElementById('btn-open-modal')?.addEventListener('click', openModal);
    document.getElementById('btn-close-modal')?.addEventListener('click', closeModal);
    document.getElementById('btn-cancel-modal')?.addEventListener('click', closeModal);

    modal?.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal.classList.contains('open')) closeModal();
    });

    // ── EDIT / DELETE via event delegation ──
    document.getElementById('product-tbody').addEventListener('click', (e) => {
        const btn = e.target.closest('[data-action]');
        if (!btn) return;

        const id     = Number(btn.dataset.id);
        const action = btn.dataset.action;

        if (action === 'edit') {
            const p = PRODUCTS.find(x => x.id === id);
            if (!p) return;
            document.getElementById('modal-title').textContent  = `Edit: ${p.name}`;
            document.getElementById('prod-name').value          = p.name;
            document.getElementById('prod-cat').value           = p.cat;
            document.getElementById('prod-brand').value         = p.brand_id;
            document.getElementById('prod-price').value         = p.price;
            document.getElementById('prod-stock').value         = p.stock;
            toggleFields();
            openModal();
        }

        if (action === 'delete') {
            showToast(`"${btn.dataset.name}" deleted`, 'red');
            // TODO: DELETE request to Laravel
        }
    });

    // ── FORM SUBMIT ──
    document.getElementById('btn-save-product')?.addEventListener('click', () => {
        const nameInput = document.getElementById('prod-name');
        const nameErr   = document.getElementById('prod-name-err');

        if (!nameInput.value.trim()) {
            nameInput.setAttribute('aria-invalid', 'true');
            nameErr.style.display = 'flex';
            nameInput.focus();
            return;
        }

        nameErr.style.display = 'none';
        nameInput.removeAttribute('aria-invalid');

        // TODO: POST to Laravel via fetch
        // const data = new FormData(document.getElementById('product-form'));
        // fetch('/products', {
        //     method: 'POST',
        //     headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
        //     body: data
        // });

        showToast('Product saved ✓', 'green');
        closeModal();
    });

    // ── CATEGORY TOGGLE ──
    function toggleFields() {
        const cat = document.getElementById('prod-cat')?.value;
        const showLiquid = cat === 'eliquid' || cat === 'nicsalt';
        document.getElementById('field-nicotine').style.display = showLiquid ? '' : 'none';
        document.getElementById('field-volume').style.display   = showLiquid ? '' : 'none';
        document.getElementById('field-flavors').style.display  = showLiquid ? '' : 'none';
    }

    document.getElementById('prod-cat')?.addEventListener('change', toggleFields);

    // ── CHIPS ──
    document.querySelectorAll('.chip').forEach(chip => {
        chip.addEventListener('click', () => {
            const pressed = chip.getAttribute('aria-pressed') === 'true';
            chip.setAttribute('aria-pressed', String(!pressed));
            chip.classList.toggle('selected', !pressed);
        });
    });

    // ── TABS ──
    document.querySelectorAll('[data-tab]').forEach(tab => {
        tab.addEventListener('click', () => {
            document.querySelectorAll('[data-tab]').forEach(t => {
                t.classList.remove('active');
                t.setAttribute('aria-selected', 'false');
            });
            tab.classList.add('active');
            tab.setAttribute('aria-selected', 'true');
            applyFilters();
        });
    });

    // ── FILTER LISTENERS ──
    ['search', 'brand-filter', 'price-min', 'price-max', 'stock-filter'].forEach(id => {
        document.getElementById(id)?.addEventListener('input', applyFilters);
    });

    document.getElementById('btn-clear-filters')?.addEventListener('click', () => {
        document.getElementById('search').value        = '';
        document.getElementById('brand-filter').value  = '';
        document.getElementById('price-min').value     = '';
        document.getElementById('price-max').value     = '';
        document.getElementById('stock-filter').value  = '';
        applyFilters();
    });

    // ── SEED BUTTON ──
    document.getElementById('btn-seed')?.addEventListener('click', async () => {
        showToast('⟳ Seeder running…', 'amber');
        await fetch('/seed', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
        });
        setTimeout(() => location.reload(), 1000);
    });

    // ── INIT ──
    filteredProducts = [...PRODUCTS];
    renderTable(filteredProducts);
});

// ── TOAST ──
let toastTimer;
function showToast(msg, type = 'green') {
    const t = document.getElementById('toast');
    const colors = { green: 'var(--green)', red: 'var(--red)', amber: 'var(--amber)' };
    t.style.borderLeftColor = colors[type] ?? colors.green;
    t.textContent = msg;
    t.classList.add('show');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => t.classList.remove('show'), 3000);
}