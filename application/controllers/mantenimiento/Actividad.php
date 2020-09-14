<?php
    
    defined('BASEPATH') or exit('No direct script access allowed');
    
    class Actividad extends CI_Controller
    {
        public function __construct()
        {
            session_start();
            parent:: __construct();
           
            $this->load->database();
            $this->load->model('Actividad_model');
            
            $this->mante = new Actividad_model();
        }
        public function index()
        {
            $this->datos['navtext']   = "Actividades";
            $this->datos['form']     = "actividad/contenido";
            $this->datos['vista']     = "actividad/lista";
            $this->load->view("principal", $this->datos);
        }

       
    
        
        public function ver($id)
        {
            $datos['result'] = $this->Actividad_model->veractividad($id);
            $this->load->view('actividad/form', $datos);
        }

        public function listado()
        {
            $datos['lista']    = $this->Actividad_model->actividad();
            $this->load->view('actividad/cuerpo', $datos);
        }

        public function guardar()
        {
            $codigo=$_POST['actividad'];
            $data = array(
                'descripcion'          => $_POST['nombre']
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

            json_encode(array('mensaje' => 'Error, al grabar actividad.'));
        }

        public function eliminar_actividad($id)
        {
            $this->Actividad_model->eliminar_actividad($id);
        }
    }
    
    /* End of file Controllername.php */
