<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library("form_validation");
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
		$this->load->model("geral_model", "geral");
	}

	public function index(){
		$this->load->view('index');
	}

	public function listagem(){
		$this->load->library("pagination");

		$maximo = 10;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$config['next_link'] = '>';
		$config['prev_link'] = '<';   
		$config['full_tag_open'] = '<nav class="paginacao"><ul class="pagination">';
		$config['full_tag_close'] = '</ul></nav>';
		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] = 3;
		$config['per_page'] = $maximo;

		$keyword = trim($this->input->get('k', TRUE));
		$config['enable_query_strings'] = TRUE;
		$config['query_string_segment'] = 'p';
		$config['page_query_string'] = TRUE;
		$config['base_url'] = base_url()."/listagem";
		if ($this->input->get('p')) {
			$sgm = (int) trim($this->input->get('p'));
			$inicio = $config['per_page'] * ($sgm - 1);
		} else {
			$inicio = 0;
		}

		$config['total_rows'] = $this->geral->getParticipantes(null, null)->num_rows();
		$this->pagination->initialize($config);
		$dados = array(
			'participantes'=> $this->geral->getParticipantes($inicio, $maximo)->result(),
			'paginacao'=>$this->pagination->create_links()
			);
		$this->load->view('inicial', $dados);
	}

	public function cadastrar(){
		$this->form_validation->set_rules("foto", "Foto", "");
		$this->form_validation->set_rules("nome", "Nome", "required|max_length[50]", array("required" => "Informe o campo nome", "max_length"=> "{field} deve ter no máximo {param} caracteres." ));
		$this->form_validation->set_rules("descricao", "Descrição", "required|max_length[100]", array("required" => "Informe o campo Descrição", "max_length"=> "{field} deve ter no máximo {param} caracteres." ));
		$dados = array("mensagem" => "");
		$insert = true;
		if($this->form_validation->run()){
			if($_FILES["foto"]["name"] != null){
				$config['upload_path']          = './assets/images/participantes/';
				$config['allowed_types']        = 'jpg|png';
				$config['max_size']             = 1000;

				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('foto')){
					$dados["mensagem"] = "<h6 class='error'>Erro ao realizar upload de imagem, tente novamente!</h6>";
					$insert = false;
				}else{

					$dados["mensagem"] = "";
					$data = $this->upload->data();
					$post = array('foto' => $data["file_name"], 'nome' => $this->input->post("nome"), 'descricao' => $this->input->post("descricao"));
				}
			}else{
				$post = array('foto' => "participante.jpg", 'nome' => $this->input->post("nome"), 'descricao' => $this->input->post("descricao"));
			}

			if($insert){
				
				if ($this->geral->cadastrar_participante($post)) {
						$this->session->set_flashdata("cadastro", "<h4 class='success'>Participante cadastrado com sucesso</h4>");
						redirect(base_url()."listagem");
				}else{
					$this->session->set_flashdata("cadastro", "<h4 class='error'>Erro ao cadastrar participante, tente novamente!</h4>");
				}
			}
		}
		$this->load->view('cadastrar', $dados);
	}

	public function editar(){
		$id = "";
		if($this->uri->segment("2") != null && is_numeric($this->uri->segment("2"))){
			$id = $this->uri->segment("2");

		}else{
			if($this->uri->segment("3") != null && is_numeric($this->uri->segment("3"))){
				$id = $this->uri->segment("3");				
			}
		}

		if($id != ""){
			$dados = array('participante' => $this->geral->getParticipante($id)->first_row(),'mensagem' => "");

			$this->form_validation->set_rules("foto", "Foto", "");
			$this->form_validation->set_rules("nome", "Nome", "required|max_length[50]", array("required" => "Informe o campo nome", "max_length"=> "{field} deve ter no máximo {param} caracteres." ));
			$this->form_validation->set_rules("descricao", "Descrição", "required|max_length[100]", array("required" => "Informe o campo Descrição", "max_length"=> "{field} deve ter no máximo {param} caracteres." ));
			$update = true;

			if($this->form_validation->run()){
				if($_FILES["foto"]["name"] != null){
					$config['upload_path']          = './assets/images/participantes/';
					$config['allowed_types']        = 'jpg|png';
					$config['max_size']             = 1000;

					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('foto')){
						$dados["mensagem"] = "<h6 class='error' style='text-indent:0 !important;'>Erro ao realizar upload de imagem, tente novamente!</h6>";
						$update = false;
					}else{

						$dados["mensagem"] = "";
						$data = $this->upload->data();
						$post = array('foto' => $data["file_name"], 'nome' => $this->input->post("nome"), 'descricao' => $this->input->post("descricao"), 'foto_antiga' => $this->input->post("foto_atual"));
					}
				}else{
					$post = array('foto' => $this->input->post("foto_atual"), 'nome' => $this->input->post("nome"), 'descricao' => $this->input->post("descricao"), 'foto_antiga' => "");
				}

				if($update){
					if ($this->geral->update_participante($post, $id)) {
						$this->session->set_flashdata("cadastro", "<h4 class='success'>Participante atualizado com sucesso</h4>");

						//$this->image_lib->crop();
						redirect(base_url()."listagem");
					}else{
						$this->session->set_flashdata("cadastro", "<h4 class='error'>Erro ao atualizar participante, tente novamente!</h4>");
					}
				}
			}
			$this->load->view('editar', $dados);
		}else{
			redirect(base_url()."listagem");
		}
	}

	function carregar(){
		$participantes = $this->geral->getParticipantes()->result();
		
		foreach ($participantes as $participante) {
			$votado = $this->geral->votado($participante->id)->first_row();
			
			if($votado != null){
				$participante->votado = true;
				$participante->voto = $votado->voto;
			}else{
				$participante->votado = false;
				$participante->voto = "";
			}

		}
		$dados =  array('participantes' => $participantes);
		$this->load->view('participantes', $dados);
	}


	function excluir(){
		$this->form_validation->set_rules("id", "ID", "required");
		if($this->form_validation->run()){
			$this->geral->excluir_participante();
		}else{
			echo "Erro ao deletar";
		}
	}

	function votar(){
		$this->form_validation->set_rules("participante_id", "Participante", "required");
		$this->form_validation->set_rules("voto", "voto", "required");
		if($this->form_validation->run()){
			$voto = ($this->input->post('voto') == "like") ? 1 : 0;
			$votado = $this->geral->votado($this->input->post('participante_id'))->first_row();
			if($votado != null){
				if($votado->voto == $voto){	
					$post = array(
						'participante_id' => $this->input->post('participante_id'),
						'session' => $this->session->userdata('session') 
						);				
					$this->geral->excluirVoto($post);
				}else{
					if ($votado->voto == "1") {
						$post = array(
							'participante_id' => $this->input->post('participante_id'),
							'voto' => 0,
							'session' => $this->session->userdata('session') 
							);
					}else{
						$post = array(
							'participante_id' => $this->input->post('participante_id'),
							'voto' => 1,
							'session' => $this->session->userdata('session') 
							);
					}
					$this->geral->updateVoto($post);
				}

			}else{				
				$post = array(
					'participante_id' => $this->input->post('participante_id'),
					'voto' => $voto,
					'session' => $this->session->userdata('session') 
					);
				$this->geral->votar($post);
			}
		}

	}
}
