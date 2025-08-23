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
            } else {
                if (mensajeCargaImagen) {
                    mensajeCargaImagen.textContent = `Archivo seleccionado: ${file.name}`;
                    mensajeCargaImagen.style.color = 'green';
                    mensajeCargaImagen.style.display = 'block';
                }
            }
        }

        // Prevenir el envío si no es válido y mostrar mensaje general
        if (!isValid) {
            event.preventDefault();
            if (messageElement) {
                messageElement.classList.remove('mesage_success');
                messageElement.classList.add('mesage_error');
                messageElement.textContent = 'Algunos datos son incorrectos, por favor revisa los campos resaltados.';
                messageElement.style.display = 'block';
            }
        } else {
            if (messageElement) {
                messageElement.classList.remove('mesage_error');
                messageElement.classList.add('mesage_success');
                messageElement.textContent = 'Formulario enviado correctamente.';
                messageElement.style.display = 'block';
            }
        }
    });
});