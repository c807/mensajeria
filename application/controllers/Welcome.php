<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Welcome extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->helper( 'c807' );
    }

    public function enviar_correo_rechazo($id,$texto)
    {
      
       $id="ID:".$id;
       $str=$id.' - '.$texto;
       $str=utf8_encode($str);
       $t=str_replace("%20"," ", utf8_decode($str) ); 
        $test = 	enviarCorreo( array(
            "de"         => array( "noreply@c807.com", "noreply" ),
            "para"       => array( "desarrollo@c807.com", "desarrollosv@c807.com" ),
            "asunto"     => "Solicitud rechazada",
            "texto"      => utf8_decode($t)
        ) );

      
    }
}
