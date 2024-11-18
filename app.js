const grande = document.querySelector('.grande');
const puntos = document.querySelectorAll('.punto');
const header = document.querySelector('header');

document.addEventListener('DOMContentLoaded', () => {
    // Agrega un evento de clic a cada botón
    puntos.forEach((cadaPunto, i) => {
        cadaPunto.addEventListener('click', () => {
            let operacion = i * -50; // Cambia -50% a -100% si tienes más imágenes
            grande.style.transform = `translateX(${operacion}%)`;

            puntos.forEach((punto) => {
                punto.classList.remove('activo');
            });
            cadaPunto.classList.add('activo');
        });
    });
    const theme = localStorage.getItem('theme');
    const toggle = document.getElementById('toogle');
    if (theme === 'dark') {
        document.body.classList.add('dark-mode');
        header.classList.add('dark-mode');
        toggle.checked = true; // Marca el toggle si el modo oscuro está activo
    }
});

//Modo oscuro
document.getElementById('toogle').addEventListener('change', function () {
    if (this.checked) {
        console.log("Modo oscuro");
        document.body.classList.add('dark-mode');
        header.classList.add('dark-mode');
        localStorage.setItem('theme', 'dark');
    } else {
        console.log("Modo claro");
        document.body.classList.remove('dark-mode');
        header.classList.remove('dark-mode');
        localStorage.setItem('theme', 'light');
    }
});

//Fin modo oscuro

//Cargar info de base de datos
async function cargarMascotas() {
    try {
        const response = await fetch('conexion.php');
        const mascotas = await response.json();

        console.log(mascotas);

        const contenedor = document.querySelector('.pet-cards-container');

        mascotas.forEach(mascota => {
            const card = document.createElement('div');
            card.classList.add('pet-card');
            card.innerHTML = `
             <img src="${mascota.ImagenURL}" alt="${mascota.Nombre}"
                <h3>${mascota.Nombre}</h3>
                <p>Edad: ${mascota.Edad} años</p>
                <button class="btn">Adoptar</button>
            `;
            contenedor.appendChild(card);
        });
    } catch (error) {
        console.error('Error al cargar las mascotas:', error);
    }
}
// Llama a la función al cargar la página
document.addEventListener('DOMContentLoaded', cargarMascotas);
//Fin carga cards perros