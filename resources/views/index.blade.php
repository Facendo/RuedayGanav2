<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Cal+Sans&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Rubik+Mono+One&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('img/favicon-32x32.png')}}">
    <title>Rueda y Gana || Inicio</title>
</head>





<!------------------ TODO EL CONTENIDO DE LA APP  --------------------->

<body>

<!------------------------- ENCABEZADO -------------------------------->
    
    <header id="header">
        
        <nav id="menu" class="menu">
                <h2 class="titulo">RUEDA Y GANA</h2>
        </nav>
        
    
        <div class="container container_header">
            <div class="container_info container">
                
                <div class="container_logo">

                    <img src="{{asset('img/logo_ruedaygana_sf.png')}}" class="img_logo" alt="imagenlogo">

                </div>
                
                <div class="containertext_presentacion">
                    <h1 class="text_presentacion">¡RUEDA Y GANA CON NOSOTROS!</h1>

                    <p class="text_center">“Aquí no hay suerte, hay propósito. Dios guía cada jugada </p>
                    <p class="text_center">y tú solo tienes que jugar pa’ ganar.</p>
                    <br>
                    <p class="text_center">Bienvenido a donde los sueños se hacen realidad: ¡Rueda y Gana con Nosotros!”</p>

                    <a href="#" class="button button_ini">Participar</a>



                </div>
            </div>
        </div>
    
    </header>
        



<!------------------------- SECCION DE PREMIOS ------------------------->
        
        
    <section id="premios" class="container">  

    <h2 class="section_subtitle">SORTEOS DISPONIBLES</h2>
    <div class="container">
        @if(count($sorteos) > 0)
            @foreach($sorteos as $sorteo)
                @if($sorteo->sorteo_activo == 1)
                <div class="container_card">
                    <div class="card">
                        <figure>
                           @if($sorteo->sorteo_imagen)
                                <img src="{{ asset('storage/'.$sorteo->sorteo_imagen) }}" class="img_card" alt="imagen_premio">   
                            @else
                                <img src="{{ asset('img/default.webp') }}" alt="Imagen por defecto">
                            @endif
                        </figure>
                        <div class="contenido">
                            <h3 class="title_card">{{$sorteo->sorteo_nombre}}</h3>
                            <p class="text_card">{{$sorteo->sorteo_descripcion}}</p>
                            <a href="{{ route('compra', $sorteo->id_sorteo) }}" class="button">Participar</a>
                        </div>
                    </div>
                </div>
                @else
                    <div class="message_alert message">
                        <p>Los sorteos están en mantenimiento y no están disponibles en este momento.</p>
                    </div>
                @endif
            @endforeach
        @else
            <div class="message_alert message">
                <p>No hay sorteos disponibles en este momento.</p>
            </div>
        @endif
    </div>
</section>


<!----------------------- SECCION TOP DE VENTAS ----------------------------->



<section id="top_ventas">


    <h2 class="section_subtitle">TOP DE VENTAS</h2>
    <div class="container_table">
        <table class="table_top"> 
            <thead class="table_top_header">
                <tr class="tr_top">
                    <th class="th_top">Puesto</th>
                    <th class="th_top">Nombre</th>
                    <th class="th_top">Cantidad de boletos</th>
                </tr>
            </thead>
            <tbody>
            @empty(!$clientes)
                @foreach($clientes as $key => $cliente) {{-- Agregamos $key para obtener el índice --}}
                    @if($cliente->cantidad_comprados === 0)
                        @continue {{-- Si la cantidad de boletos es 0, saltamos a la siguiente iteración --}}
                    @endif
                    <tr class="tr_top">
                        <td class="td_top">
                            @if($key === 0) {{-- Verifica si es el primer elemento (índice 0) --}}
                                <img src="{{asset('img/trofeo.png')}}" alt="imagen trofeo" class="img_trofeo">
                            @endif
                        </td>
                        <td class="td_top">{{ $cliente->nombre_y_apellido }}</td>
                        <td class="td_top">{{ $cliente->cantidad_comprados }}</td>
                    </tr>
                @endforeach
            @else
                <tr class="tr_top">
                    <td class="td_top" colspan="3">No hay clientes registrados.</td>
                </tr>
            @endempty
        </tbody>
        </table>

    </div>

</section>



<!----------------------- SECCION DE CUENTAS ----------------------------->


<section id="cuentas">
        <h2 class="section_subtitle">CUENTAS</h2>

        <div class="container">
            <div class="container_card">

                <div class="card_datos">
                    <div class="container_datos">
                        <img src="{{asset('img/banesco_logo.png')}}" alt="imagenlogo" class="logo_bdv">
                        <div class="datos_pago">
                            <h3>Pago Movil Banesco</h3>
                            <p class="data">0134</p>
                            <p class="data">28.407.272</p>
                            <p class="data">0424-8676344</p>
                        </div>
                    </div>
                </div>

                <div class="card_datos">
                    <div class="container_datos">
                        <img src="{{asset('img/banplus_logo.png')}}" alt="imagenlogo" class="logo_bp">
                        <div class="datos_pago">
                            <h3>Pago Movil Banplus</h3>
                            <p class="data">0174</p>
                            <p class="data">28.588.823</p>
                            <p class="data">0412-9425624</p>
                        </div>
                    </div>
                </div>

                <div class="card_datos">
                    <div class="container_datos">

                        <img src="{{asset('img/zelle_logo.webp')}}" alt="imagenlogo" class="logo_zin">

                        <div class="datos_pago">
                            <h3>Zinli</h3>
                            <p class="data">Jesus Melean</p>
                            <p class="data">Correo: rocktoyonyo@gmail.com</p>
                        </div>
                    </div>
                </div>

                <div class="card_datos">
                    <div class="container_datos">
                        <img src="{{asset('img/binance_logo.png')}}" alt="imagenlogo" class="logo_binance">
                        <div class="datos_pago">
                            <h3>Binance</h3>
                            <p class="data">Jesus Melean</p>
                            <p class="data">Correo: rocktoyonyo@gmail.com</p>
                            <p class="data">ID: 163593375</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </section>


<!----------------------- SECCION DE REDES SOCIALES ----------------------------->
    
    
<footer id="foot">

    <div class="container">
        <div class="contenido_foot">
            
            <div class="cont_foot foot1">
                <h2 class="slogan_footer">CERTIFICACIONES</h2>
                    <img src="{{asset('img/cert.JPG')}}" class="img_cert" alt="imagenlogo">
                    <img src="{{asset('img/cert2.JPG')}}" class="img_cert" alt="imagenlogo">
                
            </div>

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
</body>
</html>
