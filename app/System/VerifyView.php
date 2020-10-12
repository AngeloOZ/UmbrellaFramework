<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body{
            font-family: sans-serif;
            width: 90%;
            margin: auto;
        }
        h1{
            padding: 0;
            margin-left: 10px;
            font-size: 20px;
        }
        .logo{
            width: 200px;
            display: flex;
            align-items: center;
            padding-left: 10px;
            margin-top: 20px;
        }
        .logo img{
            max-width: 100%;
            width: 50px;
            height: 50px;
        }
        .correo{
            font-size: 25px;
            color: #c5c5c5;
        }
        .contenido{
            /* width: 90%; */
            margin: auto;
            padding: 0 15px;
        }
        .btn{
            display: block;
            background-color: #ED1C24;
            height: 50px;
            width: 210px;
            padding-top: 15px;
            text-align: center;
            text-decoration: none;
            color: #fff;
        }
        .text{
            line-height: 25px;
        }
        .enlace{
            color: #ED1C24;
        }
    </style>
</head>
<body>
    <div class="logo">
        <img src="https://lezebre.lu/images/detailed/28/80256-sticker-Umbrella-Corporation-Resident-Evil.png" alt="logo umbrella">
        <h1>NOMBRE</h1>
    </div>
    <div class="contenido">
        <p class="correo" >correo</p>
        <p class="text">Te falta un paso para activar tu cuenta de NOMBRE. Haz clic en el siguiente botón para confirmar tu dirección de correo electrónico:</p>
        <a href="correo" class="btn">Confirmar mi correo electrónico</a>
        <p class="text">¿No funcionó? Copia el siguiente enlace en tu navegador web:</p>
        <p class="enlace">enlace</p>
        <footer>
            Saludos cordiales,<br>
            — El Equipo NOMBRE
        </footer>
    </div>
</body>
</html>