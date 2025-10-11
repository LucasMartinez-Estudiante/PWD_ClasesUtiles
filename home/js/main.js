const menuBtn = document.getElementById('menuBtn');
const overlay = document.getElementById('overlay');
const sidebar = document.querySelector('.sidebar');

// Mostrar u ocultar el sidebar al hacer clic en el botón
menuBtn.addEventListener('click', (e) => {
    sidebar.classList.remove('sidebar-hidden');
    overlay.classList.remove('hidden');
    overlay.classList.add('active');
    e.stopPropagation(); // Evita que el clic en el botón se propague al document
});

// Evita que los clics dentro del sidebar lo cierren
sidebar.addEventListener('click', (e) => {
    e.stopPropagation();
});

// Cierra el sidebar si se hace clic fuera de él
document.addEventListener('click', () => {
    sidebar.classList.add('sidebar-hidden');
    overlay.classList.remove('active');
});