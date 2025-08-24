document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.cont_form');
    const cedulaInput = document.getElementById('cedula');
    const nombreApellidoInput = document.getElementById('nombre_y_apellido');
    const telefonoInput = document.getElementById('telefono');
    const correoInput = document.getElementById('correo');
    const cantidadTicketsInput = document.getElementById('cantidad_de_tickets');
    const montoInput = document.getElementById('monto');
    const metodoPagoSelect = document.getElementById('metodo_de_pago');
    const referenciaInput = document.getElementById('referencia');
    const fechaPagoInput = document.getElementById('fecha_de_pago');
    const imagenComprobanteInput = document.getElementById('imagen_comprobante');
    const mensajeCargaImagen = document.getElementById('mensajeCargaImagen');
    const messageElement = document.getElementById('message');

    // Función para mostrar errores debajo del campo
    function showError(element, message) {
        let errorElement = element.nextElementSibling;
        if (!errorElement || !errorElement.classList.contains('error-message')) {
            errorElement = document.createElement('p');
            errorElement.classList.add('error-message');
            errorElement.style.color = 'red';
            errorElement.style.fontSize = '0.8em';
            element.parentNode.insertBefore(errorElement, element.nextSibling);
        }
        errorElement.textContent = message;
    }

    // Listener para el evento submit del formulario
    form.addEventListener('submit', function(event) {
        let isValid = true;
        
        // Limpiar todos los mensajes de error previos
        document.querySelectorAll('.error-message').forEach(el => el.remove());
        if (mensajeCargaImagen) {
            mensajeCargaImagen.style.display = 'none';
        }
        if (messageElement) {
            messageElement.style.display = 'none';
        }

        // --- VALIDACIONES DE CADA CAMPO ---
        // (La lógica de las validaciones de los campos individuales es la misma)
        
        // Validar Cédula
        const cedula = cedulaInput.value.trim();
        if (cedula === '') {
            showError(cedulaInput, 'La cédula es obligatoria.');
            isValid = false;
        } else if (!/^\d{6,10}$/.test(cedula)) {
            showError(cedulaInput, 'La cédula debe contener entre 6 y 10 dígitos numéricos.');
            isValid = false;
        }

        // Validar Nombre y Apellido
        const nombreApellido = nombreApellidoInput.value.trim();
        if (nombreApellido === '') {
            showError(nombreApellidoInput, 'El nombre y apellido son obligatorios.');
            isValid = false;
        } else if (nombreApellido.length < 3) {
            showError(nombreApellidoInput, 'El nombre y apellido deben tener al menos 3 caracteres.');
            isValid = false;
        }

        // Validar Teléfono
        const telefono = telefonoInput.value.trim();
        if (telefono === '') {
            showError(telefonoInput, 'El teléfono es obligatorio.');
            isValid = false;
        } else if (!/^\d{10,15}$/.test(telefono)) {
            showError(telefonoInput, 'El teléfono debe contener entre 10 y 15 dígitos numéricos.');
            isValid = false;
        }

        // Validar Correo Electrónico
        const correo = correoInput.value.trim();
        if (correo === '') {
            showError(correoInput, 'El correo es obligatorio.');
            isValid = false;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo)) {
            showError(correoInput, 'Ingrese un formato de correo electrónico válido.');
            isValid = false;
        }

        // Validar Cantidad de Tickets
        const cantidadTickets = parseInt(cantidadTicketsInput.value);
        const maxTickets = parseInt(cantidadTicketsInput.getAttribute('max'));
        if (isNaN(cantidadTickets) || cantidadTickets < 1) {
            showError(cantidadTicketsInput, 'Debe seleccionar al menos 1 ticket.');
            isValid = false;
        } else if (cantidadTickets > maxTickets) {
            showError(cantidadTicketsInput, `Solo quedan ${maxTickets} tickets disponibles.`);
            isValid = false;
        }
        
        // Validar Monto
        const monto = parseFloat(montoInput.value);
        if (isNaN(monto) || monto <= 0) {
            showError(montoInput, 'El monto no puede ser cero o un valor inválido.');
            isValid = false;
        }

        // Validar Método de Pago
        if (metodoPagoSelect && metodoPagoSelect.value === 'n') {
            showError(metodoPagoSelect, 'Debe seleccionar un método de pago.');
            isValid = false;
        }

        // Validar Referencia de Pago
        const referencia = referenciaInput.value.trim();
        if (referencia === '') {
            showError(referenciaInput, 'La referencia de pago es obligatoria.');
            isValid = false;
        } else if (!/^\d{12}$/.test(referencia)) {
            showError(referenciaInput, 'La referencia debe contener exactamente 12 dígitos numéricos.');
            isValid = false;
        } else if (parseInt(referencia) <= 0) {
            showError(referenciaInput, 'La referencia debe ser un número positivo.');
            isValid = false;
        }

        // Validar Fecha de Pago
        const fechaPago = fechaPagoInput.value;
        if (fechaPago === '') {
            showError(fechaPagoInput, 'La fecha de pago es obligatoria.');
            isValid = false;
        }

        // Validar Comprobante de Pago
        if (imagenComprobanteInput.files.length === 0) {
            if (mensajeCargaImagen) {
                mensajeCargaImagen.textContent = 'Debe subir un comprobante de pago.';
                mensajeCargaImagen.style.color = 'red';
                mensajeCargaImagen.style.display = 'block';
            }
            isValid = false;
        } else {
            const file = imagenComprobanteInput.files[0];
            const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg'];
            const maxSizeMB = 5;
            const maxSizeBytes = maxSizeMB * 1024 * 1024;

            if (!allowedTypes.includes(file.type)) {
                if (mensajeCargaImagen) {
                    mensajeCargaImagen.textContent = 'Tipo de archivo no permitido. Solo se aceptan PNG, JPEG, JPG.';
                    mensajeCargaImagen.style.color = 'red';
                    mensajeCargaImagen.style.display = 'block';
                }
                isValid = false;
            } else if (file.size > maxSizeBytes) {
                if (mensajeCargaImagen) {
                    mensajeCargaImagen.textContent = `El archivo es demasiado grande. Máximo ${maxSizeMB}MB.`;
                    mensajeCargaImagen.style.color = 'red';
                    mensajeCargaImagen.style.display = 'block';
                }
                isValid = false;
            }
        }

        // --- LÓGICA FINAL Y CORREGIDA ---
        // Si el formulario no es válido, detenemos el envío y mostramos el mensaje de error
        if (!isValid) {
            event.preventDefault(); // Detiene el envío del formulario
            if (messageElement) {
                messageElement.classList.remove('mesage_success');
                messageElement.classList.add('mesage_error');
                messageElement.textContent = 'Algunos datos son incorrectos, por favor revisa los campos.';
                messageElement.style.display = 'block';
            }
            return; // Detiene la ejecución del resto del código
        }
        
        // Si el formulario es válido, la ejecución continúa y el formulario se envía
        // No agregues el mensaje de éxito aquí, ya que el servidor se encargará de eso.
    });
});

