/**
 * Tienda de Productos — main.js
 * Micro-animaciones, UX feedback y utilidades de cliente.
 */

/* ── Notificación toast al agregar al carrito ─────────────── */
function showToast(message, type = 'success') {
  const existing = document.getElementById('shop-toast');
  if (existing) existing.remove();

  const toast = document.createElement('div');
  toast.id = 'shop-toast';
  toast.setAttribute('role', 'status');
  toast.setAttribute('aria-live', 'polite');

  const icons = { success: '✅', error: '❌', info: 'ℹ️' };
  toast.innerHTML = `<span>${icons[type] ?? '🔔'}</span><span>${message}</span>`;

  Object.assign(toast.style, {
    position:      'fixed',
    bottom:        '1.5rem',
    right:         '1.5rem',
    display:       'flex',
    alignItems:    'center',
    gap:           '0.5rem',
    padding:       '0.85rem 1.25rem',
    background:    type === 'success'
                     ? 'rgba(16,185,129,0.15)'
                     : 'rgba(239,68,68,0.15)',
    border:        `1px solid ${type === 'success'
                     ? 'rgba(16,185,129,0.35)'
                     : 'rgba(239,68,68,0.35)'}`,
    borderRadius:  '12px',
    color:         '#f1f5f9',
    fontFamily:    'Inter, sans-serif',
    fontSize:      '0.875rem',
    fontWeight:    '500',
    backdropFilter: 'blur(16px)',
    zIndex:        '9999',
    boxShadow:     '0 8px 32px rgba(0,0,0,0.4)',
    transform:     'translateY(20px)',
    opacity:       '0',
    transition:    'transform 0.3s ease, opacity 0.3s ease',
  });

  document.body.appendChild(toast);
  requestAnimationFrame(() => {
    toast.style.transform = 'translateY(0)';
    toast.style.opacity   = '1';
  });

  setTimeout(() => {
    toast.style.transform = 'translateY(20px)';
    toast.style.opacity   = '0';
    setTimeout(() => toast.remove(), 350);
  }, 2800);
}

/* ── Interceptar submit del form de carrito ───────────────── */
document.addEventListener('DOMContentLoaded', () => {
  const cartForm = document.getElementById('add-to-cart-form');
  if (cartForm) {
    cartForm.addEventListener('submit', () => {
      const btn = cartForm.querySelector('button[type="submit"]');
      if (btn) {
        btn.disabled = true;
        btn.textContent = '✓ Agregado';
        setTimeout(() => {
          btn.disabled = false;
          btn.textContent = btn.dataset.label || 'Agregar al Carrito';
        }, 2000);
      }
    });
  }

  /* ── Actualizar badge del carrito en navbar ──────────────── */
  const badge = document.getElementById('cart-count-badge');
  const cartCountMeta = document.getElementById('cart-count-meta');
  if (badge && cartCountMeta) {
    const count = parseInt(cartCountMeta.content, 10) || 0;
    if (count > 0) {
      badge.textContent = count;
      badge.style.display = 'inline-flex';
    } else {
      badge.style.display = 'none';
    }
  }

  /* ── Toast si hay parámetro ?added=1 en la URL ───────────── */
  const params = new URLSearchParams(window.location.search);
  if (params.get('added') === '1') {
    showToast('Producto agregado al carrito 🛒');
    // Limpiar parámetro sin recargar
    const cleanUrl = window.location.pathname + (params.toString().replace('added=1', '').replace(/^&|&$/, '') ? '?' + params.toString().replace('added=1', '').replace(/^&|&$/, '') : '');
    history.replaceState({}, '', cleanUrl);
  }

  /* ── Hover ripple en botones primary ─────────────────────── */
  document.querySelectorAll('.btn-primary').forEach(btn => {
    btn.addEventListener('click', function (e) {
      const rect = btn.getBoundingClientRect();
      const ripple = document.createElement('span');
      const size = Math.max(rect.width, rect.height);
      Object.assign(ripple.style, {
        position:      'absolute',
        width:         size + 'px',
        height:        size + 'px',
        left:          (e.clientX - rect.left - size / 2) + 'px',
        top:           (e.clientY - rect.top  - size / 2) + 'px',
        background:    'rgba(255,255,255,0.2)',
        borderRadius:  '50%',
        transform:     'scale(0)',
        animation:     'ripple-anim 0.5s linear',
        pointerEvents: 'none',
      });
      if (getComputedStyle(btn).position === 'static') btn.style.position = 'relative';
      btn.style.overflow = 'hidden';
      btn.appendChild(ripple);
      ripple.addEventListener('animationend', () => ripple.remove());
    });
  });
});

/* ── Añadir keyframe de ripple dinámicamente ─────────────── */
const rippleStyle = document.createElement('style');
rippleStyle.textContent = `
@keyframes ripple-anim {
  to { transform: scale(2.5); opacity: 0; }
}`;
document.head.appendChild(rippleStyle);
