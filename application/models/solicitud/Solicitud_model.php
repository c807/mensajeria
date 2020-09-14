<?php
    
    defined('BASEPATH') or exit('No direct script access allowed');
    
    class Solicitud_model extends CI_Model
    {
        public function lista_solicitud()
        {
            $query = $this->db
            ->select('so.*, co.usuario, co.nombre solicitado_por, co.nombre recibidopor, co.nombre solicitado_por, co.nombre liquidadapor,  po.nombre proceso, pr.descripcion nombre_prioridad, es.descripcion nombre_estatus, ac.descripcion nombre_actividad, me.nombre nombre_mensajero')
            ->join('csd.usuario co', 'co.usuario = so.usuario', 'inner')
            ->join('gacela.proceso po', 'po.id = so.idproceso', 'inner')
            ->join('prioridad pr', 'pr.prioridad = so.prioridad', 'inner')
            ->join('estatus es', 'es.estatus = so.estatus', 'inner')
            ->join('actividad ac', 'ac.actividad = so.actividad', 'inner')
            ->join('mensajero me', 'me.mensajero = so.mensajero', 'left')
            ->where('so.estatus !=', 8)
            ->order_by('solicitud', 'ASC')
            ->get('solicitud so')
            ->result();
            return $query;
        }


        
        public function versolicitud($id)
        {
            return $this->db->where('solicitud', $id)
                        ->get('solicitud')
                        ->row();
        }

       
        
        public function obtener_datos_file($numero_file)
        {
            return $this->db
            ->select('f.id as id, c.nit as no_identificacion')
            ->where('f.c807_file', $numero_file)
            ->join('csd.cliente as c', 'c.cliente = f.cliente', 'inner')
            ->get('gacela.file  as f')
            ->row();
        }

        public function crear_solicitud($id, $data)
        {
            if ($id) {
                $this->db->where('solicitud', $id);
                $this->db->update('solicitud', $data);
                return ($this->db->affected_rows() > 0);
            } else {
                $this->db->insert('solicitud', $data);
                return $this->db->insert_id();
            }
        }
        public function  bitacora($data){
            $this->db->insert('bitacora', $data);
            return ($this->db->affected_rows() > 0);
        }

        public function guardar_actividad($data)
        {
            $this->db->insert('detalle_actividad', $data);
            return $this->db->insert_id();
        }

        public function aceptar_rechazar($data)
        {
            $this->db
            ->set('recibido_por', $data['recibido_por'])
            ->set('fecha_recibido', $data['fecha_recibido'])
            ->set('aceptada', $data['aceptada'])
            ->set('motivo_rechazo', $data['motivo_rechazo'])
            ->set('estatus', $data['estatus'])
            ->where('solicitud', $data['solicitud'])
            ->update('solicitud');
            return ($this->db->affected_rows() > 0);
        }
        
        public function asignar_mensajero($data)
        {
            $this->db
            ->set('mensajero', $data['mensajero'])
            ->set('idtipo', $data['tipo_viaje'])
            ->set('estatus', $data['estatus'])
            ->set('idzona', $data['zona'])
            ->set('manifiesto', $data['manifiesto'])
            ->where('solicitud', $data['solicitud'])
            ->update('solicitud');
            return ($this->db->affected_rows() > 0);
        }

        public function manifiesto($data)
        {
            $this->db
            ->set('mensajero', $data['mensajero'])
            ->set('manifiesto', $data['manifiesto'])
            ->where('solicitud', $data['solicitud'])
            ->update('solicitud');
            return ($this->db->affected_rows() > 0);
        }

        
        public function entregado_mensajero($data)
        {
            $this->db
            ->set('fecha_entrega', $data['fecha_entrega'])
            ->set('hora_entrega', $data['hora_entrega'])
            ->set('nota_ent_mensajero', $data['nota_ent_mensajero'])
            ->set('fecha_ent_mensajero', $data['fecha_ent_mensajero'])
            ->set('estatus', $data['estatus'])
            ->where('solicitud', $data['solicitud'])
            ->update('solicitud');
            return ($this->db->affected_rows() > 0);
        }

        
        public function liquidar($data)
        {
            $this->db
            ->set('liquidada_por', $data['liquidada_por'])
            ->set('fecha_liquidada', $data['fecha_liquidada'])
            ->set('hora_liquidada', $data['hora_liquidada'])
            ->set('nota_liquidacion', $data['nota_liquidacion'])
            ->set('fecha_liquidacion', $data['fecha_liquidacion'])
            ->set('estatus', $data['estatus'])
            ->set('finalizado', $data['finalizado'])
            ->where('solicitud', $data['solicitud'])
            ->update('solicitud');
            return ($this->db->affected_rows() > 0);
        }

        public function cambiar_estatus($data)
        {
            $this->db
            ->set('estatus', $data['estatus'])
            ->set('nota_estatus', $data['nota'])
            ->set('finalizado', $data['finalizado'])
            ->where('solicitud', $data['solicitud'])
            ->update('solicitud');
            return ($this->db->affected_rows() > 0);
        }
        

        public function get_solicitud($id)
        {
            $query = $this->db
            ->select('co.usuario, co.nombre solicitado_por, us.nombre recibidopor,li.nombre liquidadapor, so.*, po.id, 
             po.nombre nombre_proceso, pr.prioridad, pr.descripcion nombre_prioridad, me.nombre nombre_mensajero, zo.idzona,
             ac.descripcion nombre_actividad,tu.descripcion nombre_turno')
            ->join('csd.usuario co', 'co.usuario = so.usuario', 'inner')
            ->join('gacela.proceso po', 'po.id = so.idproceso', 'inner')
            ->join('prioridad pr', 'pr.prioridad = so.prioridad', 'inner')
            ->join('actividad ac', 'ac.actividad = so.actividad', 'inner')
            ->join('csd.usuario us', 'us.usuario = so.recibido_por', 'left')
            ->join('csd.usuario li', 'li.usuario = so.liquidada_por', 'left')
            ->join('mensajero me', 'me.mensajero = so.mensajero', 'left')
            ->join('zona zo', 'zo.idzona = so.idzona', 'left')
            ->join('turno tu', 'tu.idturno = so.idturno', 'left')
            ->where('solicitud', $id)
            ->get('solicitud so')
            ->row();
    
            return $query;
        }

        public function filtro_solicitudes($desde, $hasta, $mensajero)
        { 
           
            if ($mensajero==0) {
                $query = $this->db
                ->select('so.*, co.usuario, co.nombre solicitado_por, us.nombre recibidopor,co.nombre solicitado_por, li.nombre liquidadapor,  po.nombre proceso, pr.descripcion nombre_prioridad, es.descripcion nombre_estatus, ac.descripcion nombre_actividad, me.nombre nombre_mensajero')
                ->join('csd.usuario co', 'co.usuario = so.usuario', 'inner')
                ->join('gacela.proceso po', 'po.id = so.idproceso', 'inner')
                ->join('prioridad pr', 'pr.prioridad = so.prioridad', 'inner')
                ->join('estatus es', 'es.estatus = so.estatus', 'inner')
                ->join('actividad ac', 'ac.actividad = so.actividad', 'inner')
                ->join('csd.usuario us', 'us.usuario = so.recibido_por', 'left')
                ->join('csd.usuario li', 'li.usuario = so.liquidada_por', 'left')
                ->join('mensajero me', 'me.mensajero = so.mensajero', 'left')
                ->where("so.creacion BETWEEN '{$desde}' AND '{$hasta}'")
                ->order_by('so.solicitud', 'ASC')
                ->get('solicitud so')
                ->result();
                return $query;
            } else {
                $query = $this->db
                ->select('so.*, co.usuario, co.nombre solicitado_por, us.nombre recibidopor,co.nombre solicitado_por, li.nombre liquidadapor,  po.nombre proceso, pr.descripcion nombre_prioridad, es.descripcion nombre_estatus, ac.descripcion nombre_actividad, me.nombre nombre_mensajero')
                ->join('csd.usuario co', 'co.usuario = so.usuario', 'inner')
                ->join('gacela.proceso po', 'po.id = so.idproceso', 'inner')
                ->join('prioridad pr', 'pr.prioridad = so.prioridad', 'inner')
                ->join('estatus es', 'es.estatus = so.estatus', 'inner')
                ->join('actividad ac', 'ac.actividad = so.actividad', 'inner')
                ->join('csd.usuario us', 'us.usuario = so.recibido_por', 'left')
                ->join('csd.usuario li', 'li.usuario = so.liquidada_por', 'left')
                ->join('mensajero me', 'me.mensajero = so.mensajero', 'left')
                ->where('so.mensajero', $mensajero)
                ->where("so.creacion BETWEEN '{$desde}' AND '{$hasta}'")
                ->order_by('so.solicitud', 'ASC')
                ->get('solicitud so')
                ->result();
                return $query;
            }
        }

        public function lista_asignaciones($id)
        {
            $query = $this->db
            ->select('co.usuario, co.nombre solicitado_por, us.nombre recibidopor,li.nombre liquidadapor, so.*, po.id, 
             po.nombre nombre_proceso, pr.prioridad, pr.descripcion nombre_prioridad, me.nombre nombre_mensajero, zo.idzona,
             ac.descripcion nombre_actividad,tu.descripcion nombre_turno')
            ->join('csd.usuario co', 'co.usuario = so.usuario', 'inner')
            ->join('gacela.proceso po', 'po.id = so.idproceso', 'inner')
            ->join('prioridad pr', 'pr.prioridad = so.prioridad', 'inner')
            ->join('actividad ac', 'ac.actividad = so.actividad', 'inner')
            ->join('csd.usuario us', 'us.usuario = so.recibido_por', 'left')
            ->join('csd.usuario li', 'li.usuario = so.liquidada_por', 'left')
            ->join('mensajero me', 'me.mensajero = so.mensajero', 'left')
            ->join('zona zo', 'zo.idzona = so.idzona', 'left')
            ->join('turno tu', 'tu.idturno = so.idturno', 'left')
            ->order_by('solicitud', 'ASC')
            ->where('so.mensajero', $id)
            ->where('so.estatus !=', 8)
            ->where('so.manifiesto=', 1)
            ->get('solicitud so')
            ->result();
            return $query;

        }
        public function get_file($id){

            $query = $this->db
            ->select('a.usuario_id, a.proceso_id, b.c807_file,c.nombre, d.nombre as proceso')
            ->join('gacela.file b', 'b.id = a.file_id', 'inner')
            ->join('csd.usuario c', 'c.usuario=a.usuario_id', 'inner')
            ->join('gacela.proceso d', 'd.id=a.proceso_id', 'inner')
            ->where('a.id', 10)
            ->get('gacela.file_proceso a')
            ->row();
            return $query;

        }

        public function lista_estatus($id)
        {
            $query = $this->db
            ->select('bi.*, es.descripcion nombre_estatus, u.nombre nombre_usuario')
            ->join('estatus es', 'es.estatus = bi.estatus', 'inner')
            ->join('csd.usuario u', 'u.usuario=bi.usuario', 'inner')
            ->where('bi.solicitud', $id)
            ->get('bitacora bi')
            ->result();
            return $query;
        }

    }
    /* End of file ModelName.php */
