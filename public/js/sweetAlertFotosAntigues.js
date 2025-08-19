(function(){
  const q = (sel, ctx=document) => ctx.querySelector(sel);
  const qa = (sel, ctx=document) => Array.from(ctx.querySelectorAll(sel));

  const viewport  = q('.carousel__viewport');
  const slides    = qa('.carousel__slide');
  const dotsWrap  = q('.carousel__dots');
  const btnPrev   = q('.carousel__btn.prev');
  const btnNext   = q('.carousel__btn.next');

  if (!viewport || slides.length === 0) return;

  // ----- Dots
  slides.forEach((_, i) => {
    const b = document.createElement('button');
    b.type = 'button';
    b.setAttribute('aria-label', `Anar a la imatge ${i+1}`);
    b.addEventListener('click', () => goTo(i));
    dotsWrap.appendChild(b);
  });

  // ----- Helpers d’índex (per amplades variables)
  function getSlideCenters(){
    const baseLeft = viewport.scrollLeft;
    const vpRect   = viewport.getBoundingClientRect();
    const vpLeft   = vpRect.left;
    const vpCenter = vpLeft + vpRect.width/2;

    return slides.map(sl => {
      const r = sl.getBoundingClientRect();
      return r.left + r.width/2 - vpLeft + baseLeft; // centre del slide en coords d'scroll
    });
  }

  function currentIndex(){
    const centers = getSlideCenters();
    const target  = viewport.scrollLeft + viewport.clientWidth/2;
    let best = 0, bestDist = Infinity;
    centers.forEach((c,i) => {
      const d = Math.abs(c - target);
      if (d < bestDist) { best = i; bestDist = d; }
    });
    return best;
  }

  function updateDotsByIndex(idx){
    qa('button', dotsWrap).forEach((d,i) => {
      d.setAttribute('aria-current', i === idx ? 'true' : 'false');
    });
  }

  function goTo(idx){
    const target = slides[idx];
    if (!target) return;
    // Scroll cap al centre del slide
    const vpRect = viewport.getBoundingClientRect();
    const slRect = target.getBoundingClientRect();
    const delta  = (slRect.left + slRect.width/2) - (vpRect.left + vpRect.width/2);
    viewport.scrollBy({ left: delta, behavior: 'smooth' });
    updateDotsByIndex(idx);
  }

  // Inicial
  updateDotsByIndex(0);

  // Botons prev/next
  function step(dir){
    const idx = currentIndex();
    const nextIdx = Math.max(0, Math.min(slides.length-1, idx + dir));
    goTo(nextIdx);
  }
  if (btnPrev) btnPrev.addEventListener('click', () => step(-1));
  if (btnNext) btnNext.addEventListener('click', () => step(1));

  // Actualitzar dots en scroll manual
  let ticking = false;
  viewport.addEventListener('scroll', () => {
    if (ticking) return;
    ticking = true;
    requestAnimationFrame(() => {
      updateDotsByIndex(currentIndex());
      ticking = false;
    });
  }, { passive: true });

  // ---- SweetAlert
  function nl2br(s){ return (s || '').replace(/\r?\n/g,'<br>'); }

  function openSwal(el){
  if (typeof Swal === 'undefined') return;
  const titol        = el.dataset.titol || '—';
  const foto         = el.dataset.foto || '';
  const facilitador  = el.dataset.facilitador || '';
  const data         = el.dataset.data || '';
  const lloc         = el.dataset.lloc || '';
  const descripcio   = nl2br(el.dataset.descripcio || '');

  Swal.fire({
    title: titol,
    html: `
      ${foto ? `<div style="text-align:center;margin-bottom:12px">
        <img src="${foto}" alt="${titol}" style="max-width:100%;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,.15)">
      </div>` : ``}

      ${(lloc || data) ? `
        <div style="text-align:center;color:#003366;font-size:.95rem;margin-bottom:0.8rem">
          ${lloc ? `<strong>Lloc:</strong> ${lloc}${data ? ' · ' : ''}` : ``}
          ${data ? `<strong>Data:</strong> ${data}` : ``}
        </div>` : ``}

      ${descripcio ? `<div style="text-align:left;font-size:.95rem;color:#333;padding:0 16px;margin-bottom:8px">${descripcio}</div>` : ``}

   ${facilitador ? `
  <div style="text-align:right;color:#003366;font-size:.95rem;margin-top:8px; padding-right:0.8rem">
    <strong>Ens facilita la foto:</strong> ${facilitador}
  </div>` : ``}

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
