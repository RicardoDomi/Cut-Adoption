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