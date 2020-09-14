<?php
    
    defined('BASEPATH') or exit('No direct script access allowed');
    
    class Comision extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
                 
            $this->load->database();
            $this->load->model('comision/Comision_model');
            $this->load->model('Conf_model');
        }
        
    
        public function index()
        {
            $this->datos['navtext']   = "Gestión de Comisiones";
            $this->datos['form']     = "comision/contenido";
            $this->datos['vista']     = "comision/lista";
            $this->load->view("principal", $this->datos);
        }
        
        public function comision_lista()
        {
            $datos['mensajero']= $this->Conf_model->mensajero();
            $this->load->view('comision/cuerpo', $datos);
        }

        public function listado_comisiones($desde, $hasta, $mensajero)
        {
            $datos['mensajero']= $this->Conf_model->mensajero();
            $datos['lista_comision']    = $this->Comision_model->listado_comisiones($desde, $hasta, $mensajero);
            $this->load->view('comision/cuerpo', $datos);
        }

        
        public function autoriza_pago($solicitud, $valor)
        {
            if ($valor==0) {
                $aplica=0;
            } else {
                $aplica=1;
            }
           
            $data = array(
                'solicitud'        => $solicitud,
                'valor_comision'   => $valor,
                'aplica_comision'  => $aplica );
         
            $result=$this->Comision_model->autoriza_pago($data);
            echo $result ;
        }


        
        public function agregar_detalle($solicitud, $valor, $detalle)
        {
            if ($valor==0) {
                $aplica=0;
            } else {
                $aplica=1;
            }
           
            $data = array(
                'solicitud'        => $solicitud,
                'valor_comision'   => $valor,
                'aplica_comision'  => $aplica,
                'detalle'          => $detalle
            );
         
            $result=$this->Comision_model->agregar_detalle($data);
            echo $result ;
        }

        public function imprimir_comision($desde, $hasta, $mensajero)
        {
                   
                $dato['listamensajero']    = $this->Comision_model->listadomensajero($desde, $hasta, $mensajero);
           
            include getcwd() . "/application/libraries/fpdf/fpdf.php";
            $logo=include getcwd() . "/public/img/grupocons.png";
            $this->pdf = new FPDF();
            foreach ($dato['listamensajero'] as $row) {
          
                $datos['lista']  = $this->Comision_model->listado_comisiones($desde, $hasta, $row->mensajero);
                $this->pdf->AddPage();
                $this->pdf->AliasNbPages();
                $this->pdf->SetLeftMargin(10);
                $this->pdf->SetRightMargin(10);
                $this->pdf->SetFillColor(200, 200, 200);
                $this->pdf->SetFont('Arial', 'B', 7);

                
                $this->pdf->Ln(5);
                $this->pdf->SetFont('Arial', 'B', 12);
                $this->pdf->Image(getcwd() . "/public/img/grupocons.png", 17, 12, -125);
                $this->pdf->Cell(190, 7, 'REPORTE DE COMISIONES POR MENSAJERO', 0, 0, 'C', '0');
                $this->pdf->SetFont('Arial', '', 7);
                $this->pdf->Cell(5, 7, utf8_decode('Página:'). $this->pdf->PageNo() . '/{nb}', 0, 0, 'R', '0');
                $this->pdf->Ln(9);
                $this->pdf->SetTextColor(0, 0, 0);

                $this->pdf->Cell(168, 5, "MENSAJERO: ". utf8_decode($row->nombre_mensajero) , 0, 0, 'L', 0);
                $this->pdf->Cell(20, 5, 'FECHA: '. date('d/m/Y'), 0, 1, 'L', 0);
               
                $this->pdf->Ln(1);
                $this->pdf->Cell(07, 7, '#', 'BT', 0, 'C', '0');
                $this->pdf->Cell(15, 7, 'ID', 'BT', 0, 'C', '');
                $this->pdf->Cell(20, 7, 'F. Solicitud', 'BT', 0, 'L', '0');
                $this->pdf->Cell(50, 7, 'Cliente', 'BT', 0, 'L', '0');
                $this->pdf->Cell(50, 7, 'Lugar', 'BT', 0, 'L', '0');
                $this->pdf->Cell(10, 7, 'Valor', 'BT', 0, 'R', '0');
                $this->pdf->Cell(05, 7, '', 'BT', 0, 'R', '0');
                $this->pdf->Cell(35, 7, 'Detalle', 'BT', 0, 'L', '0');
                $this->pdf->Ln(9);
                $correla=1;
                $suma=0;
                foreach ($datos['lista'] as $item) {
                    if ($item->valor_comision>0) {
                        $suma=$suma+$item->valor_comision;
                        $this->pdf->SetTextColor(0, 0, 0);
                        $fs=$item->creacion;
                        $fs= date('d/m/Y', strtotime($fs));
                        $this->pdf->Cell(07, 5, $correla, 0, 0, 'C', 0);
                        $this->pdf->Cell(15, 5, $item->solicitud, 0, 0, 'C', 0);
                        $this->pdf->Cell(20, 5, $fs, 0, 0, 'L', 0);
                        $this->pdf->Cell(50, 5, utf8_decode($item->consignado_a), 0, 0, 'L', 0);
                        $this->pdf->Cell(50, 5, utf8_decode($item->lugar), 0, 0, 'L', 0);
                        $this->pdf->Cell(11, 5, $item->valor_comision, 0, 0, 'R', 0);
                        $this->pdf->Cell(05, 5, "", 0, 0, 'R', 0);
                        $this->pdf->Cell(35, 5, $item->detalle, 0, 1, 'L', 0);
                    
                        $correla++;
                    }
                }
                
                $this->pdf->SetDrawColor(188,188,188);
                $this->pdf->Cell(142, 5, "",'BT', 0, 'R', 0);
                $this->pdf->SetFont('Arial', 'B', 8);
                $this->pdf->Cell(11, 5, "TOTAL: ".number_format($suma,2), 'BT', 0, 'R', 0);
                $this->pdf->SetFont('Arial', 'B', 7);
                $this->pdf->Cell(40, 5, "", 'BT', 0, 'R', 0);
                $this->pdf->SetDrawColor(0,0,0);

                $this->pdf->Ln(20);
                $this->pdf->Cell(105, 7,    "REVISADO:__________________________", '0', 0, 'C', 0);
                $this->pdf->Cell(100, 7, "AUTORIZADO:__________________________", '0', 0, 'L', 0);
            }
            $this->pdf->Output('comision.pdf', 'f');
        }
    }
    
    /* End of file Controllername.php */
