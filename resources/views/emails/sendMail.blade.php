<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> -->
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Cal+Sans&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Rubik+Mono+One&display=swap" rel="stylesheet">
    <title>Correo</title>

</head>

<style>

.cont{
    width: 100%;
    
}
.cont_num_mail{
    width: 90%;
    padding: 15px;
    margin: 0 auto;
    background-color: rgb(220, 220, 200);
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 10px;
}

h1{
    font-family: Arial;
}

.mail_p{
    font-family: "Roboto Mono", monospace;
}

.title_mail{
    font-family: "Alfa Slab One", serif;
}

</style>

<body>

    <div class="cont">
                <h2 class="title_mail" style='color: #333;'>¡Gracias por participar, {{$nombre}}!</h2>
                <p class="mail_p">tu numero de ticket asignado es:</p>
                <div class="cont_num_mail">
                    @foreach ($numeros as $numero)
                        <h1 style='color: gold;'>-{{$numero}}</h1>
                    @endforeach
                </div>
                <br>
                
                <p class="mail_p">NO BORRES ESTE CORREO ELECTRONICO!</p>
                <p class="mail_p">Alguna duda, comuníquese a nuestras redes sociales.</p>
                <br>
                <p class="mail_p">Te deseamos la mejor de las suertes. Gracias por apoyar nuestros sorteos. ¡Recuerda seguirnos en Instagram para estar pendiente de los ganadores!</p>
                <p class="mail_p">¡Te deseamos mucha suerte y bendiciones!</p>
                <br>
                <p style='color: gray;'>— Rueda y Gana con Nosotros</p>
    </div>
    
</body>
</html>