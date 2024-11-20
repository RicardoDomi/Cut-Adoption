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

// Cargar información de la base de datos
async function cargarMascotas() {
    try {
        console.log("Requerir mascotas...");
        const response = await fetch('conexion.php');
        const mascotas = await response.json();

        console.log(mascotas);

        const contenedor = document.querySelector('.pet-cards-container');
        contenedor.innerHTML = ''; // Limpiar el contenedor antes de agregar nuevas mascotas

        // Crear las tarjetas de mascotas
        mascotas.forEach(mascota => {
            const card = document.createElement('div');
            card.classList.add('pet-card');
            card.innerHTML = `
                <img src="${mascota.ImagenURL}" alt="${mascota.Nombre}">
                <h3>${mascota.Nombre}</h3>
                <p>Edad: ${mascota.Edad} años</p>
                <button class="btn" data-id="${mascota.ID_Mascota}" ${mascota.en_proceso ? 'disabled' : ''}>
                    ${mascota.en_proceso ? 'En proceso de adopción' : 'Adoptar'}
                </button>
            `;
            contenedor.appendChild(card);
        });

        // Agregar los eventos de clic a los botones "Adoptar"
        document.querySelector('.pet-cards-container').addEventListener('click', async function (event) {
            if (event.target && event.target.classList.contains('btn') && !event.target.disabled) {
                console.log("Adoptar click");

                // Obtener el ID de la mascota
                const idMascota = event.target.getAttribute('data-id');
                console.log('ID de la mascota:', idMascota);
                const idAdoptante = 1; // ID del adoptante (esto debe estar en algún lugar de tu sistema)

                try {
                    // Desactivar el botón y cambiar su estilo a "en proceso"
                    const boton = event.target;
                    boton.disabled = true;
                    boton.classList.add('en-proceso');
                    boton.innerText = "En proceso de adopción...";

                    // Realizar la solicitud para registrar la adopción
                    const respuesta = await fetch('adoptar.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            id_mascota: idMascota,
                            fecha_adopcion: new Date().toISOString().split('T')[0], // Fecha actual en formato YYYY-MM-DD
                            estado_adopcion: 'Pendiente', // Estado inicial de la adopción
                        }),
                    });

                    const data = await respuesta.json();

                    if (data.success) {
                        alert("¡Adopción registrada con éxito!");
                    } else {
                        alert("Hubo un error al registrar la adopción.");
                    }
                } catch (error) {
                    console.error("Error al registrar la adopción:", error);
                    alert("Ocurrió un error al intentar registrar la adopción.");
                }
            }
        });

    } catch (error) {
        console.error('Error al cargar las mascotas:', error);
    }
}


// Llama a la función al cargar la página
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

// Llama a la función al cargar la página
document.addEventListener('DOMContentLoaded', cargarMascotas);