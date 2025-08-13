

   document.addEventListener('DOMContentLoaded', () => {
    const metodoDePagoSelect = document.getElementById('metodo_de_pago');
    const contPagoCompraDiv = document.querySelector('.data_p');

    const copyIconUrl = window.AppConfig.copyIconUrl;
    const successIconUrl = window.AppConfig.successIconUrl;
    const errorIconUrl = window.AppConfig.errorIconUrl;

    function createCopyableData(labelText, dataValue) {
        const p = document.createElement('p');
        p.classList.add('data');

        p.innerHTML = `${labelText}: <span class="copyable-text">${dataValue}</span> <img src="${copyIconUrl}" class="copy-icon" data-text="${dataValue}" alt="Copiar" title="Copiar al portapapeles">`;
        return p.outerHTML;
    }

    const detallesDePago = {
        'Pago movil Banesco': `
            <h3>Pago Móvil Banesco</h3>
            ${createCopyableData('Banco', '0134')}
            ${createCopyableData('C.I.', '28.407.272')}
            ${createCopyableData('Tlf', '0424-8676344')}
        `,
        'Pago movil Banplus': `
            <h3>Pago Móvil Banplus</h3>
            ${createCopyableData('Banco', '0174')}
            ${createCopyableData('C.I.', '28.588.823')}
            ${createCopyableData('Tlf', '0412-9425624')}
        `,
        'Zinli': `
            <h3>Zinli</h3>
            ${createCopyableData('Nombre', 'Jesus Melean')}
            ${createCopyableData('Correo', 'rocktoyonyo@gmail.com')}
        `,
        'Binance': `
            <h3>Binance</h3>
            ${createCopyableData('Nombre', 'Jesus Melean')}
            ${createCopyableData('Correo', 'rocktoyonyo@gmail.com')}
            ${createCopyableData('ID', '163593375')}
        `,
        
        'Zelle': `
            <h3>Zelle</h3>
            ${createCopyableData('Nombre', 'Aquiles Guacaran')}
            ${createCopyableData('Correo', 'Aquilesg6@gmail.com')}
            <p class="data"><b>Importante</b>: Colocar en Asunto: pago</p>
        `,
        'n': `<p>Por favor, selecciona un método de pago para ver los detalles.</p>`,
        'default': `<p>Por favor, selecciona un método de pago para ver los detalles.</p>`
    };

    metodoDePagoSelect.addEventListener('change', () => {
        const valorSeleccionado = metodoDePagoSelect.value;
        mostrarDetallesDePago(valorSeleccionado);
    });

    function mostrarDetallesDePago(metodo) {
        const contenidoAMostrar = detallesDePago[metodo] || detallesDePago['default'];
        contPagoCompraDiv.innerHTML = contenidoAMostrar;
        addCopyListeners();
    }

    function addCopyListeners() {
        const copyIcons = contPagoCompraDiv.querySelectorAll('.copy-icon');
        copyIcons.forEach(icon => {
            icon.addEventListener('click', (event) => {
                const textToCopy = event.target.dataset.text;

                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(textToCopy)
                        .then(() => {
                            const originalSrc = icon.src;
                            const originalTitle = icon.title;
                            icon.src = successIconUrl;
                            icon.title = '¡Copiado!';
                            setTimeout(() => {
                                icon.src = originalSrc;
                                icon.title = originalTitle;
                            }, 1500);
                        })
                        .catch(err => {
                            console.error('Error al copiar el texto con la API del portapapeles: ', err);
                            const originalSrc = icon.src;
                            const originalTitle = icon.title;
                            icon.src = errorIconUrl;
                            icon.title = 'Error al copiar';
                            setTimeout(() => {
                                icon.src = originalSrc;
                                icon.title = originalTitle;
                            }, 1500);
                        });
                } else {
                    // Fallback para navegadores antiguos
                    const textarea = document.createElement('textarea');
                    textarea.value = textToCopy;
                    textarea.style.position = 'fixed';
                    textarea.style.top = '0';
                    textarea.style.left = '0';
                    textarea.style.opacity = '0';
                    document.body.appendChild(textarea);
                    textarea.focus();
                    textarea.select();
                    try {
                        const successful = document.execCommand('copy');
                        if (successful) {
                            const originalSrc = icon.src;
                            const originalTitle = icon.title;
                            icon.src = successIconUrl;
                            icon.title = '¡Copiado!';
                            setTimeout(() => {
                                icon.src = originalSrc;
                                icon.title = originalTitle;
                            }, 1500);
                        } else {
                            console.error('Error al copiar el texto con execCommand.');
                            const originalSrc = icon.src;
                            const originalTitle = icon.title;
                            icon.src = errorIconUrl;
                            icon.title = 'Error al copiar';
                            setTimeout(() => {
                                icon.src = originalSrc;
                                icon.title = originalTitle;
                            }, 1500);
                        }
                    } catch (err) {
                        console.error('No se pudo copiar el texto con execCommand: ', err);
                        const originalSrc = icon.src;
                        const originalTitle = icon.title;
                        icon.src = errorIconUrl;
                        icon.title = 'Error al copiar';
                        setTimeout(() => {
                            icon.src = originalSrc;
                            icon.title = originalTitle;
                        }, 1500);
                    }
                    document.body.removeChild(textarea);
                }
            });
        });
    }

    mostrarDetallesDePago(metodoDePagoSelect.value);
});