document.addEventListener('DOMContentLoaded', () => {
        const inputImagen = document.getElementById('imagen_comprobante');
        const mensajeCarga = document.getElementById('mensajeCargaImagen');
        const miFormulario = document.querySelector('.form'); 

        
        inputImagen.addEventListener('change', () => {
            if (inputImagen.files.length > 0) {
                const fileName = inputImagen.files[0].name;
                mensajeCarga.textContent = `Archivo seleccionado: ${fileName}. Listo para subir.`;
                mensajeCarga.style.display = 'block'; 
                mensajeCarga.style.color = '#3498db'; 
            } else {
                mensajeCarga.textContent = ''; 
                mensajeCarga.style.display = 'none'; 
            }
        });

    
        miFormulario.addEventListener('submit', () => {
            
            if (inputImagen.files.length > 0) {
                mensajeCarga.textContent = 'Subiendo comprobante... Por favor, espera.';
                mensajeCarga.style.display = 'block';
                mensajeCarga.style.color = '#e67e22'; 
            }

        });

    });
    document.addEventListener('DOMContentLoaded', () => {
    const sessionMessages = document.getElementById('session-messages');
    const messageContainer = document.getElementById('dynamic-message-container');

    if (!sessionMessages || !messageContainer) {
        return; // Detiene el script si no encuentra los elementos necesarios
    }

    const successMessage = sessionMessages.dataset.success;
    const errorMessage = sessionMessages.dataset.error;

    let messageHTML = '';

    // Si hay un mensaje de éxito, crea el HTML para él
    if (successMessage) {
        messageHTML = `
            <div class="mesage_success" role="alert">
                <span class="block sm:inline">${successMessage}</span>
            </div>
        `;
    }

    // Si hay un mensaje de error, crea el HTML para él
    if (errorMessage) {
        messageHTML = `
            <div class="mesage_error" role="alert">
                <strong>¡Ups!</strong>
                <span class="block sm:inline">${errorMessage}</span>
            </div>
        `;
    }

    // Si se encontró algún mensaje, insértalo en el contenedor
    if (messageHTML) {
        messageContainer.innerHTML = messageHTML;
        
        // Opcional: Ocultar el mensaje después de 5 segundos
        setTimeout(() => {
            messageContainer.innerHTML = '';
        }, 5000); // 5000 milisegundos = 5 segundos
    }
});


