<?php
ob_start();
session_start();

if (!isset($_SESSION["studentID"])) {
    header("Location: index.php");
} else {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../lib/toastify-js/toastify.css" />
    <title>DislexiaApp</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        #container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            width: 500px;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        p {
            color: #555;
        }

        .options {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .option-button {
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 130px;
            margin: 5px;
            text-decoration: none;
        }

        .option-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div id="container">
        <h1>Bienvenido/a</h1>
        <p>Hola <?php echo $_SESSION['userName']?>, gracias por visitar DislexiaApp. Realiza la prueba de cribado y determina el riesgo de tener dificultades de lecto-escritura..</p>
        <div class="options">
            <a href="test.php?id=<?php echo $_SESSION["studentID"];?>" class="option-button">Hacer prueba</a>
            <a href="testResult.php?id=<?php echo $_SESSION["studentID"];?>" class="option-button" style="background-color: green;">Ver resultados</a>
            <a class="option-button" style="background-color: red;" id="Salir">Salir</a>
        </div>
    </div>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="../lib/toastify-js/toastify.js"></script>
<script>

Salir.addEventListener('click', ()=>{
    close();
})
    async function close(){
    let formData = new FormData();
    formData.append('controller', 'user')
    formData.append('action', 'logout')

    await $.ajax({
        type: "post",
        url: "../indexRequest.php",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            console.log(response)
            if (response.status = 'success') {
                Toastify({
                    text: response.message,
                    duration: 1000,
                    style: {
                        background: "linear-gradient(to right, #22c55e, #15803d)",
                    }
                }).showToast();
                setTimeout(() => {
                    $(location).attr("href", "index.php");
                }, 1000);
            } else {
                
            }
        }
    });
}
</script>
<?php
}
ob_end_flush();
?>