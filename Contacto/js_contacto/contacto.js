//Modo oscuro
document.getElementById('toogle').addEventListener('change', function () {
    if (this.checked) {
        console.log("Modo oscuro")
        document.body.classList.add('dark-mode'); // Agrega la clase cuando está marcado
        header.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode'); // Elimina la clase cuando no está marcado
        header.classList.remove('dark-mode');
    }
});
