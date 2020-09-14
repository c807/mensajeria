<?php
    
    defined('BASEPATH') or exit('No direct script access allowed');
    
    class Mensajero extends CI_Controller
    {
        public function __construct()
        {
         // session_start();
            parent:: __construct();
           
            $this->load->database();
            $this->load->model('Mensajero_model');
            
            $this->mante = new Mensajero_model();
        }
        public function index()
        {
           
            $this->datos['navtext']   = "Mensajeros";
            $this->datos['form']     = "mensajero/contenido";
            $this->datos['vista']     = "mensajero/lista";
            $this->load->view("principal", $this->datos);
        }

       
    
        
        public function ver($id)
        {
            $datos['result'] = $this->Mensajero_model->vermensajero($id);
            $this->load->view('mensajero/form', $datos);
        }

        public function listado()
        {
            $datos['lista']    = $this->Mensajero_model->mensajeros();
            $this->load->view('mensajero/cuerpo', $datos);
        }

        public function guardar()
        {
            $codigo=$_POST['mensajero'];
            $data = array(
                'nombre'          => $_POST['nombre']
            );

    
            $this->mante->guardar($codigo, $data);
            $msj = "Proceso realizado exitosamente";
            $res = "success";
            echo json_encode(
                array(
                    'msj' => $msj,
                    'res' => $res
                    )
            );

            json_encode(array('mensaje' => 'Error, al grabar mensajero.'));
        }

        public function eliminar_mensajero($id)
    {
        $this->Mensajero_model->eliminar_mensajero($id);
    }
    }
    
    /* End of file Controllername.php */