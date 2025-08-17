<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\..\resources\css\styles.css">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <link rel="stylesheet" href="{{asset('css/cards.css')}}">
    <link rel="stylesheet" href="{{asset('css/forms.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Cal+Sans&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Rubik+Mono+One&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('img/favicon-32x32.png')}}">
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <title>Compra</title>
</head>

<body>
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

<script>
    window.AppConfig = {
        copyIconUrl: "{{ asset('img/copy.png') }}", // Ruta corregida
        successIconUrl: "{{ asset('img/like.png') }}", // Ruta corregida
        errorIconUrl: "{{ asset('img/dislike.png') }}" // Ruta corregida
    };
</script>

@php
    $numeros_disponibles = json_decode($sorteo->numeros_disponibles, true);
    $cantidad_disponible = count($numeros_disponibles);
@endphp

 <nav id="menu" class="menu">
    <h2 class="titulo">Compra de tickets</h2>
 </nav>


 
 
<h2 class="section_subtitle">REGISTRAR COMPRA</h2>



<section id="cuentas">

        <div class="barra_cont">
            <p class="text_compra">
                <h3>Leer (IMPORTANTE)</h3> <br>
            Tu pago será verificado manualmente por nuestro equipo en las próximas horas.
Una vez confirmado, recibirás tus boletos del sorteo directamente en el correo que registraste.
<br><br>
<b>Recuerda:</b>
<br>
	•	Si pagaste por PagoMóvil, Zinli o Binance, asegúrate de enviar el comprobante.  <br>
	•	Mantente pendiente de tu bandeja de entrada (y también revisa el correo no deseado). <br>
    •	Si al pasar de las 48 horas y no te ha llegado los tickets, escribe a soporte 📲 <br><br>

🙏 Que Dios bendiga tu suerte.
¡Rueda y gana con nosotros! 🏍️💨
        </p>
    </div>

    <br><br>

    

    <script src="{{asset('js/manejo_tickets.js')}}"></script>
        


</section>

<br><br><br><br>    




<section id="compra" class="container container_compra">
        <div class="cont_form cont_form_compra">
 
            <form action="{{route("cliente.store")}}" method="POST" class="form" enctype="multipart/form-data" class="form">
                <h2>ingrese sus datos</h2>
                @csrf
                <input type="hidden" id="id_sorteo" name="id_sorteo" value="{{$sorteo->id_sorteo}}" required>
                <div class="container_tick">
                    <div class="selector_ticket"><p>5 tickets</p></div>
                    <div class="selector_ticket"><p>10 tickets</p></div>
                    <div class="selector_ticket"><p>20 tickets</p></div>
                    <div class="selector_ticket"><p>30 tickets</p></div>
                    <div class="selector_ticket"><p>50 tickets</p></div>
                </div>
                <br>
                

                <div class="barra_cont">
        
                    <div class="calc_pago">
                        
                        <div class="cont_element_calc">
                            <div class="btn_calc button" id="resta">-</div>
                        </div>

                        <div class="cont_element_calc">
                            <div class="cont_cant_boletos"><h3 class="cant_boletos">0</h3></div>
                        </div>
                        
                        <div class="cont_element_calc">
                            <div class="btn_calc button" id="suma">+</div>
                        </div>
                        
                        
                    </div>
                    <h3 class="monto"></h3>
                </div>


                <label for="cedula">Cedula:</label>
                <input type="text" placeholder="cedula" id="cedula" name="cedula" class="input_form" required>
                <label for="nombre_y_apellido">Nombre y Apellido:</label>
                <input type="text" placeholder="nombre y apellido" id="nombre_y_apellido" name="nombre_y_apellido" class="input_form" required>
                <label for="telefono">Telefono:</label>
                <input type="text" placeholder="telefono" id="telefono" name="telefono" class="input_form" required>
                <label for="correo">Correo:</label>
                <input type="text" placeholder="correo" id="correo" name="correo" class="input_form" required>
                
                <div>
                    <label for="metodo_de_pago">Metodo de pago</label>
                    <select id="metodo_de_pago" name="metodo_de_pago" class="input_select"  required>
                        <option value="n" class="input_option">Ninguno</option>
                        <option value="Pago movil Banesco" class="input_option">Pago Movil Banesco</option>
                        <option value="Pago movil Banplus" class="input_option">Pago Movil Banplus</option>
                        <option value="Zinli" class="input_option">Zinli</option>
                        <option value="Binance" class="input_option">Binance</option>
                        <option value="Zelle" class="input_option">Zelle</option>
                    </select>
                </div>
                <div class="cont_pago_compra">
                    <div class="datos_pago data_p">
                        
                    </div>

                </div>
                <br>

                
                <input type="hidden" id="cantidad_de_tickets" name="cantidad_de_tickets" class="input_form"  required min="1" max="{{$cantidad_disponible}}">
                <input type="hidden"  id="monto" name="monto" class="input_form" required>


                
                <label for="referencia">Referencia de pago:</label>
                <input type="text" placeholder="referencia de pago" id="referencia" name="referencia" class="input_form" required>
                <label for="fecha_de_pago">Fecha de pago:</label>
                <input type="date" placeholder="fecha de pago" id="fecha_de_pago" name="fecha_de_pago" class="input_form" required>
                
                <div>
                    <label for="">Subir comprobante de pago</label>
                    <label for="imagen_comprobante" class="file">Click para enviar comprobante de pago</label>
                    <input type="file" id="imagen_comprobante" name="imagen_comprobante" accept="image/png, image/jpeg, image/jpg" class="input_file"  required>
                    <p id="mensajeCargaImagen" style="display:none; margin-top: 5px; font-size: 0.9em;"></p>
                </div>
                <button class="button btn_modal" type="submit">Enviar</button>

                <div id="message">
                    
                </div>
                
            </form>
        </div>
</section>

<script src="{{asset('js/data_pago.js')}}"></script>


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