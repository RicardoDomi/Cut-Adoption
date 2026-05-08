// ===============================
// OBTENER MASCOTAS DESDE PHP
// ===============================

fetch('conexion.php')
    .then(response => response.json())
    .then(data => {

        const container = document.querySelector('.pet-cards-container');
        container.innerHTML = '';

        data.forEach(mascota => {

            let botonHTML = '';

            if (mascota.en_proceso) {
                botonHTML = `
                    <button disabled class="btn-proceso">
                        EN PROCESO DE ADOPCIÓN...
                    </button>
                `;
            } else {
                botonHTML = `
                    <a href="#solicitud" data-id="${mascota.ID_Mascota}" class="btn-adoptar">
                        ADOPTAR
                    </a>
                `;
            }

            const card = document.createElement('div');
            card.classList.add('pet-card');

            card.innerHTML = `
                <img src="${mascota.ImagenURL}" alt="${mascota.Nombre}">

                <h3>${mascota.Nombre}</h3>

                <p><strong>Edad:</strong> ${mascota.Edad} años</p>

                <p><strong>Raza:</strong> ${mascota.Raza ? mascota.Raza : 'No especificada'}</p>

                <p><strong>Sexo:</strong> ${mascota.Sexo ? mascota.Sexo : 'No especificado'}</p>

                <p>
                    ${mascota.Descripcion
                        ? mascota.Descripcion
                        : 'Mascota amigable y lista para encontrar un hogar.'}
                </p>

                <p>
                    <strong>Estado:</strong>
                    ${mascota.en_proceso ? 'En proceso' : 'Disponible'}
                </p>

                ${botonHTML}
            `;

            container.appendChild(card);
        });

    })
    .catch(error => console.error('Error:', error));


// ===============================
// CARRUSEL
// ===============================

const grande = document.querySelector('.grande');
const punto = document.querySelectorAll('.punto');

punto.forEach((cadaPunto, i) => {

    punto[i].addEventListener('click', () => {

        let posicion = i;
        let operacion = posicion * -33.3;

        grande.style.transform = `translateX(${operacion}%)`;

        punto.forEach((cadaPunto, i) => {
            punto[i].classList.remove('activo');
        });

        punto[i].classList.add('activo');
    });

});


// ===============================
// MODO OSCURO
// ===============================

const toggle = document.getElementById('toogle');

if (toggle) {
    toggle.addEventListener('change', () => {
        document.body.classList.toggle('dark');
    });
}


// ===============================
// FORMULARIO DE ADOPCIÓN
// ===============================

let mascotaSeleccionada = null;

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('btn-adoptar')) {
        mascotaSeleccionada = e.target.getAttribute('data-id');
    }
});

const formSolicitud = document.getElementById('formSolicitud');

if (formSolicitud) {
    formSolicitud.addEventListener('submit', async function(e) {
        e.preventDefault();

        const datos = {
            id_mascota: mascotaSeleccionada || 1,
            nombre: document.getElementById('nombre').value,
            correo: document.getElementById('correo').value,
            telefono: document.getElementById('telefono').value,
            direccion: document.getElementById('direccion').value,
            vivienda: document.getElementById('vivienda').value,
            motivo: document.getElementById('motivo').value,
            experiencia: document.getElementById('experiencia').value
        };

        const respuesta = await fetch('guardar_solicitud.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(datos)
        });

        const resultado = await respuesta.json();

        if (resultado.success) {
            alert("Solicitud enviada correctamente");
            this.reset();
            mascotaSeleccionada = null;
        } else {
            alert("Error: " + resultado.error);
        }
    });
}
// ===============================
// ENVIAR SOLICITUD
// ===============================

const formulario = document.getElementById('formSolicitud');

if (formulario) {

    formulario.addEventListener('submit', async function(e) {

        e.preventDefault();

        const datos = {

            vivienda: document.getElementById('vivienda').value,
            motivo: document.getElementById('motivo').value,
            experiencia: document.getElementById('experiencia').value

        };

        try {

            const respuesta = await fetch('guardar_solicitud.php', {

                method: 'POST',

                headers: {
                    'Content-Type': 'application/json'
                },

                body: JSON.stringify(datos)

            });

            const resultado = await respuesta.json();

            if (resultado.success) {

                alert('Solicitud enviada correctamente');

                formulario.reset();

            } else {

                alert('Error: ' + resultado.error);

            }

        } catch (error) {

            console.error(error);

            alert('Error al enviar solicitud');

        }

    });

}