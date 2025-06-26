<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Cal+Sans&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Rubik+Mono+One&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('img/favicon-32x32.png')}}">
    <title>Manejo de Tickets</title>
</head>
<body>

 <nav id="menu" class="menu">
     <h2 class="titulo">Gestion de Tickets</h2>
 </nav>

    <section class="container">
           
        <div class="section_tickets">
            <div>
                <form action="{{route('ticket.store')}}" method="POST" class="form" id="form">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="id_sorteo" value="{{$sorteo->id_sorteo}}">
                    <input type="hidden" name="cedula_cliente" value="{{$cliente->cedula}}">
                    <input type="hidden" name="nombre_cliente" value="{{$cliente->nombre}}">
                    <input type="hidden" name="telefono_cliente" value="{{$cliente->telefono}}">
                    <input type="hidden" name="correo_cliente" value="{{$cliente->correo}}">
                    <input type="hidden" name="id_pago" value="{{$pago->id_pago}}">
                    <input type="hidden" name="numeros_seleccionados" id="numeros_seleccionados">
                    <button type="button" onclick="enviarTickets()" id="boton_enviar_tickets" class="button">Generar Tickets Seleccionados</button>
                     
                </form>
            </div>
            

            <div class="container_tickets">
                
                <h2 class="section_subtitle">Selecciona los tickets para el sorteo {{$sorteo->sorteo_nombre}}</h2>
                <p>Tickets comprados: <span id="cantidad_comprada">{{ $pago->cantidad_de_tickets }}</span></p>
                <p>Tickets seleccionados: <span id="contador_seleccionados">0</span></p>
                <p id="mensaje_validacion" style="color: red;"></p>
                <form id="form_seleccionar_tickets" class="form_tickets">
                    <div class="numeros_tickets">
                        @csrf
                        @php
                            $numeros_disponibles = json_decode($sorteo->numeros_disponibles);
                        @endphp
                        @foreach ($numeros_disponibles as $numero )

                            <input type="checkbox" name="numeros[]" value="{{$numero}}" id="numero_{{$numero}}" class="input_checkbox checkbox_ticket" onchange="actualizarContador()">
                            <label for="numero_{{$numero}}" class="button lbl_check">{{$numero}}</label>
                        @endforeach
                    </div>
                </form>
            </div>

            <div class="cont_tickets_selector">

                <h2 class="section_subtile">GESTIONA TICKETS</h2>

                <h3 class="sub_inp">Bloquear Numero</h3>
                <div class="cont_form">
                    <form action="{{route('ticket.bloquear',$sorteo)}}" class="form" method="POST" enctype="multipart/form-data">
                        <h2>Bloquear Tickets</h2>
                        @csrf
                        @method('PUT')

                        <input type="number" name="numero_a_bloquear" id="numero_a_bloquear" placeholder="Bloquear Numero" class="input_form" min="0" max="9999">

                        <br>

                        <button type="submit" class="button">Bloquear Numero</button>
                    </form>
                </div>

                <br><br><br><br><br><br><br><br><br><br>

                <div class="cont_form">
                    <form action="{{route('ticket.desbloquear',$sorteo)}}" class="form" method="post">
                        @csrf
                        @method('PUT')
                        <h3 class="sub_inp">Desbloquear tickets</h3>
                        <select name="numero_a_desbloquear" id="numero_a_desbloquear" class="input_select">
                            @php
                                $numeros_ganadores = json_decode($sorteo->numeros_ganadores);
                            @endphp
                            @if ($numeros_ganadores != null)
                                @foreach($numeros_ganadores as $numero)
                                    <option value="{{$numero}}" class="input_option">{{$numero}}</option>
                                @endforeach
                            @else
                                <option value="" class="input_option">No hay numeros ganadores</option>
                            @endif
                        </select>
                        <button type="submit" class="button">Desbloquear</button>
                    </form>
                </div>

                <br><br><br><br><br><br><br><br><br><br>


                <div class="cont_form">
                    <form action="{{route('ticket.store')}}" class="form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_sorteo" value="{{$sorteo->id_sorteo}}">
                        <input type="hidden" name="cedula_cliente" value="{{$cliente->cedula}}">
                        <input type="hidden" name="nombre_cliente" value="{{$cliente->nombre}}">
                        <input type="hidden" name="telefono_cliente" value="{{$cliente->telefono}}">
                        <input type="hidden" name="correo_cliente" value="{{$cliente->correo}}">
                        <input type="hidden" name="id_pago" value="{{$pago->id_pago}}">
                        <input type="hidden" name="numeros_seleccionados" id="numeros_seleccionados" value="aleatorio">
                        <h3 class="sub_inp">Generar tickets aleatorios</h3>
                        <button class="button" >Generar</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        const cantidadComprada = parseInt(document.getElementById('cantidad_comprada').textContent);
        const contadorSeleccionadosElement = document.getElementById('contador_seleccionados');
        const mensajeValidacionElement = document.getElementById('mensaje_validacion');
        const botonEnviarTickets = document.getElementById('boton_enviar_tickets');
        const checkboxes = document.querySelectorAll('.checkbox_ticket');
        const numerosDisponiblesJSON = `{!! json_encode($sorteo->numeros_disponibles) !!}`;
        const numerosDisponibles = JSON.parse(numerosDisponiblesJSON);

        function actualizarContador() {
            const seleccionados = document.querySelectorAll('input[name="numeros[]"]:checked').length;
            contadorSeleccionadosElement.textContent = seleccionados;

            if (seleccionados > cantidadComprada) {
                mensajeValidacionElement.textContent = 'Has excedido la cantidad de tickets comprados.';
                botonEnviarTickets.disabled = true;
            } else if (seleccionados < cantidadComprada) {
                mensajeValidacionElement.textContent = 'Debes seleccionar la cantidad exacta de tickets comprados.';
                botonEnviarTickets.disabled = true;
            } else {
                mensajeValidacionElement.textContent = '';
                botonEnviarTickets.disabled = false;
            }
        }

        function enviarTickets() {
            const seleccionados = document.querySelectorAll('input[name="numeros[]"]:checked').length;
            if (seleccionados === cantidadComprada) {
                const checkboxes = document.querySelectorAll('input[name="numeros[]"]:checked');
                const numerosSeleccionados = Array.from(checkboxes).map(checkbox => checkbox.value);
                document.getElementById('numeros_seleccionados').value = JSON.stringify(numerosSeleccionados);
                document.getElementById('form').submit();
            } else {
                alert('Por favor, selecciona la cantidad exacta de tickets comprados.');
            }
        }

        function generarTicketAleatorio() {
           

            if (numerosDisponibles && numerosDisponibles.length > 0) {
                const ticketsAleatorios = [];
                                const indicesUsados = new Set(); // Para evitar duplicados

                                while (ticketsAleatorios.length < cantidadComprada && indicesUsados.size < numerosDisponibles.length) {
                                    const indiceAleatorio = Math.floor(Math.random() * numerosDisponibles.length);
                                    if (!indicesUsados.has(indiceAleatorio)) {
                                        ticketsAleatorios.push(numerosDisponibles[indiceAleatorio]);
                                        indicesUsados.add(indiceAleatorio);
                                        const checkbox = document.getElementById(`numero_${numerosDisponibles[indiceAleatorio]}`);
                                        if (checkbox) {
                                            checkbox.checked = true;
                                        }
                                    }
                                }
                                actualizarContador(); // Actualizar el contador después de marcar los checkboxes
                            } else {
                                alert('No hay números de tickets disponibles para generar.');            }

                        }

                        // Inicializar el contador al cargar la página
                        actualizarContador();
    </script>

</body>
</html>