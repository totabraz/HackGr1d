<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vistoria extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('option_model', 'option');
        $this->load->model('vistoria_model', 'vistoria');
    }

    public function index()
    {
        redirect('corretor/vistoria/list', 'refresh');
    }

    public function edit()
    {
        // Verificar login da sessão
        verificaLoginAdmin();
        $dados = [];

        //Verifica se o ID foi passado
        $idVistoria = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        // $dados['idVistoria'] = $idVistoria;
        if ($idVistoria > 0) {
            // ID informado, continuar a edição
            if ($vistoria = $this->vistoria->getVistoriaById($idVistoria)) {
                $dados['vistorias'] = (array) $vistoria;
            } else {
                set_msg(getMsgError('Erro! Apólice inexistente!<br/> Escolha uma apólice para editar !'));
                redirect('corretor/vistoria/listar', 'refresh');
            }
        } else {
            set_msg(getMsgError('Erro! ID_Documento não encontrado!'));
            redirect('corretor/vistoria/listar', 'refresh');
        }

        // Regras de validação
        $this->form_validation->set_rules('status_vistoria_name', 'Situação da Vistoria', 'trim|required|min_length[4]');
        $dados_form = $this->input->post();

        //verificar a validação 
        if ($this->form_validation->run() == FALSE) {
            if (validation_errors()) {
                set_msg(getMsgError(validation_errors()));
            }
            if (sizeof($dados_form) > 0) {
                if (isset($dados_form['status_vistoria_name'])) $dados['vistoria']['status_vistoria_name'] = $dados_form['status_vistoria_name'];
            }
        } else {
            $dados_insert['ID'] = $vistoria->ID;
            $dados_insert["status_vistoria_name"] = $dados_form['status_vistoria_name'];
            $dados['vistoria']['status_vistoria_name'] = $dados_insert['status_vistoria_name'];

            if ($this->vistoria->save($dados_insert)) {
                getMsgOk('Dados atualizados.');
            } else {
                $msg = getMsgInfo('Ops! Algo aconteceu! Mesmo conteúdo?');
                set_msg($msg);
            }
            $this->input->post(NULL);
        }
        $dados['menuActive'] = 'corretor/vistoria/create';
        // carrega view
        $this->load->view('admin/includes/head');
        $this->load->view('admin/includes/header', $dados);
        $this->load->view('corretor/vistoria/edit', $dados);
        $this->load->view('admin/includes/footer');
    }

    public function list()
    {
        // Verificar login da sessão
        verificaLogin();

        $dados['vistorias'] = $this->vistoria->getAll();
        // printInfoDump($vistoria);
        $dados['menuActive'] = 'corretor/vistoria/list';
        // carrega view
        $this->load->view('admin/includes/head');
        $this->load->view('admin/includes/header', $dados);
        $this->load->view('corretor/vistoria/list', $dados);
        $this->load->view('admin/includes/footer');
    }

    public function solicitarvalidacao()
    {
        // Verificar login da sessão
        verificaLoginAdmin();
        $dados = [];

        //Verifica se o ID foi passado
        $idVistoria = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $dados_insert["ID"] = $idVistoria;
        $dados_insert["status_vistoria_name"] = LABEL_SOLICITADO;
        $dados_insert["status_vistoria_value"] = VALUE_SOLICITADO;
        // save no banco
        if ($id = $this->vistoria->save($dados_insert)) {
            set_msg(getMsgOk('Apólice cadastrado!'));
            redirect('corretor/vistoria/listar', 'refresh');
        } else {
            set_msg(getMsgError('Problemas ao solicitar!'));
        }
    }

    public function create()
    {
        // Verificar login da sessão
        verificaLoginAdmin();

        // Regras de validação
        $this->form_validation->set_rules('cpf_corretor', 'CPF do Corretor', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('cpf_cliente', 'CPF do Cliente', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('placa', 'Placa', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('renavam', 'Renavam', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('chassi', 'Chassi', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('status_vistoria_name', 'Situação da vistoria', 'trim|required|min_length[4]');


        $dados_form = $this->input->post();
        //verificar a validação 
        if ($this->form_validation->run() == false) {
            if (validation_errors()) {
                set_msg(getMsgError(validation_errors()));
            }
        } else {
            $dados_insert["cpf_corretor"] = $dados_form['cpf_corretor'];
            $dados_insert["cpf_cliente"] = $dados_form['cpf_cliente'];
            $dados_insert["placa"] = $dados_form['placa'];
            $dados_insert["renavam"] = $dados_form['renavam'];
            $dados_insert["chassi"] = $dados_form['chassi'];
            $dados_insert["status_vistoria_name"] = $dados_form['status_vistoria_name'];
            $dados_insert["status_vistoria_value"] = getValueStatus($dados_form['status_vistoria_name']);
            // save no banco
            if ($id = $this->vistoria->save($dados_insert)) {
                set_msg(getMsgOk('Apólice cadastrado!'));
                if (isset($dados_form['addmore']) && $dados_form['addmore']) {
                    redirect('corretor/vistoria/cadastrar', 'refresh');
                } else {
                    redirect('corretor/vistoria/listar', 'refresh');
                }
            } else {
                set_msg(getMsgError('Problemas ao cadastrada usuário!'));
            }
        }

        unset($dados_form['password']);
        unset($dados_form['password2']);
        $dados['form_input'] = $dados_form;
        $dados['title']     = 'Novo Cadastro';
        $dados['vistoria'] = (isset($dados_insert)) ?  $dados_insert : '';
        $dados['menuActive'] = 'corretor/vistoria/create';

        // carrega view
        $this->load->view('admin/includes/head');
        $this->load->view('admin/includes/header', $dados);
        $this->load->view('corretor/vistoria/create', $dados);
        $this->load->view('admin/includes/footer');
    }
}
