document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.form');
    const cedulaInput = document.getElementById('cedula');
    const nombreApellidoInput = document.getElementById('nombre_y_apellido');
    const telefonoInput = document.getElementById('telefono');
    const correoInput = document.getElementById('correo');
    const cantidadTicketsInput = document.getElementById('cantidad_de_tickets'); // Input oculto, llenado por tu JS externo
    const montoInput = document.getElementById('monto');                     // Input oculto, llenado por tu JS externo
    const metodoPagoSelect = document.getElementById('metodo_de_pago');
    const referenciaInput = document.getElementById('referencia');
    const fechaPagoInput = document.getElementById('fecha_de_pago');
    const imagenComprobanteInput = document.getElementById('imagen_comprobante');
    const mensajeCargaImagen = document.getElementById('mensajeCargaImagen');
    const messageElement = document.getElementById('message');

    
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

    function clearError(element) {
        const errorElement = element.nextElementSibling;
        if (errorElement && errorElement.classList.contains('error-message')) {
            errorElement.remove();
        }
    }


    cedulaInput.addEventListener('blur', function() {
        const cedula = this.value.trim();
        if (cedula === '') {
            showError(this, 'La **cédula** es obligatoria.');
        } else if (!/^\d{6,10}$/.test(cedula)) {
            showError(this, 'La **cédula** debe contener entre 6 y 10 dígitos numéricos.');
        } else {
            clearError(this);
        }
    });

    nombreApellidoInput.addEventListener('blur', function() {
        const nombreApellido = this.value.trim();
        if (nombreApellido === '') {
            showError(this, 'El **nombre y apellido** son obligatorios.');
        } else if (nombreApellido.length < 3) {
            showError(this, 'El **nombre y apellido** deben tener al menos 3 caracteres.');
        } else {
            clearError(this);
        }
    });

    telefonoInput.addEventListener('blur', function() {
        const telefono = this.value.trim();
        if (telefono === '') {
            showError(this, 'El **teléfono** es obligatorio.');
        } else if (!/^\d{10,15}$/.test(telefono)) {
            showError(this, 'El **teléfono** debe contener entre 10 y 15 dígitos numéricos.');
        } else {
            clearError(this);
        }
    });

    correoInput.addEventListener('blur', function() {
        const correo = this.value.trim();
        if (correo === '') {
            showError(this, 'El **correo** es obligatorio.');
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo)) {
            showError(this, 'Ingrese un formato de **correo electrónico válido**.');
        } else {
            clearError(this);
        }
    });

    metodoPagoSelect.addEventListener('change', function() {
        if (this.value === 'n') {
            showError(this, 'Debe seleccionar un **método de pago**.');
        } else {
            clearError(this);
        }
    });

    referenciaInput.addEventListener('blur', function() {
    const referencia = this.value.trim();

    // 1. Validar que no esté vacío
    if (referencia === '') {
        showError(this, 'La **referencia de pago** es obligatoria.');
    } 
    // 2. Validar que sean 12 dígitos numéricos
    else if (!/^\d{12}$/.test(referencia)) {
        showError(this, 'La **referencia** debe contener exactamente 12 dígitos.');
    } 
    // 3. Validar que sea un número positivo (opcional, si se necesita)
    else if (parseInt(referencia) <= 0) {
         showError(this, 'La **referencia** debe ser un número positivo.');
    } 
    // Si todo es correcto
    else {
        clearError(this);
    }
});

    fechaPagoInput.addEventListener('blur', function() {
        const fecha = this.value;
        if (fecha === '') {
            showError(this, 'La **fecha de pago** es obligatoria.');
        } else {
            clearError(this);
        }
    });

    imagenComprobanteInput.addEventListener('change', function() {
        if (this.files.length === 0) {
            mensajeCargaImagen.textContent = 'Debe subir un **comprobante de pago**.';
            mensajeCargaImagen.style.color = 'red';
            mensajeCargaImagen.style.display = 'block';
        } else {
            const file = this.files[0];
            const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg'];
            const maxSizeMB = 5; 
            const maxSizeBytes = maxSizeMB * 1024 * 1024;

            if (!allowedTypes.includes(file.type)) {
                mensajeCargaImagen.textContent = 'Tipo de archivo no permitido. Solo se aceptan PNG, JPEG, JPG.';
                mensajeCargaImagen.style.color = 'red';
                mensajeCargaImagen.style.display = 'block';
            } else if (file.size > maxSizeBytes) {
                mensajeCargaImagen.textContent = `El archivo es demasiado grande. Máximo ${maxSizeMB}MB.`;
                mensajeCargaImagen.style.color = 'red';
                mensajeCargaImagen.style.display = 'block';
            } else {
                mensajeCargaImagen.textContent = `Archivo seleccionado: ${file.name}`;
                mensajeCargaImagen.style.color = 'green';
                mensajeCargaImagen.style.display = 'block';
            }
        }
    });


    form.addEventListener('submit', function(event) {
        let isValid = true; 

        document.querySelectorAll('.error-message').forEach(el => el.remove());
        mensajeCargaImagen.style.display = 'none';


        // Validacion de cedula
        const cedula = cedulaInput.value.trim();
        if (cedula === '') {
            showError(cedulaInput, 'La cédula es obligatoria.');
            isValid = false;
        } else if (!/^\d{6,10}$/.test(cedula)) {
            showError(cedulaInput, 'Error en la cedula');
            isValid = false;
        }

        // Validar Nombre y Apellido
        const nombreApellido = nombreApellidoInput.value.trim();
        if (nombreApellido === '') {
            showError(nombreApellidoInput, 'El nombre es obligatorio.');
            isValid = false;
        } else if (nombreApellido.length < 3) {
            showError(nombreApellidoInput, 'El nombre debe tener al menos 3 caracteres.');
            isValid = false;
        }

        // Validar Teléfono
        const telefono = telefonoInput.value.trim();
        if (telefono === '') {
            showError(telefonoInput, 'El teléfono es obligatorio.');
            isValid = false;
        } else if (!/^\d{10,15}$/.test(telefono)) {
            showError(telefonoInput, 'Asegurese de que no hayan simbolos en el telefono');
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


        // Validar Tickets 
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
            showError(montoInput, 'El monto no puede ser cero.');
            isValid = false;
        }

        // Validar Método de Pago
        if (metodoPagoSelect.value === 'n') {
            showError(metodoPagoSelect, 'Debe seleccionar un método de pago.');
            isValid = false;
        }

        // Validar Referencia de Pago
        const referencia = referenciaInput.value.trim();
        if (referencia === '') {
            showError(referenciaInput, 'La referencia de pago es obligatoria.');
            isValid = false;
        } else if (isNaN(referencia) || parseInt(referencia) <= 0) {
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
            mensajeCargaImagen.textContent = 'Debe subir un comprobante de pago.';
            mensajeCargaImagen.style.color = 'red';
            mensajeCargaImagen.style.display = 'block';
            isValid = false;
        } else {
            const file = imagenComprobanteInput.files[0];
            const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg'];
            const maxSizeMB = 5; // 5 MB
            const maxSizeBytes = maxSizeMB * 1024 * 1024;

            if (!allowedTypes.includes(file.type)) {
                mensajeCargaImagen.textContent = 'Tipo de archivo no permitido. Solo se aceptan PNG, JPEG, JPG.';
                mensajeCargaImagen.style.color = 'red';
                mensajeCargaImagen.style.display = 'block';
                isValid = false;
            } else if (file.size > maxSizeBytes) {
                mensajeCargaImagen.textContent = `El archivo es demasiado grande. Máximo ${maxSizeMB}MB.`;
                mensajeCargaImagen.style.color = 'red';
                mensajeCargaImagen.style.display = 'block';
                isValid = false;
            }
        }

        // mensaje de error
        if (!isValid) {
            event.preventDefault();
            messageElement.classList.add('mesage_error');
            messageElement.textContent = 'Algun dato es incorrecto, por favor revisa los campos resaltados.';
        } else {
            messageElement.classList.remove('mesage_error');
            messageElement.classList.add('mesage_success');
            messageElement.textContent = 'Formulario enviado correctamente.';
        }
    });
});