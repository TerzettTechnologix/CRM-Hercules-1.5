<?php

namespace Model;

use PHPMailer\PHPMailer\PHPMailer;
class Email{
    protected $email;
    protected $nombre;
    protected $contenido;
    public function __construct($email,$nombre,$contenido)
    {
        $this->email=$email;
        $this->nombre=$nombre;
        $this->contenido=$contenido;
    }
    public function enviarNotificacion()
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->setFrom('admin.terzett@gmail.com','Administrador');
        $mail->SMTPAuth = true;
        $mail->SMTPSecure='tls';
        $mail->Host = 'smtp.ionos.com';
        $mail->Port=587;
        $mail->Username = 'vtellez@terzett.tech';
        $mail->Password = 'uWr9H5AP3AhS8RY';
        $mail->addAddress('vtellez@terzett.tech','Victor');
        $mail->addAddress('rsilva@terzett.tech','Raul');
        $mail->Subject="Alguien hizo una retro";

        $mail->isHTML(true);
        $mail->Subject="Correo de Notificacion";
        $mail->CharSet='UTF-8';
        $contenido='<html>';
        $contenido.="<p><strong>El colaborador " .$this->nombre . " Envio una retroaliemntacion</strong></p>";
        $contenido.="<p>$this->contenido</p>";
        $mail->Body=$contenido;
        //Enviar email
        $mail->send();
        
    }
}




?>