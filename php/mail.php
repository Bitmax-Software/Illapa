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
    $mail->Host = 'jyvrepresentaciones.com';  // Coloca el host SMTP proporcionado por tu proveedor de correo
    $mail->SMTPAuth = true;
    $mail->Username = 'web@jyvrepresentaciones.com'; // Tu dirección de correo electrónico SMTP
    $mail->Password = '910Ze#1Toi.'; // Tu contraseña de correo electrónico SMTP
    $mail->SMTPSecure = 'ssl'; // Opción: tls o ssl, dependiendo de tu servidor SMTP
    $mail->Port = 465; // Puerto SMTP

    // Destinatario y remitente
    $from_email = "web@jyvrepresentaciones.com";
    $to_email = "rodrigolaracamarena@gmail.com";
    $data = json_decode(file_get_contents('php://input'), true);
    $mail->setFrom($from_email, 'JYV Representaciones'); // Remitente
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
