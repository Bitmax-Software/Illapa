<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Instancia de PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'localhost';  // Coloca el host SMTP proporcionado por tu proveedor de correo
    $mail->SMTPAuth = true;
    $mail->Username = 'web@illapagroup.com.pe'; // Tu dirección de correo electrónico SMTP
    $mail->Password = '*2RpAo^424hhOO'; // Tu contraseña de correo electrónico SMTP
    $mail->SMTPSecure = 'none'; // Opción: tls o ssl, dependiendo de tu servidor SMTP
    $mail->Port = 25; // Puerto SMTP

    // Destinatario y remitente
    $from_email = "web@illapagroup.com.pe";
    $to_email = "administration@illapagroup.com.pe";
    $data = json_decode(file_get_contents('php://input'), true);
    $mail->setFrom($from_email, 'Illapa'); // Remitente
    $mail->addAddress($to_email); // Destinatario
    $mail->isHTML(true); // Formato HTML

    // Contenido del mensaje
    $subject = 'Mensaje desde la Pagina Web';
    $messageBody = "";

    if($data['name']!='nope'){
        $messageBody .= '<p><strong>Nombre y Apellido:</strong> ' . $data["name"] . '</p>' . "<br>";
    }
    if($data['email']!='nope'){
        $messageBody .= '<p><strong>Correo:</strong> ' . $data['email'] . '</p>' . "<br>";
    }
        
    if($data['message']!='nope'){
        $messageBody .= '<p><strong>Consulta:</strong> ' . $data['message'] . '</p>' . "<br>";
    }

    $mail->Subject = $subject;
    $mail->Body = "<html><body>" . $messageBody . "</body></html>";

    echo $mail->Body; // Esto imprimirá el contenido HTML generado


    // Envío del correo
    $mail->send();
    echo 'Mail sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
