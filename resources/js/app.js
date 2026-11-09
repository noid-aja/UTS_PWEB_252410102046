// Pindah antar instrumen (Gitar / Bass / Drum) di halaman Katalog Lagu
const buttons = document.querySelectorAll('.switch');
const panels = document.querySelectorAll('.inst-panel');

buttons.forEach((btn) => {
    btn.addEventListener('click', () => {
        const inst = btn.dataset.inst;

        buttons.forEach((b) => b.classList.toggle('is-on', b === btn));
        panels.forEach((p) => p.classList.toggle('is-hidden', p.dataset.panel !== inst));
    });
});
