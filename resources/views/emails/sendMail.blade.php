<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Cal+Sans&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Rubik+Mono+One&display=swap" rel="stylesheet">
    <title>Correo</title>
</head>
<body>
    <div style="width: 100%;">
        <h2 style="font-family: Arial; color: #333;">¡Gracias por participar, {{$nombre}}!</h2>
        <p style="font-family: Arial;">tu numero de ticket asignado es:</p>
        <div style="width: 90%; padding: 15px; margin: 0 auto; background-color: rgb(220, 220, 200); display: flex; justify-content: center; align-items: center; border-radius: 10px;">
            @foreach ($numeros as $numero)
                <h1 style="color: gold;">-{{$numero}}</h1>
            @endforeach
        </div>
        <br>
        <p style="font-family: Arial;">NO BORRES ESTE CORREO ELECTRONICO!</p>
        <p style="font-family: Arial;">Alguna duda, comuníquese a nuestras redes sociales.</p>
        <br>
        <p style="font-family: Arial;">Te deseamos la mejor de las suertes. Gracias por apoyar nuestros sorteos. ¡Recuerda seguirnos en Instagram para estar pendiente de los ganadores!</p>
        <p style="font-family: Arial;">¡Te deseamos mucha suerte y bendiciones!</p>
        <br>
        <p style="color: gray;">— Rueda y Gana con Nosotros</p>
    </div>
</body>
</html>