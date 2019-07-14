<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setup extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        # Carregando o model
        // $this->load->model('Database_model');
        // # Carregando o model, configurando como um apelodo 
        // # Para poder chamar apenas como: 'Database'
        // $this->load->model('Database_model', 'Database');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('option_model', 'option');
        $this->load->model('user_model', 'user');
    }

    public function index()
    {
        if ($this->option->get_option('setup_executado' == 1)) {
            redirect('admin/admin', 'refresh');
        } else {
            redirect('setup/install', 'refresh');
        }
    }

    public function install()
    {
        $msg = '';
        // Regras de validação
        $this->form_validation->set_rules('cpf', 'CPF', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('name', 'Nome', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('password', 'Senha', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('password2', 'Repitir Senha', 'trim|required|min_length[8]|matches[password]');
        $dados_form = $this->input->post();
        $dados_insert = $dados_form;

        //verificar a validação 
        if ($this->form_validation->run() == false) {
            if (validation_errors()) {
                $msg = getMsgError(validation_errors());
            }
        } else {
            $user = NULL;
            if ($user = $this->user->getUserByCpf($dados_form['cpf']));

            if (($user === NULL) && (isset($dados_form['password']) && (isset($dados_form['password2']) && ($dados_form['password'] === $dados_form['password2'])))) {
                $dados_insert["cpf"] = $dados_form['cpf'];
                $dados_insert["name"] = $dados_form['name'];
                $dados_insert['permission_value'] = PERMISSION_ROOT;;
                $dados_insert['permission_name'] = LABEL_ROOT;;
                $dados_insert["password"] = password_hash($dados_form['password'], PASSWORD_DEFAULT);
                unset($dados_insert['password2']);                
                unset($dados_insert['enviar']);                
                // salvar no banco
                if ($id = $this->user->salvar($dados_insert) && $this->option->update_option('setup_executado', 1)) {
                    $msg = getMsgOk('CPF cadstrado com sucesso!');
                    $this->session->set_userdata('logged', true);
                    $this->session->set_userdata('cpf', $user->CPF);
                    $this->session->set_userdata('permission_value', PERMISSION_ROOT);
                    $this->session->set_userdata('permission_name', LABEL_ROOT);
                    $this->session->set_userdata('name', $user->first_name);
                    //TODO: fazer difect para


                     redirect('admin/admin', 'refresh');
                } else {
                    $msg = getMsgError('Problemas ao cadastrar usuário!');
                }
            } else if ($user !== NULL) {
                $msg = getMsgError('CPF já cadastrado.. :(');
            } else {
                $msg = getMsgError('CPF já cadastrado!');
            }
        }
        
        $dados['title']     = 'Novo Cadastro';
        $dados['user'] = (isset($dados_insert)) ?  $dados_insert : '';
        set_msg($msg);

        $this->load->view('admin/includes/head');
        $this->load->view('admin/includes/header-zero', $dados);
        $this->load->view('setup/setup', $dados);
        $this->load->view('admin/includes/footer');
        
    }
}
