(function () {
  const nl2br = s => (s || '').replace(/\r?\n/g, '<br>');

  function abrirModal(el) {
    const titol = el.dataset.titolLarg || '—';   // llegeix data-titol-larg
    const des   = nl2br(el.dataset.descripcio || '');
    const foto  = el.dataset.foto || '';

    Swal.fire({
      title: titol,
      html: `
        ${foto ? `<div style="margin-bottom:12px;text-align:center">
          <img src="${foto}" alt="${titol}" style="max-width:100%;border-radius:8px">
        </div>` : ``}
        ${des ? `<div style="text-align:left">${des}</div>` : ``}
      `,
      width: 700,
      showCloseButton: true,
      confirmButtonText: 'Tancar',
       customClass: {
    confirmButton: 'swal-btn-blue'
  }
    });
  }

  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.js-exit').forEach(el => {
      el.style.cursor = 'pointer';
      if (!el.hasAttribute('tabindex')) el.tabIndex = 0;
      el.addEventListener('click', () => abrirModal(el));
      el.addEventListener('keydown', ev => {
        if (ev.key === 'Enter' || ev.key === ' ') {
          ev.preventDefault();
          abrirModal(el);
        }
      });
    });
  });
})();
