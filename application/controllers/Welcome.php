<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('c807');
    }


    public function enviar_correo_rechazo()
    {
        $para = $_SESSION['email'];
        $copia = $this->Conf_model->dtusuario($_SESSION['UserID']);
        $con_copia=$copia->mail;
      
        $id = $_POST['id_solicitud'];
        $str = $_POST['motivo_rechazo'];
        $cadena = "Buen día, por este medio se le notifica que la solicitud con número: " . "<strong>" . $id . "</strong>" . " fue " .
            "rechada por razones expuestas a continuación." . "<br><br>" . $str . "<br><br>" .
            "Por favor realice las correciones necesarias." . "<br><br>";
        $test =     enviarCorreo(array(
            "de"         => array($con_copia, $copia->nombre),
            "para"       => array($para, $con_copia),
            "asunto"     => "Solicitud de mensajería rechazada",
            "texto"      => $cadena
        ));
    }
}
