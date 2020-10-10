
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo CSS.'style.css' ?>">
    <link rel="shortcut icon" href="<?php echo FAVICON.'umbrella.ico' ?>" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/736596057b.js" crossorigin="anonymous"></script>
    <title>Umbrella - Framework</title>
</head>
<body>
    <main class="container bg-gradient">
        <div class="logo">
            <div class="img">
                <img src="<?php echo IMAGES.'umbrella.png' ?>" alt="">
            </div>
            <h1 class="title"><span class="color-404">404</span><br>Página no encontrada</h1>
        </div>
        <div class="contenido">
            <p class="text-404">Wooow entraste a una zona peligrosa y estas en riesgo de infeccion </p>
            <div class="botones">
                <a href="<?php echo URL ?>" class="btn back"><i class="fab fa-github"></i>Regresar a salvo</a>
            </div>
        </div>
        <footer>
            Desarrollado con <span>&#x2764;</span> por Angello.
        </footer>
    </main>
</body>
</html>