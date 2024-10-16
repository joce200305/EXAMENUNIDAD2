document.addEventListener('DOMContentLoaded', function () {
    const registroForm = document.getElementById('registroForm');
    const listaAlumnos = document.getElementById('listaAlumnos');

    // Función para cargar alumnos al cargar la página
    const cargarAlumnos = () => {
        fetch('app/controller/consultar.php')
            .then(response => response.json())
            .then(data => {
                listaAlumnos.innerHTML = ''; // Limpiar lista
                data.forEach(alumno => {
                    listaAlumnos.innerHTML += `
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5>${alumno.nombre} ${alumno.apellido}</h5>
                                <p><strong>Año de Ingreso:</strong> ${alumno.anio_ingreso}</p>
                                <p><strong>Carrera:</strong> ${alumno.carrera}</p>
                                <p><strong>Fecha de Nacimiento:</strong> ${alumno.fecha_nacimiento}</p>
                                <button class="btn btn-danger" onclick="eliminarAlumno(${alumno.id})">Eliminar</button>
                                <button class="btn btn-info" onclick="editarAlumno(${alumno.id})">Editar</button>
                            </div>
                        </div>
                    `;
                });
            });
    };

    // Llamada inicial para cargar alumnos
    cargarAlumnos();

    // Función para cerrar sesión
    const cerrarSesion = () => {
        fetch('app/controller/cerrar_sesion.php', {
            method: 'POST'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                window.location.href = 'login.php'; // Redirigir al login
            } else {
                alert('Error al cerrar sesión: ' + data.message);
            }
        })
        .catch(err => {
            console.error('Error en la solicitud:', err);
            alert('Error en la solicitud. Revisa la consola para más detalles.');
        });
    };

    // Función para registrar un nuevo alumno
    const registrarAlumno = (e) => {
        e.preventDefault();
        
        const formData = {
            nombre: document.getElementById('nombre').value,
            apellido: document.getElementById('apellido').value,
            anio_ingreso: document.getElementById('anio_ingreso').value,
            carrera: document.getElementById('carrera').value,
            fecha_nacimiento: document.getElementById('fecha_nacimiento').value,
            usuario: document.getElementById('usuario').value,
            password: document.getElementById('password').value
        };

        fetch('app/controller/insertar.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                cargarAlumnos(); // Recargar la lista de alumnos
                registroForm.reset(); // Limpiar el formulario
            } else {
                alert('Error al registrar el alumno: ' + data.message);
            }
        })
        .catch(err => {
            console.error('Error en la solicitud:', err);
            alert('Error en la solicitud. Revisa la consola para más detalles.');
        });
    };

    // Función para editar un alumno
    window.editarAlumno = (id) => {
        fetch(`app/controller/consultar.php?id=${id}`)
            .then(response => response.json())
            .then(alumno => {
                if (alumno) {
                    // Llenar el formulario con los datos del alumno
                    document.getElementById('nombre').value = alumno.nombre;
                    document.getElementById('apellido').value = alumno.apellido;
                    document.getElementById('anio_ingreso').value = alumno.anio_ingreso;
                    document.getElementById('carrera').value = alumno.carrera;
                    document.getElementById('fecha_nacimiento').value = alumno.fecha_nacimiento;
                    document.getElementById('usuario').value = alumno.usuario; 
                    document.getElementById('password').value = alumno.password; 

                    // Cambiar el evento del formulario para actualizar
                    registroForm.removeEventListener('submit', registrarAlumno);
                    registroForm.addEventListener('submit', function (e) {
                        e.preventDefault();
                        actualizarAlumno(id); // Llama a la función para actualizar
                    });
                } else {
                    alert('Alumno no encontrado');
                }
            })
            .catch(err => console.error('Error al cargar los datos del alumno:', err));
    };

    // Función para actualizar el alumno
    const actualizarAlumno = (id) => {
        const formData = {
            id: id,
            nombre: document.getElementById('nombre').value,
            apellido: document.getElementById('apellido').value,
            anio_ingreso: document.getElementById('anio_ingreso').value,
            carrera: document.getElementById('carrera').value,
            fecha_nacimiento: document.getElementById('fecha_nacimiento').value,
            usuario: document.getElementById('usuario').value,
            password: document.getElementById('password').value
        };

        fetch('app/controller/actualizar.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                cargarAlumnos(); // Recargar la lista de alumnos
                registroForm.reset(); // Limpiar el formulario
                // Reestablecer el evento original
                registroForm.removeEventListener('submit', function (e) {
                    e.preventDefault();
                    registrarAlumno(); // Cambia a la función de registro
                });
                registroForm.addEventListener('submit', registrarAlumno);
            } else {
                alert('Error al actualizar el alumno: ' + data.message);
            }
        })
        .catch(err => {
            console.error('Error en la solicitud:', err);
            alert('Error en la solicitud. Revisa la consola para más detalles.');
        });
    };

    // Función para eliminar un alumno
    window.eliminarAlumno = (id) => {
        fetch('app/controller/eliminar.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: id })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                cargarAlumnos(); // Recargar la lista de alumnos
            } else {
                alert('Error al eliminar el alumno');
            }
        });
    };

    // Agregar el evento para el registro
    registroForm.addEventListener('submit', registrarAlumno);

    // Añadir el evento de cerrar sesión
    document.getElementById('cerrarSesionBtn').addEventListener('click', cerrarSesion);
});
