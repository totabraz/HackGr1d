<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Root extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('option_model', 'option');
        $this->load->model('user_model', 'user');
    }

    public function index()
    {
        redirect('root/list', 'refresh');
    }

    public function edit()
    {
        // Verificar login da sessão
        verificaLoginAdmin();
        $dados = [];

        //Verifica se o ID foi passado
        $idUser = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        // $dados['idUser'] = $idUser;
        if ($idUser > 0) {
            // ID informado, continuar a edição
            if ($user = $this->user->getUserByID($idUser)) {
                $dados['user'] = (array) $user;
            } else {
                set_msg(getMsgError('Erro! Usuário inexistente!<br/> Escolha um usuário para editar !'));
                redirect('root/listar', 'refresh');
            }
        } else {
            set_msg(getMsgError('Erro! ID_Documento não encontrado!'));
            redirect('root/listar', 'refresh');
        }




        // Regras de validação
        $this->form_validation->set_rules('cpf', 'CPF', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('name', 'Nome Completo', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('permission_name', 'Tipo Usuário', 'trim|required|min_length[4]');
        $dados_form = $this->input->post();

        //verificar a validação 
        if ($this->form_validation->run() == FALSE) {
            if (validation_errors()) {
                set_msg(getMsgError(validation_errors()));
            }
            if (sizeof($dados_form) > 0) {
                if (isset($dados_form['cpf'])) $dados['user']['cpf'] = $dados_form['cpf'];
                if (isset($dados_form['name'])) $dados['user']['name'] = $dados_form['name'];
                if (isset($dados_form['permission_name'])) {
                    $dados['user']['permission_name'] = $dados_form['permission_name'];
                    $dados['user']['permission_value'] = getPermissionValue($dados_form['permission_name']);;
                }
            }
        } else {
            $dados_insert['ID'] = $user->ID;
            $dados_insert["cpf"] = $dados_form['cpf'];
            $dados_insert["name"] = $dados_form['name'];
            $dados_insert['permission_name'] = $dados_form['permission_name'];
            $dados_insert['permission_value'] = getPermissionValue($dados_form['permission_name']);
            $dados['user'] = $dados_insert;

            $samePassWord = TRUE;
            $changePS = TRUE;
            if (isset($dados_form['password']) && isset($dados_form['password2']) && !($dados_form['password'] == '' || $dados_form['password2'] == '')) {
                if ($dados_form['password'] === $dados_form['password2']) {
                    $changePS = FALSE;
                    $dados_insert["password"] = password_hash($dados_form['password'], PASSWORD_DEFAULT);
                } else {
                    $samePassWord = FALSE;
                    $msg = getMsgError('Senhas não conferem.');
                }
            }

            if ($this->user->salvar($dados_insert)) {
                if ($changePS) $msg = getMsgOk('Dados atualizados. [Mesma senha]');
                else $msg = getMsgOk('Dados atualizados.[Senhas atualizadas]');
            } else {
                if ($samePassWord) {
                    $msg = getMsgError('Ops! Algo aconteceu, tente novamente.');
                } else {
                    $msg = getMsgError('Senhas não conferem.');
                }
            }
            set_msg($msg);
        }
        $this->input->post(NULL);
        
        $dados['menuActive'] = 'root/create';
        // carrega view
        $this->load->view('admin/includes/head');
        $this->load->view('admin/includes/header',$dados);
        $this->load->view('root/edit', $dados);
        $this->load->view('admin/includes/footer');
    }


    public function list()
    {
        // Verificar login da sessão
        verificaLogin();

        $dados['users'] = $this->user->getAll();
        $user = $this->user->getMyUserInfo();
        $dados['userID'] = (isset($user->ID)) ? $user->ID : ' ';
        // printInfoDump($user);
        $dados['menuActive'] = 'root/list';
        // carrega view
        $this->load->view('admin/includes/head');
        $this->load->view('admin/includes/header', $dados);
        $this->load->view('root/list', $dados);
        $this->load->view('admin/includes/footer');
    }

    public function create()
    {
        // Verificar login da sessão
        verificaLoginAdmin();

        // Regras de validação
        $this->form_validation->set_rules('cpf', 'CPF', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('name', 'Nome', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('permission_name', 'Tipo Usuário', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('password', 'Senha', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('password2', 'Repitir Senha', 'trim|required|min_length[8]|matches[password]');
        $dados_form = $this->input->post();
        //verificar a validação 
        if ($this->form_validation->run() == false) {
            if (validation_errors()) {
                set_msg(getMsgError(validation_errors()));
            }
        } else {
            $user = $this->user->getUserByCPF($dados_form['cpf']);
            if (($user === NULL) && (isset($dados_form['password']) && (isset($dados_form['password2']) && ($dados_form['password'] === $dados_form['password2'])))) {
                $dados_insert["cpf"] = $dados_form['cpf'];
                $dados_insert["name"] = $dados_form['name'];
                $dados_insert['permission_name'] = $dados_form['permission_name'];
                $dados_insert['permission_value'] = getPermissionValue($dados_form['permission_name']);
                $dados_insert["password"] = password_hash($dados_form['password'], PASSWORD_DEFAULT);
                unset($dados_insert['password2']);
                // salvar no banco
                if ($id = $this->user->salvar($dados_insert)) {
                    set_msg(getMsgOk('Usuário cadastrado!'));
                    if (isset($dados_form['addmore']) && $dados_form['addmore']) {
                        redirect('root/cadastrar', 'refresh');
                    } else {
                        redirect('root/listar', 'refresh');
                    }
                } else {
                    set_msg(getMsgError('Problemas ao cadastrada usuário!'));
                }
            } else {
                set_msg(getMsgError('CPF já cadastrado!'));
            }
        }

        unset($dados_form['password']);
        unset($dados_form['password2']);
        $dados['form_input'] = $dados_form;
        $dados['title']     = 'Novo Cadastro';
        $dados['user'] = (isset($dados_insert)) ?  $dados_insert : '';
        $dados['menuActive'] = 'root/create';

        // carrega view
        $this->load->view('admin/includes/head');
        $this->load->view('admin/includes/header', $dados);
        $this->load->view('root/create', $dados);
        $this->load->view('admin/includes/footer');
    }
}
