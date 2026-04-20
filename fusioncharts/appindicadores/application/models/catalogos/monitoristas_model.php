<?php
class Monitoristas_Model extends CI_model
{
	public function filtro($strBusqueda, $intNumRows, $intPos){
		$fechaActual= date('Y-m-d');
		$this->db->like('usuario',$strBusqueda);
		$this->db->from('usuarios as u INNER JOIN empleados as e on u.empleado_id = e.empleado_id');
		$this->db->where('u.logueado', 1);
		$this->db->where('e.puesto_id', 1);
		$res["total_rows"] = $this->db->count_all_results();

		$this->db->select("e.nombre, u.usuario_id, u.ultima_sesion, (SELECT COUNT( * ) FROM registros_accesos WHERE usuario_id = u.usuario_id AND fecha_modificacion LIKE  '%".$fechaActual."%' AND duracion >= '00:00:01' AND duracion <= '00:00:15') AS llamadas115, (SELECT COUNT( * ) FROM registros_accesos WHERE usuario_id = u.usuario_id AND fecha_modificacion LIKE  '%".$fechaActual."%' AND duracion > '00:00:15' AND duracion <= '00:00:30') AS llamadas1530, (SELECT COUNT( * ) FROM registros_accesos WHERE usuario_id = u.usuario_id AND fecha_modificacion LIKE  '%".$fechaActual."%' AND duracion > '00:00:30') AS llamadas30mas, (SELECT COUNT( * ) FROM registros_accesos WHERE usuario_id = u.usuario_id AND fecha_modificacion LIKE  '%".$fechaActual."%') AS total_llamadas, (SELECT ROUND( SUM( duracion ) /60 ) FROM registros_accesos WHERE usuario_id = u.usuario_id AND fecha_modificacion LIKE  '%".$fechaActual."%') as total_minutos, (SELECT MOD((SUM(duracion)),60) FROM registros_accesos WHERE usuario_id = u.usuario_id AND fecha_modificacion LIKE  '%".$fechaActual."%') as total_segundos, ROUND(((SELECT ROUND(SUM(duracion)) FROM registros_accesos WHERE usuario_id = u.usuario_id AND fecha_modificacion LIKE  '%".$fechaActual."%')/(SELECT COUNT( * ) FROM registros_accesos WHERE usuario_id = u.usuario_id AND fecha_modificacion LIKE  '%".$fechaActual."%'))) as promedio", FALSE);
		$this->db->from('usuarios as u INNER JOIN empleados as e on u.empleado_id = e.empleado_id');
		$this->db->where('u.logueado', 1);
		$this->db->where('e.puesto_id', 1);
		$this->db->order_by('u.ultima_sesion','desc');
		$this->db->limit($intNumRows,$intPos);
		$res["monitoristas"] =$this->db->get()->result();
		return $res;
	}

