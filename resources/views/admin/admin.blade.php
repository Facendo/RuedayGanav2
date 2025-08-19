<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> -->
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <link rel="stylesheet" href="{{asset('css/cards.css')}}">
    <link rel="stylesheet" href="{{asset('css/forms.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Cal+Sans&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Rubik+Mono+One&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('img/favicon-32x32.png')}}">

    <title>Panel de Administrador</title>
</head>
<body>
    
    <style>
    body{
        background: rgb(35, 35, 35);
    }
</style>




<!--------------- TABLA DE GESTION  ---------->

<nav id="menu" class="menu">
    <h2 class="titulo">Panel administrador</h2>
</nav>
    
    <div class="filtro_admin">
        {{-- Filtrador para la tabla de pagos de boletos --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class='button'>Cerrar Sesión</button>
        </form>
        <a href="{{route('admin.showticket')}}" class="button">Tickets vendidos</a>
    </div>

    
    <div class="cont_modal">

        <div class="x_modal">
            <img src="{{asset('img/x.png')}}" alt="" >
        </div>
        <div class="container_edit">
            <h2>Editar Sorteo</h2>
            <div class="cont_form">
                <form action="" class="form_reg_sorteo form" method="POST" enctype="multipart/form-data">
                    <h3 class="sub_inp">Editar sorteo</h3>
                    @csrf
                    <label for="sorteo_nombre">Nombre:</label>
                    <input type="text" name="sorteo_nombre" id="sorteo_nombre" placeholder="Nombre del sorteo" class="input_form" require>
                    <label for="sorteo_fecha_inicio">Fecha de inicio:</label>
                    <input type="date" name="sorteo_fecha_inicio" id="sorteo_fecha_inicio" placeholder="Fecha de inicio del sorteo" class="input_form" require>
                    <label for="sorteo_fecha_fin">Fecha de fin:</label>
                    <input type="date" name="sorteo_fecha_fin" id="sorteo_fecha_fin" placeholder="Fecha de fin del sorteo" class="input_form" require>
                    <label for="sorteo_descripcion">Descripcion:</label>
                    <input type="text" name="sorteo_descripcion" id="sorteo_descripcion" placeholder="Descripcion del sorteo" class="input_form" require>

                    <label for="precio_boleto_bs">Precio boleto (bs):</label>
                    <input type="text" name="precio_boleto_bs" id="precio_boleto_bs" placeholder="Precio del boleto en bolivares" class="input_form" require>
                    <label for="precio_boleto_dolar">Precio boleto (dolar):</label>
                    <input type="text" name="precio_boleto_dolar" id="precio_boleto_dolar" placeholder="Precio del boleto en dolares" class="input_form" require>
                    <label for="sorteo_imagen" class="file">Imagen:</label>
                    <input type="file" name="sorteo_imagen" id="sorteo_imagen" placeholder="Imagen del sorteo" class="input_file" accept="image/*" require>
                    
                    <br>

                    <button type="submit" class="btn_reg_sorteo button">Registrar sorteo</button>
                </form>
            </div>
        </div>
    </div>


    <script>


const modal = document.querySelector('.cont_modal');
const closeButton = document.querySelector('.x_modal');
const openButton = document.querySelector('.button_edit'); 

openButton.addEventListener('click', (e)=>{
    e.preventDefault();
})

function openModal(event) {
    if (event) {
        event.preventDefault(); 
    }
    
    modal.style.transform = 'translateX(0)';
    modal.style.display = 'block';
    
}

function closeModal() {
    modal.style.transform = 'translateX(110%)';
    setTimeout(() => {
        modal.style.display = 'none';
    }, 500);
}

if (openButton) {
    openButton.addEventListener('click', openModal);
}

closeButton.addEventListener('click', closeModal);

window.addEventListener('click', (event) => {
    if (event.target === modal) {
        closeModal();
    }
});

    </script>
    

    <div id="section_ventas_admin" class="container section_ventas">
        <h2 class="section_subtitle">Tabla de pagos de boletos</h2>

        <div class="container_table">
            <table id="table_gestion" class="table_gestion">
                <thead>
                    <tr>
                        <th>Cedula</th>
                        <th>Telefono</th>
                        <th>Referencia</th>
                        <th>Comprobante</th>
                        <th>Monto</th>
                        <th>Cantidad de Tickets</th>
                        <th>Fecha pago</th>
                        <th>Metodo de pago</th>
                        <th>Estado de pago</th>
                        <th>Acciones</th>
                        <th>Tickets</th>
                    </tr>
                </thead>
                        
                <tbody>
                    @foreach($pagos as $pago)
                            
                    <tr>
                        <td>{{ $pago->cedula_cliente }}</td>
                        <td>{{ $pago->nro_telefono }}</td>
                        <td>{{ $pago->referencia }} </td>
                        <td>
                        <form action="{{route('admin.showcomprobante')}}" method="POST" enctype="multipart/form-data">
                                @csrf  
                                <input type="hidden" name="id_pago" value="{{$pago->id_pago}}">
                            <button class="button" type="submit">Referencia</button>
                            </form>
                        
                        </td>
                        <td>{{ $pago->monto }}</td>
                        <td>{{ $pago->cantidad_de_tickets }}</td>
                        <td>{{ $pago->fecha_pago }}</td>
                        <td>{{ $pago->metodo_de_pago}}</td>
                        <td>{{ $pago->estado_pago }}</td>
                        <td>
                            <form action="" method="POST">	
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button button_edit">Editar</button>
                            </form>
                        </td>
                        <td>
                        @if ($pago->estado_pago == 'Confirmado')
                                <label class="button" disabled>Asignado</label>
                            @else
                                <a href="{{route('ticket.index',['id_pago'=>$pago->id_pago])}}" class="button">Asignar</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
                
            </table>
        </div>
    </div>
    

    

     <div class="pagination">
           {{ $pagos->links() }} 
    </div>
    
    
    <br><br><br><br><br><br><br><br><br><br>





    <!------------------ REGISTRAR SORTEO --------------------->

    <h2 class="section_subtitle">REGISTRAR SORTEO</h2>
    <div class="container_reg">
            <div class="cont_form">
                <form action="{{route('sorteo.store')}}" class="form_reg_sorteo form content_form" method="POST" enctype="multipart/form-data">
                    <div class="header">
                        <h1>Registra sorteo</h1>
                    </div>
                    @csrf
                    <label for="sorteo_nombre">Nombre:</label>
                    <input type="text" name="sorteo_nombre" id="sorteo_nombre" placeholder="Nombre del sorteo" class="input_form" require>
                    <label for="sorteo_fecha_inicio">Fecha de inicio:</label>
                    <input type="date" name="sorteo_fecha_inicio" id="sorteo_fecha_inicio" placeholder="Fecha de inicio del sorteo" class="input_form" require>
                    <label for="sorteo_fecha_fin">Fecha de fin:</label>
                    <input type="date" name="sorteo_fecha_fin" id="sorteo_fecha_fin" placeholder="Fecha de fin del sorteo" class="input_form" require>
                    <label for="sorteo_descripcion">Descripcion:</label>
                    <input type="text" name="sorteo_descripcion" id="sorteo_descripcion" placeholder="Descripcion del sorteo" class="input_form" require>

                    <label for="precio_boleto_bs">Precio boleto (bs):</label>
                    <input type="text" name="precio_boleto_bs" id="precio_boleto_bs" placeholder="Precio del boleto en bolivares" class="input_form" require>
                    <label for="precio_boleto_dolar">Precio boleto (dolar):</label>
                    <input type="text" name="precio_boleto_dolar" id="precio_boleto_dolar" placeholder="Precio del boleto en dolares" class="input_form" require>
                    <label for="sorteo_imagen" class="file">Imagen:</label>
                    <input type="file" name="sorteo_imagen" id="sorteo_imagen" placeholder="Imagen del sorteo" class="input_file" accept="image/*" require>
                    
                    <br>

                    <button type="submit" class="btn_reg_sorteo button submit_btn">Registrar sorteo</button>
                </form>
            </div>
        
    </div>


    <!--------- TABLA DE SORTEOS  --------->

    <div id="section_ventas_admin" class="container">
        <h2 class="section_subtitle">TABLA DE SORTEOS</h2>
        <div class="container_table">
            <table id="table_gestion" class="table_gestion">
                <thead>
                    <tr>
                        <th>ID sorteo</th>
                        <th>Nombre del sorteo</th>
                        <th>Descripcion</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de fin</th>
                        <th>Tickets Disponibles</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sorteos as $sorteo)
                    <tr>
                        <td>{{ $sorteo->id_sorteo }}</td>
                        <td>{{ $sorteo->sorteo_nombre }}</td>
                        <td>{{ $sorteo->sorteo_descripcion }}</td>
                        <td>{{ $sorteo->sorteo_fecha_inicio }}</td>
                        <td>{{ $sorteo->sorteo_fecha_fin }}</td>
                        @php
                         $numeros_disponibles = json_decode($sorteo->numeros_disponibles, true);
                         $cantidad_disponible = count($numeros_disponibles);
                        @endphp
                        <td>{{$cantidad_disponible}}</td>
                        <td>
                            <form action={{route('sorteo.cambio_estado',$sorteo->id_sorteo)}} method="POST">	
                                @csrf
                                @method('PUT')
                                @if ($sorteo->sorteo_activo == 1)
                                    <button type="submit" class="button">Desactivar</button>
                                @else
                                    <button type="submit" class="button">Activar</button>
                                @endif
                            </form>
                            <form action={{route('sorteo.destroy',$sorteo)}} method="POST">	
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <!------------------ Asignacion de Premios ---------------------> 



<h2 class="section_subtitle">Asignar Premios</h2>
<div class="container_reg">
    
            <div class="cont_form">
                <form action="{{route('premio.store')}}" class="form_reg_sorteo form content_form" method="POST" enctype="multipart/form-data">
                    <div class="header">
                        <h1>Asigna premios</h1>
                    </div>
                    @csrf
                   
                        
                     
                    <div>
                    <label for="opcion">Sorteos</label>
                    <select id="Sorteo" name="id_sorteo" class="input_select">
                        @foreach ($sorteos as $sorteo)
                        <option value="{{$sorteo->id_sorteo}}"class="input_option">{{$sorteo->sorteo_nombre}}</option>
                        @endforeach    
                    </select>
                   
                    </div>
                     
                    <label for="premio_nombre">Nombre del premio:</label>
                    <input type="text" name="premio_nombre" id="premio_nombre" placeholder="Nombre premio" class="input_form">
                    <label for="premio_descripcion">Descripcion del premio:</label>
                    <input type="text" name="premio_descripcion" id="premio_descripcion" placeholder="Descripcion premio" class="input_form">
                    <label for="premio_imagen" class="file">Imagen del premio:</label>
                    <input type="file" name="premio_imagen" id="premio_imagen" placeholder="Imagen de premio" class="input_file">
                    <br>
                    <button type="submit" class="btn_reg_sorteo button submit_btn">Registrar Premio</button>
                </form>
            </div>
    </div>
<br><br><br><br>

    <script>
        
        const buttons = document.querySelectorAll('.button_ref');
        const modal = document.querySelector('.container_modal');
        const closeModal = document.querySelector('.container_modal');

       
        buttons.forEach(button => {
        button.addEventListener('click', () => {
            modal.style.left = "0%";
        });
    });

        closeModal.addEventListener('click', function() {
            closeModal.style.left= '-100%';
        });
    </script>
        
</body>
</html>