//Modo oscuro
const header = document.querySelector('header');

document.addEventListener('DOMContentLoaded', () => {
    const theme = localStorage.getItem('theme');
    const toggle = document.getElementById('toogle');
    if (theme === 'dark') {
        document.body.classList.add('dark-mode');
        if (header) header.classList.add('dark-mode'); // Aplica la clase al header si existe
        toggle.checked = true;
    }
});

document.getElementById('toogle').addEventListener('change', function () {
    if (this.checked) {
        console.log("Modo oscuro");
        document.body.classList.add('dark-mode'); // Agrega la clase cuando está marcado
        if (header) header.classList.add('dark-mode'); 
        localStorage.setItem('theme', 'dark');
    } else {
        document.body.classList.remove('dark-mode'); // Elimina la clase cuando no está marcado
        if (header) header.classList.remove('dark-mode'); 
        localStorage.setItem('theme', 'light');
    }
});