<?php
// Incluir el controlador y establecer la conexión a la base de datos
require_once 'controllers/UserController.php';
require_once 'config/Database.php';
$db = Database::getInstance();
$pdo = $db->getConnection();

// Crear una instancia del controlador
$controller = new UserController($pdo);

// Ejecutar la acción correspondiente
$result = $controller->verification();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Verificacion</title>
</head>

<body style="margin: 0; padding: 0; box-sizing: border-box; font-family: 'Nunito', sans-serif;">
    <div style="padding:60px;">

        <center>
            <img src="https://i.ibb.co/1q9Tk6R/logo.png" alt="logo" border="0" width="300px" />
        </center>
        <?php
        if ($result['status'] == 'success') {
        ?>
            <p>¡Estimado <?php echo $result['name'] ?>!</p>
            <p>¡Gracias por verificar su cuenta!</p>
            <br>
            <p>Para más preguntas técnicas y soporte, contáctenos en appdislexia@gmail.com</p>
            <br>
        <?php
        } else {
        ?>
            <p><strong>Ups! algo salio mal...</strong></p>
            <p><?php echo $result['message'] ?></p>
        <?php
        }
        ?>
        <center>
            <a href="http://localhost/app/view/index.php" style="display: inline-block; padding: 10px 20px; background-color: #1457fc; color: #fff; text-decoration: none; border-radius: 8px; cursor: pointer;">
                Regresar al inicio
                <a />
        </center>

    </div>
</body>


</html>