document.addEventListener('DOMContentLoaded', function () {
  const btn = document.getElementById('btnJugadors');
  if (!btn) return;

  btn.addEventListener('click', function () {
    let titol = btn.getAttribute('data-titol') || '';
    let raw = btn.getAttribute('data-jugadors') || '[]';

    let jugadors = [];
    try {
      jugadors = JSON.parse(raw);
    } catch (e) {
      console.warn("No s'ha pogut parsejar data-jugadors", e);
      jugadors = [];
    }

    const list = jugadors.map(j => `
      <tr>
        <td style="padding:6px;">${j.dorsal ?? ''}</td>
        <td style="padding:6px;">${j.nom}</td>
        <td style="padding:6px;">${j.cognoms}</td>
      </tr>
    `).join('');

    const html = list
      ? `<table style="width:100%;border-collapse:collapse;text-align:left;">
           <thead>
             <tr>
               <th style="padding:6px;border-bottom:1px solid #eee;">Dorsal</th>
               <th style="padding:6px;border-bottom:1px solid #eee;">Nom</th>
               <th style="padding:6px;border-bottom:1px solid #eee;">Cognoms</th>
             </tr>
           </thead>
           <tbody>${list}</tbody>
         </table>`
      : '<p>No hi ha jugadors assignats encara.</p>';

    Swal.fire({
      title: `Jugadors del ${titol}`,
      html,
      icon: 'info',
      width: 700,
      showCloseButton: true,
      confirmButtonText: 'Tancar',
       customClass: {
    confirmButton: 'swal-btn-blue'
  },
      buttonsStyling: false
    });
  });
});
// k
