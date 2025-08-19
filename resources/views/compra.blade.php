<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <link rel="stylesheet" href="{{asset('css/cards.css')}}">
    <link rel="stylesheet" href="{{asset('css/forms.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Cal+Sans&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Rubik+Mono+One&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('img/favicon-32x32.png')}}">
    <title>Forms</title>
</head>
<body>

<script>
    window.AppConfig = {
        copyIconUrl: "{{ asset('img/copy.png') }}", // Ruta corregida
        successIconUrl: "{{ asset('img/like.png') }}", // Ruta corregida
        errorIconUrl: "{{ asset('img/dislike.png') }}" // Ruta corregida
    };
</script>

@if (session('success'))
    <div class="message_success" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

@if ($errors->any())
    <div class="message_error" role="alert">
        <strong >¡Ups!</strong>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
    </div>
 @endif

 <div id="sorteo-data" data-precio-dolar="{{ $sorteo->precio_boleto_dolar }}" data-precio-bs="{{ $sorteo->precio_boleto_bs }}"></div>



@php
    $numeros_disponibles = json_decode($sorteo->numeros_disponibles, true);
    $cantidad_disponible = count($numeros_disponibles);
@endphp


<section id="compra" class="container container_compra">
    
    <div class="cont_form">

        <form action="{{route("cliente.store")}}" method="POST" class="cont_form" enctype="multipart/form-data">
            <input type="hidden" id="cantidad_de_tickets" name="cantidad_de_tickets" required>
            <input type="hidden" id="monto" name="monto" required>
            <div class="header">
                <h1>Seleccionar los tickets</h1>
            </div>
            @csrf
            <input type="hidden" id="id_sorteo" name="id_sorteo" value="{{$sorteo->id_sorteo}}" required>
            <div class="contador_tickets">
                <div class="container_tick">
                    <div class="selector_ticket">5 tickets</div>
                    <div class="selector_ticket">10 tickets</div>
                    <div class="selector_ticket">20 tickets</div>
                    <div class="selector_ticket">50 tickets</div>
                </div>

                <div class="cont_counter">
                    <div class="counter_btn" id="resta">-</div>
                    <div class="counter_value cant_boletos">0</div>
                    <div class="counter_btn" id="suma">+</div>
                </div>

                <h3 class="monto"></h3>

            </div>

            <div class="cont_input">
                <h2>Datos de compra</h2>

            <div class="content_form">
            <label for="cedula">Cedula:</label>
            <input type="text" placeholder="cedula" id="cedula" name="cedula" required>
            <label for="nombre_y_apellido">Nombre y Apellido:</label>
            <input type="text" placeholder="nombre y apellido" id="nombre_y_apellido" name="nombre_y_apellido" required>
            <label for="telefono">Telefono:</label>
            <input type="text" placeholder="telefono" id="telefono" name="telefono" required>
            <label for="correo">Correo:</label>
            <input type="text" placeholder="correo" id="correo" name="correo" required>

            <label>METODO DE PAGO</label>
            <div class="icons_pago">
                <img src="{{asset('img/banesco_logo.png')}}" alt="Pago Móvil Banesco" data-metodo="Pago movil Banesco">
                <img src="{{asset('img/banplus_logo.png')}}" alt="Pago Móvil Banplus" data-metodo="Pago movil Banplus">
                <img src="{{asset('img/zelle_logo.webp')}}" alt="Zelle" data-metodo="Zelle">
                <img src="{{asset('img/binance_logo.png')}}" alt="Binance" data-metodo="Binance">
                <img src="{{asset('img/zinli_logo.png')}}" alt="Zinli" data-metodo="Zinli">
            </div>
            
            <div class="data_p">
                <p>Por favor, selecciona un método de pago para ver los detalles.</p>
            </div>

            <input type="hidden" id="metodo_pago_seleccionado" name="metodo_pago_seleccionado" required>
            <input type="hidden" id="metodo_pago_seleccionado" name="metodo_de_pago" value="zili" required>

            <label for="referencia">Referencia de pago:</label>
            <input type="text" placeholder="referencia de pago" id="referencia" name="referencia" class="input_form" required>
            <label for="fecha_de_pago">Fecha de pago:</label>
            <input type="date" placeholder="fecha de pago" id="fecha_de_pago" name="fecha_de_pago" class="input_form" required>

            <label for="comprobante">SUBIR COMPROBANTE DE PAGO</label>
            <div class="carga_comprobante">
                <input type="file" id="imagen_comprobante" name="imagen_comprobante" accept="image/png, image/jpeg, image/jpg" class="input_file" required>
            </div>
            
            <button class="submit_btn button">ENVIAR</button>
        </div>

                <div class="image_section">
                    <img src="{{asset('img/rueda.jpg')}}" alt="Rueda y Gana con Nosotros">
                </div>
            </div>
            
        </form>

    </div>

</section>

<script src="{{asset('js/data_pago.js')}}"></script>

<script src="{{asset('js/manejo_tickets.js')}}"></script>



<script>
    //Funcion para precargar los datos del cliente
    const clientes= @json($clientes);

    inputCedula= document.getElementById('cedula');

   inputCedula.addEventListener('input', () => {
       const cedula = inputCedula.value;
       const cliente = clientes.find(c => c.cedula === cedula);
       if (cliente) {
           document.getElementById('nombre_y_apellido').value = cliente.nombre_y_apellido;
           document.getElementById('telefono').value = cliente.telefono;
           document.getElementById('correo').value = cliente.correo;
       }
   });
</script>


<script>
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
</script>
    
    
    <footer id="foot">

    <div class="container">
        <div class="contenido_foot">
            

            <div class="cont_foot foot2">
                <h2 class="slogan_footer">GRACIAS POR VISITAR</h2>
                <p class="text_footer">“Aquí no hay suerte, hay propósito.
Dios guía cada jugada y tú solo tienes que jugar pa’ ganar.
Bienvenido a donde los sueños se hacen realidad:
¡Rueda y Gana con Nosotros!”</p>
            </div>
            
            <div class="cont_foot foot3">
                <h2 class="slogan_footer">Redes Sociales</h2>
                <a href="https://www.instagram.com/carlitospaz0?igsh=czNscDg4dGxwejI3"><img src="{{asset('img/instagram.png')}}" alt="instagram.pnp" class="icon_contact"></a>
                <a href="https://www.tiktok.com/@enriquepaz.01?_t=ZM-8wKbc4qvL7v&_r=1"><img src="{{asset('img/tik-tok.png')}}" alt="tiktok.pnp" class="icon_contact"></a>
                <a href="https://api.whatsapp.com/send?phone=584248676344&text=Hola%2C%20Quisiera%20comunicarme%20con%20rueda%20y%20gana.com"><img src="{{asset('img/whatsapp.png')}}" alt="whatsapp.pnp" class="icon_contact"></a>
            </div>


            <div class="cont_foot foot4">
            <h2 class="slogan_footer">Consulte:</h2> <br> 

                <p class="text_footer">Antes de realizar alguna operacion, visite nuestros <br>
                     <a href="{{Route("terminos")}}" class="enlace"> Terminos y Condiciones</a> y <a href="{{Route("politica")}}"" class="enlace">Politicas de privacidad</a>
                </p>
                <br>
                <p class="text_footer">© 2025 Rueda y Gana con Nosotros. Todos los derechos reservados.</p>
                
            </div>

        </div>
    </div>

</footer>

<script src="{{ asset('js/validate.js') }}"></script>


</body>
</html>