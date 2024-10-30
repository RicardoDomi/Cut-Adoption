const grande = document.querySelector('.grande');
const puntos = document.querySelectorAll('.punto');

document.addEventListener('DOMContentLoaded', () => {
    // Agrega un evento de clic a cada botón
    puntos.forEach((cadaPunto, i) => {
        cadaPunto.addEventListener('click', () => {
            console.log("Click");
            let operacion = i * -50; // Cambia -50% a -100% si tienes más imágenes
            grande.style.transform = `translateX(${operacion}%)`;

            puntos.forEach((punto) => {
                punto.classList.remove('activo');
            });
            cadaPunto.classList.add('activo');
        });
    });
});

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


//Fin modo oscuro
