<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Apolice extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('option_model', 'option');
        $this->load->model('apolice_model', 'apolice');
    }

    public function index()
    {
        redirect('corretor/apolice/list', 'refresh');
    }

    public function edit()
    {
        // Verificar login da sessão
        verificaLoginAdmin();
        $dados = [];

        //Verifica se o ID foi passado
        $idApolice = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        // $dados['idApolice'] = $idApolice;
        if ($idApolice > 0) {
            // ID informado, continuar a edição
            if ($apolice = $this->apolice->getApoliceById($idApolice)) {
                $dados['apolices'] = (array) $apolice;
            } else {
                set_msg(getMsgError('Erro! Apólice inexistente!<br/> Escolha uma apólice para editar !'));
                redirect('corretor/apolice/listar', 'refresh');
            }
        } else {
            set_msg(getMsgError('Erro! ID_Documento não encontrado!'));
            redirect('corretor/apolice/listar', 'refresh');
        }

        // Regras de validação
        $this->form_validation->set_rules('cpf_corretor', 'CPF do Corretor', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('cpf_cliente', 'CPF do Cliente', 'trim|required|min_length[4]');
        $dados_form = $this->input->post();

        //verificar a validação 
        if ($this->form_validation->run() == FALSE) {
            if (validation_errors()) {
                set_msg(getMsgError(validation_errors()));
            }
            if (sizeof($dados_form) > 0) {
                if (isset($dados_form['cpf_corretor'])) $dados['apolice']['cpf_corretor'] = $dados_form['cpf_corretor'];
                if (isset($dados_form['cpf_cliente'])) $dados['apolice']['cpf_cliente'] = $dados_form['cpf_cliente'];
            }
        } else {
            $dados_insert['ID'] = $apolice->ID;
            $dados_insert["cpf_corretor"] = $dados_form['cpf_corretor'];
            $dados_insert["cpf_cliente"] = $dados_form['cpf_cliente'];
            $dados['apolice'] = $dados_insert;

            if ($this->apolice->salvar($dados_insert)) {
                getMsgOk('Dados atualizados.');
            } else {
                $msg = getMsgInfo('Ops! Algo aconteceu! Mesmo conteúdo?');
                set_msg($msg);
            }
            $this->input->post(NULL);
        }
        $dados['menuActive'] = 'corretor/apolice/create';
        // carrega view
        $this->load->view('admin/includes/head');
        $this->load->view('admin/includes/header', $dados);
        $this->load->view('corretor/apolice/edit', $dados);
        $this->load->view('admin/includes/footer');
    }

    public function list()
    {
        // Verificar login da sessão
        verificaLogin();

        $dados['apolices'] = $this->apolice->getAll();
        // printInfoDump($apolice);
        $dados['menuActive'] = 'corretor/apolice/list';
        // carrega view
        $this->load->view('admin/includes/head');
        $this->load->view('admin/includes/header', $dados);
        $this->load->view('corretor/apolice/list', $dados);
        $this->load->view('admin/includes/footer');
    }

    public function create()
    {
        // Verificar login da sessão
        verificaLoginAdmin();

        // Regras de validação
        $this->form_validation->set_rules('cpf_corretor', 'CPF do Corretor', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('cpf_cliente', 'CPF do Cliente', 'trim|required|min_length[4]');
        $dados_form = $this->input->post();
        //verificar a validação 
        if ($this->form_validation->run() == false) {
            if (validation_errors()) {
                set_msg(getMsgError(validation_errors()));
            }
        } else {

            


            $dados_insert["cpf_cliente"] = $dados_form['cpf_cliente'];
            $dados_insert["cpf_corretor"] = $dados_form['cpf_corretor'];
            // salvar no banco
            if ($id = $this->apolice->salvar($dados_insert)) {
                set_msg(getMsgOk('Apólice cadastrado!'));
                if (isset($dados_form['addmore']) && $dados_form['addmore']) {
                    redirect('corretor/apolice/cadastrar', 'refresh');
                } else {
                    redirect('corretor/apolice/listar', 'refresh');
                }
            } else {
                set_msg(getMsgError('Problemas ao cadastrada usuário!'));
            }
        }

        unset($dados_form['password']);
        unset($dados_form['password2']);
        $dados['form_input'] = $dados_form;
        $dados['title']     = 'Novo Cadastro';
        $dados['apolice'] = (isset($dados_insert)) ?  $dados_insert : '';
        $dados['menuActive'] = 'corretor/apolice/create';

        // carrega view
        $this->load->view('admin/includes/head');
        $this->load->view('admin/includes/header', $dados);
        $this->load->view('corretor/apolice/create', $dados);
        $this->load->view('admin/includes/footer');
    }
}
