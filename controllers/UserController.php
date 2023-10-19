<?php
require_once 'dao/UserDAO.php';
require_once 'lib/phpmailer/PHPMailer.php';
require_once 'lib/phpmailer/SMTP.php';
require_once 'lib/phpmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class UserController
{
    private $userDAO;

    public function __construct($db)
    {
        $this->userDAO = new UserDAO($db);
    }

    public function registerUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userName = isset($_POST['userName']) ? $_POST['userName'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            $institution = isset($_POST['institution']) ? $_POST['institution'] : '';

            // Validaciones de datos
            if (empty($userName) || empty($email) || empty($password)  || empty($institution)) {
                $response = ['status' => 'error', 'message' => 'Todos los campos son obligatorios.'];
                return $response;
            }

            $user = $this->userDAO->validateEmail($email);

            if ($user) {
                $response = ['status' => 'error', 'message' => 'Ya existe una cuenta con este email, si tienes algun problema comunicate con appdislexia@gmail.com'];
                return $response;
            }

            // Crear el usuario
            $UserId = $this->userDAO->createUser($userName, $email, $password, $institution);

            if ($UserId != NULL) {
                $Code = bin2hex(random_bytes(32));
                $result = $this->userDAO->createVerification($UserId, $userName, $Code);
                if ($result) {
                    if ($this->sendEmail($email, $userName, $Code, $UserId)) {
                        $response = ['status' => 'success', 'message' => 'Usuario registrado correctamente, se le ha enviado un email para verificar su cuenta.'];
                    } else {
                        $response = ['status' => 'error', 'message' => 'No se pudo registrar el usuario.'];
                    }
                } else {
                    $response = ['status' => 'error', 'message' => 'No se pudo registrar el usuario.'];
                }
            } else {
                $response = ['status' => 'error', 'message' => 'No se pudo registrar el usuario.'];
            }

            return $response;
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';

            // Validaciones de datos
            if (empty($email) || empty($password)) {
                $response = ['status' => 'error', 'message' => 'Debes proporcionar un correo y una contraseña.'];
                return $response;
            }

            // Inicio de sesión
            $user = $this->userDAO->login($email, $password);

            if ($user) {
                //Validar que este activo
                if ($user['IsActive'] != 1) {
                    $response = ['status' => 'error', 'message' => 'El usuario se encuentra temporalmente desabilitado'];
                    return $response;
                }

                //Validar que este verificada la cuenta
                if ($user['IsVerified'] != 1) {
                    $response = ['status' => 'error', 'message' => 'El usuario no ha activado la cuenta, revisa tu bandeja de correos e inlcuso en spam'];
                    return $response;
                }
                // Iniciar sesión en PHP
                session_start();
                $_SESSION['user_id'] = $user['UserID'];
                $_SESSION['user_name'] = $user['UserName'];

                $response = ['status' => 'success', 'message' => 'Inicio de sesión exitoso.'];
            } else {
                $response = ['status' => 'error', 'message' => 'Credenciales incorrectas.'];
            }

            return $response;
        }
    }

    public function logout()
    {
        // Cerrar la sesión
        session_start();
        session_destroy();
        $response = ['status' => 'success', 'message' => 'Sesión cerrada.'];
        return $response;
    }

    public function verification()
    {
        $Code = isset($_GET['Code']) ? $_GET['Code'] : '';
        $UserId = isset($_GET['UserID']) ? $_GET['UserID'] : '';

        // Validaciones de datos
        if (empty($Code) || empty($UserId)) {
            $response = ['status' => 'error', 'message' => 'Comunicate con appdislexia@gmail.com para verificar que salio mal'];
            return $response;
        }

        // Confirma al usuario
        $name = $this->userDAO->confirmVerification($UserId, $Code);

        if ($name != NULL) {
            $response = ['status' => 'success', 'name' => $name];
        } else {
            $response = ['status' => 'error', 'message' => 'Comunicate con appdislexia@gmail.com para verificar que salio mal'];
        }

        return $response;
    }


    private function sendEmail($email, $name, $code, $id)
    {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {

            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'appdislexia@gmail.com';                     //SMTP username
            $mail->Password   = 'rkwbrwquabbqjnfw';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            // Configuración del remitente y del destinatario
            $mail->setFrom('appdislexia@gmail.com', 'Verificacion de cuenta');
            $mail->addAddress($email, $name);


            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Verificacion de cuenta';
            $mail->Body = '<!DOCTYPE html>
            <html lang="es">
            
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <title>Verificacion</title>
            </head>
            
            <body style="margin: 0; padding: 0; box-sizing: border-box; font-family: "Nunito", sans-serif;">
                <div style="padding:60px;">
                    <center>
                        <img src="https://i.ibb.co/1q9Tk6R/logo.png" alt="logo" border="0" width="300px" />
                    </center>
                    <p>¡Estimado usuario!</p>
                    <br>
                    <p>¡Gracias por elegir Dislexia App!</p>
                    <br>
                    <p>Confirme su dirección de correo electrónico para ayudarnos a garantizar que su cuenta esté siempre protegida.
                    </p>
                    <br>
                    <br>
                    <center>
                            <a href="http://localhost/app/verification.php?Code=' . $code . '&UserID=' . $id . '" style="display: inline-block; padding: 10px 20px; background-color: #1457fc; color: #fff; text-decoration: none; border-radius: 8px; cursor: pointer;">
                                Verifique su correo electrónico
                            <a />
                    </center>
                    <br><br>
                    <p>Para más preguntas técnicas y soporte, contáctenos en appdislexia@gmail.com</p>
                    <br><br>
                    <p>¡Esperamos cooperar con usted!</p>
                    <br><br>
                    <p>Atentamente,</p>
                    <p>Equipo Dislexia App</p>
                    <br><br>
                    <br><br>
            
                </div>
            </body>
            
            
            </html>';


            $mail->CharSet = 'UTF-8';
            $mail->send();

            return true;
        } catch (Exception $e) {
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }
}
