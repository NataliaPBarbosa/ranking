<?php defined('BASEPATH') OR exit('No direct script access allowed');

class geral_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	function getParticipantes($inicio = null, $offset = null){
		$this->db->select("participantes.id, participantes.nome, participantes.descricao, participantes.foto, COUNT(case when votos.voto = 1 then 1 else null end) as votos_like, COUNT(case when votos.voto = 0 then 1 else null end) as votos_dislike, COUNT(votos.id) as total_votos, ((COUNT(case when votos.voto = 1 then 1 else null end)/COUNT(votos.id))*100) as p_like, ((COUNT(case when votos.voto = 0 then 1 else null end)/COUNT(votos.id))*100) as p_dislike");
		$this->db->join("votos", "votos.participante_id = participantes.id", "LEFT");
		$this->db->order_by("p_like", "DESC");
		$this->db->group_by("participantes.id");
		$this->db->limit($offset, $inicio);
		return $this->db->get("participantes");
	}

	function getParticipante($id){
		$this->db->select("participantes.id, participantes.nome, participantes.foto, participantes.descricao");
		$this->db->where("id", $id);
		return $this->db->get("participantes");
	}

	function cadastrar_participante($dados = null){
		if($dados != null){
			$dados["date_insert"] = date("Y-m-d H:i:s");
			$dados["date_update"] = date("Y-m-d H:i:s");
			$this->db->insert("participantes", $dados);
			return $this->db->insert_id();
		}
	}

	function update_participante($dados = null, $id){
		if($dados != null){
			$foto_antiga = $dados["foto_antiga"];
			unset($dados["foto_antiga"]);
			if($foto_antiga != "")
				@unlink("./assets/images/participantes/$foto_antiga");
			$dados["date_update"] = date("Y-m-d H:i:s");
			$this->db->where("id", $id);
			return $this->db->update("participantes", $dados);
			
		}
	}

	function excluir_participante(){
		$post = $this->input->post();

		$this->db->cache_on();
		$this->db->where("votos.participante_id", $post["id"]);
		$this->db->delete("votos");
		$this->db->cache_off();

		$this->db->cache_on();
		$this->db->select("participantes.id, participantes.nome, participantes.foto, participantes.descricao");
		$this->db->where("id", $post["id"]);
		$participante =  $this->db->get("participantes")->first_row();
		
		if ($participante->foto != "" && $participante->foto != null)
			@unlink("./assets/images/participantes/$participante->foto");
		$this->db->cache_off();

		$this->db->cache_on();
		$this->db->where("participantes.id", $post["id"]);
		$this->db->delete("participantes");

	}

	function votar($dados){
		if($dados != null){
			$dados["date_insert"] = date("Y-m-d H:i:s");
			$dados["date_update"] = date("Y-m-d H:i:s");
			$this->db->insert("votos", $dados);
			return $this->db->insert_id();
		}
	}

	function updateVoto($dados){
		if($dados != null){
			$dados["date_update"] = date("Y-m-d H:i:s");
			$this->db->where("votos.session", $this->session->userdata("session"));				
			$this->db->where("votos.participante_id", $dados['participante_id']);
			return $this->db->update("votos", $dados);
		}
	}

	function excluirVoto($dados){
		if($dados != null){
			$this->db->where("votos.session", $this->session->userdata("session"));				
			$this->db->where("votos.participante_id", $dados['participante_id']);
			return $this->db->delete("votos", $dados);
		}
	}

	function totalVotos($participante_id, $tipo = null){
		if($participante_id != null){
			if($tipo != null)
				$this->db->where("voto", $tipo);				
			$this->db->where("participante_id", $participante_id);
			$this->db->select("votos.id, votos.voto, votos.session");
			return $this->db->get("votos");
		}
	}

	function votado($participante_id){
		if($participante_id != null){
			$this->db->where("votos.session", $this->session->userdata("session"));				
			$this->db->where("votos.participante_id", $participante_id);
			return $this->db->get("votos");
		}
	}
	
}