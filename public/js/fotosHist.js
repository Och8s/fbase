(function(){
  const q = (sel, ctx=document) => ctx.querySelector(sel);
  const qa = (sel, ctx=document) => Array.from(ctx.querySelectorAll(sel));
  const viewport = q('.carousel__viewport');
  const slides = qa('.carousel__slide');
  const dotsWrap = q('.carousel__dots');

  if (!viewport || slides.length === 0) return;

  // Crear dots
  slides.forEach((_, i) => {
    const b = document.createElement('button');
    b.type = 'button';
    b.setAttribute('aria-label', `Anar a la imatge ${i+1}`);
    b.addEventListener('click', () => goTo(i));
    dotsWrap.appendChild(b);
  });

  function updateDotsByIndex(idx){
    qa('button', dotsWrap).forEach((d,i) => {
      d.setAttribute('aria-current', i === idx ? 'true' : 'false');
    });
  }

  function indexFromScroll(){
    const vw = viewport.getBoundingClientRect().width;
    const scroll = viewport.scrollLeft;
    // aproximar a l’índex més proper
    return Math.round(scroll / (vw * 0.80)); // 80% perquè grid-auto-columns:80%
  }

  function goTo(idx){
    const target = slides[idx];
    if (!target) return;
    target.scrollIntoView({behavior:'smooth', inline:'center', block:'nearest'});
    updateDotsByIndex(idx);
  }

  // Inicialitzar
  updateDotsByIndex(0);

  // Botons prev/next
  qa('.carousel__btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const dir = parseInt(btn.dataset.dir || '1', 10);
      const idx = indexFromScroll();
      goTo(Math.max(0, Math.min(slides.length-1, idx + dir)));
    });
  });

  // Actualitzar dots mentre fem scroll manual
  let ticking = false;
  viewport.addEventListener('scroll', () => {
    if (ticking) return;
    ticking = true;
    requestAnimationFrame(() => {
      updateDotsByIndex(indexFromScroll());
      ticking = false;
    });
  });

  // Obrir modal amb detall al clicar o Enter
  function nl2br(s){ return (s || '').replace(/\r?\n/g,'<br>'); }

  function openSwal(el){
    if (typeof Swal === 'undefined') return;

    const titol = el.dataset.titol || '—';
    const foto = el.dataset.foto || '';
    const facilitador = el.dataset.facilitador || '';
    const data = el.dataset.data || '';
    const lloc = el.dataset.lloc || '';
    const des = nl2br(el.dataset.descripcio || '');

    Swal.fire({
      title: titol,
      html: `
        ${foto ? `<div style="text-align:center;margin-bottom:12px">
          <img src="${foto}" alt="${titol}" style="max-width:100%;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,.15)">
        </div>` : ``}
        ${(facilitador || data || lloc) ? `
          <div style="text-align:center;color:#003366;font-size:.95rem;margin-bottom:8px">
            ${facilitador ? `<strong>Facilitador:</strong> ${facilitador}<br>` : ``}
            ${lloc ? `<strong>Lloc:</strong> ${lloc}${data ? ' · ' : ''}` : ``}
            ${data ? `<strong>Data:</strong> ${data}` : ``}
          </div>` : ``}
        ${des ? `<div style="text-align:left;font-size:.95rem;color:#333;padding:0 16px">${des}</div>` : ``}
      `,
      width: 760,
      showCloseButton: true,
      confirmButtonText: 'Tancar',
      customClass: { confirmButton: 'swal-btn-blue' }
    });
  }

  slides.forEach(el => {
    el.addEventListener('click', () => openSwal(el));
    el.addEventListener('keydown', (ev) => {
      if (ev.key === 'Enter' || ev.key === ' ') {
        ev.preventDefault();
        openSwal(el);
      }
    });
  });
})();
