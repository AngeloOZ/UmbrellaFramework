<?php 
    $token = json_decode(base64_decode($_GET['token']),true);
    $isValidate = CheckEmail::validateAccount($token);
    if(!$isValidate){
        die('No se pudo realizar la validacion');
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo SYSTEM_URL.'verifystyle.css'?>">
    <title>Cuenta Verificada</title>
</head>
<body>
    <main class="container">
        <h1 class="title">Hola <?php echo $token['user']['name']?>,<br/>Tu cuenta ha sido confirmada</h1>
        <a href="<?php echo URL.'home' ?>">Iniciar Sesión</a>
    </main>
</body>
</html>