	public function filtroFechas($strBusqueda, $strFechaHoraInicio,$strFechaHoraFin, $intNumRows, $intPos){
		$fechaActual= date('Y-m-d');
		$this->db->like('usuario',$strBusqueda);
		$this->db->from('usuarios as u INNER JOIN empleados as e on u.empleado_id = e.empleado_id');
		$this->db->where('u.logueado', 1);
		$this->db->where('e.puesto_id', 1);
		$res["total_rows"] = $this->db->count_all_results();

		$this->db->select("u.usuario, u.usuario_id, u.ultima_sesion, u.logueado, e.puesto_id, (SELECT COUNT( * ) FROM registros_accesos WHERE usuario_id = u.usuario_id AND fecha_modificacion >= '".$strFechaHoraInicio."' AND fecha_modificacion <= '".$strFechaHoraFin."') AS total_llamadas, (SELECT duracion FROM registros_accesos WHERE usuario_id = u.usuario_id order by fecha_modificacion desc limit 1) as duracion_llamada, (SELECT ROUND( SUM( duracion ) /60 ) FROM registros_accesos WHERE usuario_id = u.usuario_id AND fecha_modificacion >= '".$strFechaHoraInicio."' AND fecha_modificacion <= '".$strFechaHoraFin."') as total_minutos, (SELECT MOD((SUM(duracion)),60) FROM registros_accesos WHERE usuario_id = u.usuario_id AND fecha_modificacion >= '".$strFechaHoraInicio."' AND fecha_modificacion <= '".$strFechaHoraFin."') as total_segundos, ROUND(((SELECT ROUND(SUM(duracion)) FROM registros_accesos WHERE usuario_id = u.usuario_id AND fecha_modificacion >= '".$strFechaHoraInicio."' AND fecha_modificacion <= '".$strFechaHoraFin."')/(SELECT COUNT( * ) FROM registros_accesos WHERE usuario_id = u.usuario_id AND fecha_modificacion >= '".$strFechaHoraInicio."' AND fecha_modificacion <= '".$strFechaHoraFin."'))) as promedio", FALSE);
		$this->db->from('usuarios as u INNER JOIN empleados as e on u.empleado_id = e.empleado_id');
		$this->db->where('u.logueado', 1);
		$this->db->where('e.puesto_id', 1);
		$this->db->order_by('u.ultima_sesion','desc');
		$this->db->limit($intNumRows,$intPos);
		$res["monitoristas"] =$this->db->get()->result();
		return $res;
	}

	public function filtroPrivadasMonitoristas($usuarioID,$intNumRows, $intPos){
		$fechaActual= date('Y-m-d');
		$horaActual= date('H')-1;
		if ($horaActual <10)
		{
		$horaActual= "0".$horaActual;
		}
		$fechaHoraActual = $fechaActual." ".$horaActual;
		$this->db->from('revisar_privadas as pm inner join privadas as p on p.privada_id = pm.privada_id');
		$this->db->where('pm.usuario_id', $usuarioID);
		$this->db->where('pm.estatus_id', 1);
		$this->db->like('pm.fecha_generado', $fechaHoraActual); 
		$res["total_rows"] = $this->db->count_all_results();

		$this->db->select("p.descripcion, pm.consecutivo_id, pm.estatus_id", FALSE);
		$this->db->from('revisar_privadas as pm inner join privadas as p on p.privada_id = pm.privada_id');
		$this->db->where('pm.usuario_id', $usuarioID);
		$this->db->where('pm.estatus_id', 1);
		$this->db->like('pm.fecha_generado', $fechaHoraActual); 
		$this->db->limit($intNumRows,$intPos);
		$res["registroaccesos"] =$this->db->get()->result();
		return $res;
	}

	public function cambiar_estado($intConsecutivoID, $strComentarios, $intEstatus){
		$fechaActual= date('d-m-Y');
		$horaActual= date('H')-1;
		if ($horaActual <10)
		{
		$horaActual= "0".$horaActual;
		}
		$minutosActual= date('i');
		$segundosActual= date('s');
		$fechaHoraActual = $fechaActual." ".$horaActual.":".$minutosActual.":".$segundosActual;
		$datos = array(
			'fecha_revisado' => $fechaHoraActual,
			'comentarios' => $strComentarios,
			'estatus_id' => $intEstatus,
			'usuario_id' => $this->session->userdata('usuario_id'));
		$this->db->where('consecutivo_id',$intConsecutivoID);
		$this->db->limit(1);
		$this->db->update('revisar_privadas',$datos);
		return $this->db->_error_message();
	}

	public function desloguear($intUsuarioID){
echo $intUsuarioID;
		$datos = array(
			'logueado' => 0);
		$this->db->where('usuario_id',$intUsuarioID);
		$this->db->limit(1);
		$this->db->update('usuarios',$datos);
		return $this->db->_error_message();
	}

	public function monitoristas_cmb(){
		$this->db->select('usuario_id AS value,usuario');
		$this->db->from('usuarios');
		$this->db->where('estatus_id',1);
		$this->db->order_by('usuario_id','asc');
		return $this->db->get()->result();
	}
}	
?>