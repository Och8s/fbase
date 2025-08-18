(function () {
  const nl2br = s => (s || '').replace(/\r?\n/g, '<br>');

  function abrirModal(el) {
    const nom = el.dataset.nom || '';
    const cognoms = el.dataset.cognoms || '';
    const apodo = el.dataset.apodo ? ` «${el.dataset.apodo}»` : '';
    const foto = el.dataset.foto || '';

    const posicio = el.dataset.posicio || '';
    const etapaCurta = el.dataset.etapaCurta || '';

    const desCurta = nl2br(el.dataset.descripcioCurta || '');
    const desLlarga = nl2br(el.dataset.descripcioLlarga || '');

    const titol = `${nom} ${cognoms}${apodo}`;

    if (typeof Swal === 'undefined') return;

    Swal.fire({
      title: titol || '—',
      html: `
        ${foto ? `<div style="margin-bottom:12px;text-align:center">
          <img src="${foto}" alt="${titol}" style="max-width:80%;border-radius:8px;box-shadow:0 2px 6px rgba(0,0,0,0.2)">
        </div>` : ``}

        ${etapaCurta || posicio ? `
          <div style="margin-bottom:12px;font-size:0.95rem;color:#004080;text-align:center">
            ${etapaCurta ? `<strong>Etapa:</strong> ${etapaCurta}<br>` : ``}
            ${posicio ? `<strong>Posició:</strong> ${posicio}` : ``}
          </div>` : ``}

        ${desCurta ? `<div style="margin-bottom:10px;font-weight:bold;color:#004080">${desCurta}</div>` : ``}
${desLlarga ? `<div style="text-align:left;font-size:0.95rem;color:#333;padding:0 20px">${desLlarga}</div>` : ``}
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
