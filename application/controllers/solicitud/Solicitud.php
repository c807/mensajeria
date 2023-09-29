<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Solicitud extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->model('solicitud/Solicitud_model');
        $this->load->model('Conf_model');
        $this->load->helper('c807');
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }


    public function index()
    {
        $op = "";
        $id = "";
        if (isset($_GET['op'])) {
            $op = $_GET['op'];
            $id = $_GET['id'];
        }

        $array = array(
            'opcion'        => $op,
            'id'        => $id,
        );

        $dato['estatus'] = $this->Conf_model->estatus();
        $dato['mensajero'] = $this->Conf_model->mensajero();
        $this->datos['navtext']   = "Gestión de Mensajería";
        $this->datos['form']     = "solicitud/contenido";
        $this->datos['opc'] = $array;
        $this->datos['vista']     = "solicitud/lista";
        $this->datos['vista1']     = "solicitud/cuerpo";
        $this->load->view("principal", $this->datos);
    }

    public function lista_solicitud()
    {
        $usuario = $_SESSION['UserID'];
        $permitido = $this->Solicitud_model->permitido($usuario);
        $datos['mensajero'] = $this->Conf_model->mensajero();
        $datos['estatus'] = $this->Conf_model->estatus();
        $datos['estatus_all'] = $this->Conf_model->estatus_all();

        if ($permitido->jefe == 1 || $permitido->supervisor == 1) {
            $datos['lista_solicitud'] = $this->Solicitud_model->lista_solicitud(1);
        } else {
            $datos['lista_solicitud'] = $this->Solicitud_model->lista_solicitud(0);
        }

        $this->load->view('solicitud/cuerpo', $datos);
    }


    public function ver($op, $id)
    {
        $datos['proceso'] = $this->Conf_model->proceso();
        $datos['colaborador'] = $this->Conf_model->colaborador();
        $datos['prioridad'] = $this->Conf_model->prioridad();
        $datos['actividad'] = $this->Conf_model->actividad();
        $datos['mensajero'] = $this->Conf_model->mensajero();
        $datos['tipo'] = $this->Conf_model->tipo();
        $datos['ruta'] = $this->Conf_model->ruta();
        $datos['turno'] = $this->Conf_model->turno();
        $datos['zona'] = $this->Conf_model->zona();

        //si $op es igual a cero(0), es porque es invocado desde ERP

        if ($op == 1) {
            $datos['file'] = $this->Solicitud_model->get_file($id);
            $_SESSION['usuario'] = $datos['file']->usuario_id;
            $_SESSION['proceso'] = $datos['file']->proceso_id;
        }
        //  var_dump($datos['file']);
        if ($op > 1) {
            $datos['datos_solicitud'] = $this->Solicitud_model->get_solicitud($id);
        }
        if ($op == 0) {
            $_SESSION['usuario'] = 0;
        }

        $this->load->view('solicitud/form', $datos);
    }

    public function crear_solicitud()
    {
        if ($_SESSION['usuario'] == 0) {
            $id_usuario = $_POST['colaborador'];
            $id_proceso = $_POST['proceso'];
        } else {
            $id_usuario = $_SESSION['UserID'];
            $id_proceso = $_SESSION['proceso'];
        }

        $actividad = $_POST["actividad"];
        $cobrada = 0;
        if (isset($_POST['cobrada'])) {
            if ($_POST['cobrada'] == 'on') {
                $cobrada = 1;
            } else {
                $cobrada = 0;
            }
        }
        $justificacion = "";
        if (isset($_POST['justificacion'])) {
            $justificacion = $_POST['justificacion'];
        }
        $valor = 0;
        if (isset($_POST['valor'])) {
            $valor = $_POST['valor'];
        }

        $documento = "";
        if (isset($_POST['documento'])) {
            $documento = $_POST['documento'];
        }
        $id = $_POST['idsolicitud'];

        $data = array(
            'file'             => $_POST['file'],
            'usuario'          => $id_usuario,
            'idproceso'        => $id_proceso,
            'cobrada'          => $cobrada,
            'justificacion'    => $justificacion,
            'costo'            => $valor,
            'fecha_sugerida'   => $_POST['fecha_sugerida'],
            'hora_sugerida'    => $_POST['hora_sugerida'],
            'prioridad'        => $_POST['prioridad'],
            'actividad'        => $_POST['actividad'],
            'documento'        => $documento,
            'consignado_a'     => $_POST['consignado_a'],
            'lugar'            => $_POST['lugar'],
            'contacto'         => $_POST['contacto'],
            'direccion'        => $_POST['direccion'],
            'idturno'          => $_POST['turno'],
            'observaciones'    => $_POST['observaciones'],
            'estatus'          => 1
        );

        $solicitud =  $this->Solicitud_model->crear_solicitud($id, $data);
        if ($id) {
        } else {
            $this->bitacora($solicitud, 1, "");
        }
    }

    public function bitacora($id, $estatus, $nota)
    {
        $datos = array(
            'solicitud'        => $id,
            'usuario'          => $_SESSION['UserID'],
            'observaciones'    => $nota,
            'estatus'          => $estatus
        );
        $bitacora =  $this->Solicitud_model->bitacora($datos);
    }
    public function aceptar_rechazar()
    {
        $aceptada = 0;
        $estatus = 0;
        if ($_POST['aceptar'] == 1) {
            $aceptada = 1;
            $estatus = 2;
        } else {
            $estatus = 3;
            $aceptada = 0;
        }

        $data = array(
            'solicitud'        => $_POST['idsolicitud'],
            'recibido_por'     => $_SESSION['UserID'],
            'fecha_recibido'   => date("Y-m-d H:i:s"),
            'aceptada'         => $aceptada,
            'motivo_rechazo'   => $_POST['motivo_rechazo'],
            'estatus'          =>    $estatus
        );

        $result = $this->Solicitud_model->aceptar_rechazar($data);
        echo $result;
        $this->bitacora($_POST['idsolicitud'], $estatus, "");
    }

    public function asignar_mensajero()
    {
        $data = array(
            'solicitud'        => $_POST['idsolicitud'],
            'mensajero'        => $_POST['mensajero'],
            'tipo_viaje'       => $_POST['tipo_viaje'],
            'zona'             => $_POST['zona'],
            'estatus'   => 4,
            'manifiesto'   => 1

        );

        $result = $this->Solicitud_model->asignar_mensajero($data);
        echo $result;
        $this->bitacora($_POST['idsolicitud'], 4, "");
    }
    public function manifiesto($solicitud, $mensajero)
    {
        $data = array(
            'solicitud'        => $solicitud,
            'mensajero'        => $mensajero,
            'manifiesto'       => 1
        );

        $result = $this->Solicitud_model->manifiesto($data);
        echo $result;
    }

    public function entregado_mensajero()
    {
        $data = array(
            'solicitud'           => $_POST['idsolicitud'],
            'fecha_entrega'       => $_POST['fecha_entrega'],
            'hora_entrega'        => $_POST['hora_entrega'],
            'nota_ent_mensajero'  => $_POST['nota_ent_mensajero'],
            'fecha_ent_mensajero' => date("Y-m-d H:i:s"),
            'estatus'             => 6
        );

        $result = $this->Solicitud_model->entregado_mensajero($data);
        echo $result;
        $this->bitacora($_POST['idsolicitud'], 6, "");
    }

    public function liquidar()
    {
        $data = array(
            'solicitud'           => $_POST['idsolicitud'],
            'liquidada_por'       => $_SESSION['UserID'],
            'fecha_liquidada'     => $_POST['fecha_liquidada'],
            'hora_liquidada'      => $_POST['hora_liquidada'],
            'nota_liquidacion'    => $_POST['nota_liquidacion'],
            'fecha_liquidacion'   => date("Y-m-d H:i:s"),
            'estatus'   => 8,
            'finalizado'   => 1
        );

        $result = $this->Solicitud_model->liquidar($data);
        echo $result;
        $this->bitacora($_POST['idsolicitud'], 8, "");
    }

    public function cambiar_estatus($id, $solicitud, $nota)
    {
        $nota = str_replace("%20", " ", $nota);
        $finalizado = 0;
        if ($id == 8) {
            $finalizado = 1;
        } else {
            $finalizado = 0;
        }
        $data = array(
            'solicitud' => $solicitud,
            'estatus'   => $id,
            'nota'   => $nota,
            'finalizado'   => $finalizado
        );

        $result = $this->Solicitud_model->cambiar_estatus($data);
        echo $result;
        $this->bitacora($solicitud, $id, $nota);
    }

    public function lista_asignaciones($id)
    {
        $datos['lista'] = $this->Solicitud_model->lista_asignaciones($id);

        include getcwd() . "/application/libraries/fpdf/fpdf.php";

        $logo = include getcwd() . "/public/img/grupocons.png";
        $this->pdf = new FPDF();
        $numero = 1;
        foreach ($datos['lista'] as $dato) {
            if ($numero == 1) {
                $this->pdf->AddPage();
            }

            $this->pdf->AliasNbPages();
            $this->pdf->SetTitle(utf8_decode("Solicitud de Mensajería"));
            $this->pdf->SetLeftMargin(10);
            $this->pdf->SetRightMargin(10);
            $this->pdf->SetFillColor(200, 200, 200);
            //  $this->pdf->SetFillColor(57, 148, 60);

            $this->pdf->SetFont('Times', 'B', 12);
            if ($numero == 1) {
                $this->pdf->Image(getcwd() . "/public/img/grupocons.png", 17, 12, -125);
            } else {
                $this->pdf->SetY(140);

                $this->pdf->Image(getcwd() . "/public/img/grupocons.png", 17, 142, -125);
            }
            $this->pdf->Cell(50, 12, '', 'TBLR', 0, 'C', '0');
            $this->pdf->SetFont('Times', 'B', 15);
            $this->pdf->Cell(95, 12, 'SOLICITUD DE MENSAJERIA', 'TBLR', 0, 'C', '0');
            $this->pdf->SetFont('Times', 'B', 12);
            $this->pdf->SetFont('Times', 'B', 10);
            $this->pdf->Cell(50, 12, "FO-TR-021 V.0 ", 'TBLR', 0, 'C', '0');
            $this->pdf->Ln(15);
            if ($numero == 1) {
                $this->pdf->Line(10, 125, 10, 22);
                $this->pdf->Line(205, 125, 205, 22);
                $this->pdf->Line(118, 52, 118, 22);
            } else {
                $this->pdf->Line(10, 254, 10, 140); //linea vertical izquierda
                $this->pdf->Line(205, 254, 205, 140); //line vetical derecha
                $this->pdf->Line(118, 182, 118, 152); //lin vertical en medio
            }

            $this->pdf->SetLeftMargin(15);
            $this->pdf->SetRightMargin(15);
            $this->pdf->SetFont('Times', 'B', 10);
            $this->pdf->Cell(20, 5, "File: ", 0, 0, 'L', 0);
            $this->pdf->SetFont('Times', '', 10);
            $this->pdf->Cell(35, 5, $dato->file, 0, 0, 'L', 0);
            $this->pdf->SetTextColor(194, 8, 8);
            $this->pdf->SetFont('Times', 'B', 15);
            $this->pdf->Cell(45, 9, "No: " . $dato->solicitud, 0, 0, 'C', '0');
            $this->pdf->SetTextColor(0, 0, 0);
            $this->pdf->SetFont('Times', 'B', 9);
            $this->pdf->Cell(65, 5, "Recibido en transporte por: ", 0, 1, 'C', 0);
            $this->pdf->SetFont('Times', 'B', 9);
            $this->pdf->Cell(20, 5, "Fecha/Hora: ", 0, 0, 'L', 0);
            $this->pdf->SetFont('Times', '', 9);
            $this->pdf->Cell(23, 5, date('d-m-Y H:i', strtotime($dato->creacion)), 0, 1, 'L', 0);
            $this->pdf->SetFont('Times', 'B', 9);
            $this->pdf->Cell(20, 5, utf8_decode("Nombre: "), 0, 0, 'L', 0);
            $this->pdf->SetFont('Times', '', 9);
            $this->pdf->Cell(87, 5, utf8_decode($dato->solicitado_por), 0, 0, 'L', 0);
            $this->pdf->SetFont('Times', 'B', 9);
            $this->pdf->Cell(20, 5, utf8_decode("Nombre: "), 0, 0, 'L', 0);
            $this->pdf->SetFont('Times', '', 9);
            $this->pdf->Cell(50, 5, utf8_decode($dato->recibidopor), 0, 1, 'L', 0);
            $this->pdf->SetFont('Times', 'B', 9);
            $this->pdf->Cell(20, 5, utf8_decode("Proceso: "), 0, 0, 'L', 0);
            $this->pdf->SetFont('Times', '', 9);
            $this->pdf->Cell(87, 5, utf8_decode($dato->nombre_proceso), 0, 0, 'L', 0);
            $this->pdf->SetFont('Times', 'B', 9);
            $this->pdf->Cell(20, 5, utf8_decode("Fecha/Hora: "), 0, 0, 'L', 0);
            $this->pdf->SetFont('Times', '', 9);
            $this->pdf->Cell(70, 5, date('d-m-Y H:i', strtotime($dato->fecha_recibido)), 0, 1, 'L', 0);
            $this->pdf->SetFont('Times', 'B', 9);
            $this->pdf->Cell(20, 5, utf8_decode("F/H sugerída: "), 0, 0, 'L', 0);
            $this->pdf->SetFont('Times', '', 9);
            $this->pdf->Cell(87, 5, date('d-m-Y', strtotime($dato->fecha_sugerida)) . " " . date('H:i', strtotime($dato->hora_sugerida)), 0, 0, 'L', 0);
            $this->pdf->SetFont('Times', 'B', 9);
            $this->pdf->Cell(40, 5, "Firma:               ___________________ ", 0, 1, 'L', 0);

            $this->pdf->Line(10, 52, 205, 52);

            $this->pdf->SetFont('Times', 'B', 12);
            $this->pdf->Cell(190, 12, "SERVICIO SOLICITADO ", 0, 1, 'C', 0);
            $this->pdf->Line(10, 60, 205, 60);
            $this->pdf->SetFont('Times', 'B', 9);
            $this->pdf->Cell(20, 5, "Prioridad: ", 0, 0, 'L', 0);
            $this->pdf->SetFont('Times', '', 9);
            $this->pdf->Cell(70, 5, utf8_decode($dato->nombre_prioridad), 0, 0, 'L', 0);
            $this->pdf->SetFont('Times', 'B', 9);
            $this->pdf->Cell(20, 5, "Lugar: ", 0, 0, 'L', 0);
            $this->pdf->SetFont('Times', '', 9);
            $this->pdf->Cell(50, 5, utf8_decode($dato->lugar), 0, 1, 'L', 0);

            $this->pdf->SetFont('Times', 'B', 9);
            $this->pdf->Cell(20, 5, utf8_decode("Actividad: "), 0, 0, 'L', 0);
            $this->pdf->SetFont('Times', '', 9);
            $this->pdf->Cell(70, 5, utf8_decode($dato->nombre_actividad), 0, 0, 'L', 0);

            $this->pdf->SetFont('Times', 'B', 9);
            $this->pdf->Cell(20, 5, "Contacto: ", 0, 0, 'L', 0);
            $this->pdf->SetFont('Times', '', 9);
            $this->pdf->Cell(50, 5, utf8_decode($dato->contacto), 0, 1, 'L', 0);

            $this->pdf->SetFont('Times', 'B', 9);
            $this->pdf->Cell(20, 5, "Documento: ", 0, 0, 'L', 0);
            $this->pdf->SetFont('Times', '', 9);
            $this->pdf->Cell(70, 5, $dato->documento, 0, 0, 'L', 0);

            $this->pdf->SetFont('Times', 'B', 9);
            $this->pdf->Cell(20, 5, utf8_decode("Dirección: "), 0, 0, 'L', 0);
            $this->pdf->SetFont('Times', '', 9);
            $this->pdf->MultiCell(85, 5, utf8_decode($dato->direccion), 0,  'L', 0);

            $this->pdf->SetFont('Times', 'B', 9);
            $this->pdf->Cell(20, 5, "Consignado a: ", 0, 0, 'L', 0);
            $this->pdf->SetFont('Times', '', 9);
            $this->pdf->Cell(70, 5, utf8_decode($dato->consignado_a), 0, 0, 'L', 0);

            $this->pdf->SetFont('Times', 'B', 9);
            $this->pdf->Cell(20, 5, "Turno: ", 0, 0, 'L', 0);
            $this->pdf->SetFont('Times', '', 9);
            $this->pdf->Cell(50, 5, utf8_decode($dato->nombre_turno), 0, 1, 'L', 0);
            $this->pdf->Ln(4);






            $this->pdf->SetFont('Times', 'B', 9);
            $this->pdf->Cell(20, 5, "OBSERVACIONES: ", 0, 1, 'L', 0);
            $this->pdf->SetFont('Times', '', 9);
            $this->pdf->MultiCell(185, 5, utf8_decode($dato->observaciones) . " / " .  utf8_decode($dato->nota_ent_mensajero) . " / " .  utf8_decode($dato->nota_liquidacion), 0,  'L', 0);
            $this->pdf->Ln(3);

            $this->pdf->SetFont('Times', 'B', 9);
            $this->pdf->Cell(18, 5, "Mensajero: ", 0, 0, 'R', 0);
            $this->pdf->SetFont('Times', '', 9);
            $this->pdf->Cell(55, 5, $dato->nombre_mensajero, 0, 0, 'L', 0);

            $this->pdf->SetFont('Times', 'B', 9);
            $this->pdf->Cell(52, 5, "Nombre quien recibe: ", 0, 0, 'R', 0);
            $this->pdf->SetFont('Times', '', 9);
            $this->pdf->Cell(70, 5, $dato->liquidadapor, 0, 1, 'L', 0);

            $this->pdf->SetFont('Times', 'B', 9);
            $this->pdf->Cell(33, 5, utf8_decode("Fecha/hora realización: "), 0, 0, 'L', 0);
            $this->pdf->SetFont('Times', '', 9);

            $this->pdf->Cell(60, 5, date('d-m-Y', strtotime($dato->fecha_entrega)) . " " . date('H:i', strtotime($dato->hora_entrega)), 0, 0, 'L', 0);

            $this->pdf->SetFont('Times', 'B', 9);
            $this->pdf->Cell(52, 5, "Fecha/hora recibido los documentos: ", 0, 0, 'L', 0);
            $this->pdf->SetFont('Times', '', 9);
            $this->pdf->Cell(50, 5, date('d-m-Y', strtotime($dato->fecha_liquidada)) . " " . date('H:i', strtotime($dato->hora_liquidada)), 0, 0, 'L', 0);

            $this->pdf->Cell(133, 5, "", 0, 0, 'L', 0);

            $this->pdf->SetFont('Times', 'B', 9);
            $this->pdf->Cell(40, 5, "Firma:_______________________ ", 0, 1, 'L', 0);


            if ($numero == 1) {
                $this->pdf->Line(10, 125, 205, 125);
            } else {
                $this->pdf->Line(10, 182, 205, 182);
                $this->pdf->Line(10, 190, 205, 190);
                $this->pdf->Line(10, 254, 205, 254);
            }
            $this->pdf->Ln(9);
            $this->pdf->SetLeftMargin(10);
            $this->pdf->SetRightMargin(10);
            $numero = $numero + 1;
            if ($numero > 2) {
                $numero = 1;
            }

            $this->pdf->Ln(15);
            $this->pdf->SetLeftMargin(10);
            $this->pdf->SetRightMargin(10);
        }


        $this->pdf->AddPage();
        $this->pdf->AliasNbPages();
        $this->pdf->SetLeftMargin(10);
        $this->pdf->SetRightMargin(10);
        $this->pdf->SetFillColor(200, 200, 200);
        $this->pdf->SetFont('Arial', 'B', 7);

        $correla = 1;
        $X = 0;
        foreach ($datos['lista'] as $item) {
            if ($x == 0) {
                $this->pdf->Ln(5);
                $this->pdf->SetFont('Arial', 'B', 12);
                $this->pdf->Image(getcwd() . "/public/img/grupocons.png", 17, 12, -125);
                $this->pdf->Cell(180, 7, 'RUTA DE ASIGNACIONES', 0, 0, 'C', '0');
                $this->pdf->SetFont('Arial', '', 7);
                $this->pdf->Cell(10, 7, utf8_decode('Página:') . $this->pdf->PageNo() . '/{nb}', 0, 0, 'C', '0');
                $this->pdf->Ln(9);
                $this->pdf->SetTextColor(0, 0, 0);
                $this->pdf->Cell(160, 5, "MENSAJERO: " . $item->nombre_mensajero . "  " . 'FECHA: ' . date('d-m-Y'), 0, 1, 'L', 0);

                $this->pdf->Ln(1);
                $this->pdf->Cell(04, 7, '#', 'BT', 0, 'C', '0');
                $this->pdf->Cell(15, 7, 'ID', 'BT', 0, 'C', '');
                $this->pdf->Cell(15, 7, 'F. Solicitud', 'BT', 0, 'C', '0');
                $this->pdf->Cell(63, 7, 'Cliente', 'BT', 0, 'L', '0');
                $this->pdf->Cell(62, 7, 'Lugar', 'BT', 0, 'L', '0');
                $this->pdf->Cell(25, 7, 'Requerimiento', 'BT', 0, 'L', '0');
                $this->pdf->Cell(15, 7, 'Estatus', 'BT', 0, 'L', '0');
                $this->pdf->Ln(9);
            }
            $this->pdf->SetTextColor(0, 0, 0);
            $fs = $item->creacion;
            $fs = date('d-m-Y', strtotime($fs));
            $this->pdf->Cell(04, 5, $correla, 0, 0, 'C', 0);
            $this->pdf->Cell(15, 5, $item->solicitud, 0, 0, 'C', 0);
            $this->pdf->Cell(15, 5, $fs, 0, 0, 'L', 0);
            $this->pdf->Cell(63, 5, utf8_decode($item->consignado_a), 0, 0, 'L', 0);
            $this->pdf->Cell(62, 5, utf8_decode($item->lugar), 0, 0, 'L', 0);
            $this->pdf->Cell(30, 5, utf8_decode($item->nombre_actividad), 0, 0, 'L', 0);
            $this->pdf->Cell(5, 5, " ", 'TBLR', 0, 'R', 0);
            $this->pdf->Ln(9);
            $x += 1;
            $correla = $correla + 1;
        }
        $this->pdf->Ln(9);
        $this->pdf->SetFont('Times', 'B', 9);
        $this->pdf->Cell(180, 5, "RECIBIDO POR:_______________________ ", 0, 0, 'C', 0);


        $this->pdf->Output('asignaciones.pdf', 'f');
    }


    public function imprimir_solicitud($id)
    {
        $dato = $this->Solicitud_model->get_solicitud($id);

        //echo $datos->usuario;

        include getcwd() . "/application/libraries/fpdf/fpdf.php";
        $logo = include getcwd() . "/public/img/grupocons.png";


        $this->pdf = new FPDF();
        $this->pdf->AddPage();
        $this->pdf->AliasNbPages();
        $this->pdf->SetTitle(utf8_decode("Solicitud de Mensajería"));
        $this->pdf->SetLeftMargin(10);
        $this->pdf->SetRightMargin(10);
        $this->pdf->SetFillColor(200, 200, 200);
        //  $this->pdf->SetFillColor(57, 148, 60);

        $this->pdf->SetFont('Times', 'B', 12);
        $this->pdf->Image(getcwd() . "/public/img/grupocons.png", 17, 12, -125);


        //  $this->pdf->SetTextColor(255, 255, 255);
        $this->pdf->Cell(50, 12, '', 'TBLR', 0, 'C', '0');
        $this->pdf->SetFont('Times', 'B', 15);
        $this->pdf->Cell(95, 12, 'SOLICITUD DE MENSAJERIA', 'TBLR', 0, 'C', '0');
        $this->pdf->SetFont('Times', 'B', 12);

        $this->pdf->SetFont('Times', 'B', 10);
        $this->pdf->Cell(50, 12, "FO-TR-021 V.0 ", 'TBLR', 0, 'C', '0');
        // $this->pdf->SetTextColor(0, 0, 0);

        $this->pdf->Ln(15);
        // $this->pdf->line(10, $this->pdf->GetX()+10,200, $this->pdf->GetX()+10);
        //  $this->pdf->line(10, $this->pdf->GetY()+10,200, $this->pdf->GetY()+10);

        // $this->pdf->SetDrawColor(188,188,188);
        //$this->pdf->Line(10,30,200,30);
        $this->pdf->Line(10, 125, 10, 22);
        $this->pdf->Line(205, 125, 205, 22);

        $this->pdf->Line(118, 52, 118, 22);
        //  $this->pdf->Line(margen izq, tamaño de liena (msu), margen iz, margen superior);

        $this->pdf->SetLeftMargin(15);
        $this->pdf->SetRightMargin(15);

        $this->pdf->SetFont('Times', 'B', 10);
        $this->pdf->Cell(20, 5, "File: ", 0, 0, 'L', 0);
        $this->pdf->SetFont('Times', '', 10);
        $this->pdf->Cell(35, 5, $dato->file, 0, 0, 'L', 0);

        $this->pdf->SetTextColor(194, 8, 8);
        $this->pdf->SetFont('Times', 'B', 15);
        $this->pdf->Cell(45, 9, "No: " . $dato->solicitud, 0, 0, 'C', '0');
        $this->pdf->SetTextColor(0, 0, 0);


        $this->pdf->SetFont('Times', 'B', 9);
        $this->pdf->Cell(65, 5, "Recibido en transporte por: ", 0, 1, 'C', 0);

        $this->pdf->SetFont('Times', 'B', 9);
        $this->pdf->Cell(20, 5, utf8_decode("Fecha/Hora: "), 0, 0, 'L', 0);
        $this->pdf->SetFont('Times', '', 9);
        $this->pdf->Cell(23, 5, date('d-m-Y H:i', strtotime($dato->creacion)), 0, 1, 'L', 0);


        $this->pdf->SetFont('Times', 'B', 9);
        $this->pdf->Cell(20, 5, utf8_decode("Nombre: "), 0, 0, 'L', 0);
        $this->pdf->SetFont('Times', '', 9);
        $this->pdf->Cell(87, 5, utf8_decode($dato->solicitado_por), 0, 0, 'L', 0);


        $this->pdf->SetFont('Times', 'B', 9);
        $this->pdf->Cell(20, 5, utf8_decode("Nombre: "), 0, 0, 'L', 0);
        $this->pdf->SetFont('Times', '', 9);
        $this->pdf->Cell(50, 5, utf8_decode($dato->recibidopor), 0, 1, 'L', 0);



        $this->pdf->SetFont('Times', 'B', 9);
        $this->pdf->Cell(20, 5, utf8_decode("Proceso: "), 0, 0, 'L', 0);
        $this->pdf->SetFont('Times', '', 9);
        $this->pdf->Cell(87, 5, utf8_decode($dato->nombre_proceso), 0, 0, 'L', 0);

        $this->pdf->SetFont('Times', 'B', 9);
        $this->pdf->Cell(20, 5, utf8_decode("Fecha/Hora: "), 0, 0, 'L', 0);
        $this->pdf->SetFont('Times', '', 9);
        if (is_null($dato->fecha_recibido)) {
            $fecha_recibido = "";
        } else {
            $fecha_recibido = date('d-m-Y H:i', strtotime($dato->fecha_recibido));
        }

        $this->pdf->Cell(70, 5,  $fecha_recibido, 0, 1, 'L', 0);

        $this->pdf->SetFont('Times', 'B', 9);
        $this->pdf->Cell(20, 5, utf8_decode("F/H sugerída: "), 0, 0, 'L', 0);
        $this->pdf->SetFont('Times', '', 9);
        $this->pdf->Cell(87, 5, date('d-m-Y', strtotime($dato->fecha_sugerida)) . " " . date('H:i', strtotime($dato->hora_sugerida)), 0, 0, 'L', 0);

        $this->pdf->SetFont('Times', 'B', 9);
        $this->pdf->Cell(40, 5, "Firma:               ___________________ ", 0, 1, 'L', 0);

        $this->pdf->Line(10, 52, 205, 52);
        $this->pdf->SetFont('Times', 'B', 12);
        $this->pdf->Cell(190, 12, "SERVICIO SOLICITADO ", 0, 1, 'C', 0);
        $this->pdf->Line(10, 60, 205, 60);


        $this->pdf->SetFont('Times', 'B', 9);
        $this->pdf->Cell(20, 5, "Prioridad: ", 0, 0, 'L', 0);
        $this->pdf->SetFont('Times', '', 9);
        $this->pdf->Cell(70, 5, utf8_decode($dato->nombre_prioridad . "    " . "Cobro: $ " . $dato->costo), 0, 0, 'L', 0);


        $this->pdf->SetFont('Times', 'B', 9);
        $this->pdf->Cell(20, 5, "Lugar: ", 0, 0, 'L', 0);
        $this->pdf->SetFont('Times', '', 9);
        $this->pdf->Cell(50, 5, $dato->lugar, 0, 1, 'L', 0);

        $this->pdf->SetFont('Times', 'B', 9);
        $this->pdf->Cell(20, 5, utf8_decode("Actividad: "), 0, 0, 'L', 0);
        $this->pdf->SetFont('Times', '', 9);
        $this->pdf->Cell(70, 5, utf8_decode($dato->nombre_actividad), 0, 0, 'L', 0);

        $this->pdf->SetFont('Times', 'B', 9);
        $this->pdf->Cell(20, 5, "Contacto: ", 0, 0, 'L', 0);
        $this->pdf->SetFont('Times', '', 9);
        $this->pdf->Cell(50, 5, utf8_decode($dato->contacto), 0, 1, 'L', 0);

        $this->pdf->SetFont('Times', 'B', 9);
        $this->pdf->Cell(20, 5, "Documento: ", 0, 0, 'L', 0);
        $this->pdf->SetFont('Times', '', 9);
        $this->pdf->Cell(70, 5, $dato->documento, 0, 0, 'L', 0);

        $this->pdf->SetFont('Times', 'B', 9);
        $this->pdf->Cell(20, 5, utf8_decode("Dirección: "), 0, 0, 'L', 0);
        $this->pdf->SetFont('Times', '', 9);
        $this->pdf->MultiCell(85, 5, utf8_decode($dato->direccion), 0,  'L', 0);

        $this->pdf->SetFont('Times', 'B', 9);
        $this->pdf->Cell(20, 5, "Consignado a: ", 0, 0, 'L', 0);
        $this->pdf->SetFont('Times', '', 9);
        $this->pdf->Cell(70, 5, utf8_decode($dato->consignado_a), 0, 0, 'L', 0);

        $this->pdf->SetFont('Times', 'B', 9);
        $this->pdf->Cell(20, 5, "Turno: ", 0, 0, 'L', 0);
        $this->pdf->SetFont('Times', '', 9);
        $this->pdf->Cell(50, 5, utf8_decode($dato->nombre_turno), 0, 1, 'L', 0);
        $this->pdf->Ln(4);

        $this->pdf->SetFont('Times', 'B', 9);
        $this->pdf->Cell(20, 5, "OBSERVACIONES: ", 0, 1, 'L', 0);
        $this->pdf->SetFont('Times', '', 9);
        $this->pdf->MultiCell(185, 5, utf8_decode($dato->observaciones) . " / " .  utf8_decode($dato->nota_ent_mensajero) . " / " .  utf8_decode($dato->nota_liquidacion), 0,  'L', 0);
        $this->pdf->Ln(3);


        //$this->pdf->Line(10, 103, 205, 103);


        $this->pdf->SetFont('Times', 'B', 9);
        $this->pdf->Cell(18, 5, "Mensajero: ", 0, 0, 'R', 0);
        $this->pdf->SetFont('Times', '', 9);
        $this->pdf->Cell(55, 5, utf8_decode($dato->nombre_mensajero), 0, 0, 'L', 0);

        $this->pdf->SetFont('Times', 'B', 9);
        $this->pdf->Cell(52, 5, "Nombre quien recibe: ", 0, 0, 'R', 0);
        $this->pdf->SetFont('Times', '', 9);
        $this->pdf->Cell(70, 5, utf8_decode($dato->liquidadapor), 0, 1, 'L', 0);


        $this->pdf->SetFont('Times', 'B', 9);
        $this->pdf->Cell(33, 5, utf8_decode("Fecha/hora realización: "), 0, 0, 'L', 0);
        $this->pdf->SetFont('Times', '', 9);

        if (is_null($dato->fecha_entrega)) {
            $fecha_entrega = "";
            $hora_entrega = "";
        } else {
            $fecha_entrega = date('d-m-Y H:i', strtotime($dato->fecha_entrega));
            $hora_entrega = date('H:i', strtotime($dato->hora_entrega));
        }

        $this->pdf->Cell(60, 5, $fecha_entrega . " " . $hora_entrega, 0, 0, 'L', 0);

        $this->pdf->SetFont('Times', 'B', 9);
        $this->pdf->Cell(52, 5, "Fecha/hora recibido los documentos: ", 0, 0, 'L', 0);
        $this->pdf->SetFont('Times', '', 9);

        if (is_null($dato->fecha_liquidada)) {
            $fecha_liquidada = "";
            $hora_liquidada = "";
        } else {
            $fecha_liquidada = date('d-m-Y H:i', strtotime($dato->fecha_liquidada));
            $hora_liquidada = date('H:i', strtotime($dato->hora_liquidada));
        }
        $this->pdf->Cell(50, 5, $fecha_liquidada . " " . $hora_liquidada, 0, 0, 'L', 0);

        $this->pdf->Cell(133, 5, "", 0, 0, 'L', 0);

        $this->pdf->SetFont('Times', 'B', 9);
        $this->pdf->Cell(40, 5, "Firma:_______________________ ", 0, 0, 'L', 0);

        $this->pdf->Line(10, 125, 205, 125);
        $this->pdf->Ln(9);


        // $this->pdf->Output($archivo.'.pdf', 'D');
        $this->pdf->Output('solicitud.pdf', 'f');
    }

    public function filtro_solicitudes($desde, $hasta, $mensajero, $estatus)
    {
        $usuario = $_SESSION['UserID'];
        $permitido = $this->Solicitud_model->permitido($usuario);

        $hasta = date("Y-m-d", strtotime($hasta . "+ 1 days"));
        $datos['mensajero'] = $this->Conf_model->mensajero();
        $datos['estatus_all'] = $this->Conf_model->estatus_all();
        $datos['estatus'] = $this->Conf_model->estatus();

        if ($permitido->jefe == 1 || $permitido->supervisor == 1) {
            $datos['lista_solicitud']    = $this->Solicitud_model->filtro_solicitudes($desde, $hasta, $mensajero, $estatus, 1);
        } else {
            $datos['lista_solicitud']    = $this->Solicitud_model->filtro_solicitudes($desde, $hasta, $mensajero, $estatus, 0);
        }
        $this->load->view('solicitud/cuerpo', $datos);
    }


    public function lista_estatus($id)
    {
        $this->datos['lista']    = $this->Solicitud_model->lista_estatus($id);
        $this->load->view("solicitud/lista_bitacora", $this->datos);
    }
    public function permitir()
    {
        $bandera = 0;
        $usuario = $_SESSION['UserID'];
        $permitido = $this->Solicitud_model->permitido($usuario);
        if ($permitido->jefe == 1 || $permitido->supervisor == 1) {
            $bandera = 1;
        } else {
            $bandera = 0;
        }
        echo json_encode($bandera);
    }
    public function verificar_estatus($id)
    {
        $rsl = $this->Solicitud_model->get_solicitud($id);
        echo $rsl->estatus;
    }

    public function confirmar_facturacion($id)
    {
        $rsl = $this->Solicitud_model->confirmar_facturacion($id);
        return $rsl;
    }

    public function pendientes_facturar()
    {
        $datos['lista_solicitud']    = $this->Solicitud_model->pendientes_facturar();
        //  var_dump($datos['lista_solicitud']);
        $this->load->view('solicitud/cuerpo', $datos);
    }
}
    
    /* End of file Controllername.php */