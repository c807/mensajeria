<?php
    
    defined('BASEPATH') or exit('No direct script access allowed');
    
    class Ruta extends CI_Controller
    {
        public function __construct()
        {
           // session_start();
            parent:: __construct();
           
            $this->load->database();
            $this->load->model('Ruta_model');
            
            $this->mante = new Ruta_model();
        }
        public function index()
        {
            $this->datos['navtext']   = "Rutas";
            $this->datos['form']     = "ruta/contenido";
            $this->datos['vista']     = "ruta/lista";
            $this->load->view("principal", $this->datos);
        }
        public function ver_ruta($id)
        {
            $datos['result'] = $this->Ruta_model->ver_ruta($id);
            $this->load->view('ruta/form', $datos);
        }

        public function listado()
        {
            $datos['lista']    = $this->Ruta_model->rutas();
            $this->load->view('ruta/cuerpo', $datos);
        }

        public function guardar()
        {
            $codigo=$_POST['ruta'];
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

            json_encode(array('mensaje' => 'Error, al grabar ruta.'));
        }

        public function eliminar_ruta($id)
        {
            $this->Ruta_model->eliminar_ruta($id);
        }
    }
    
    /* End of file Controllername.php */
