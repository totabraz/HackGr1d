<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
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
        redirect('login', 'refresh');
    }

    public function logout()
    {
        globalLogout();
    }

    public function login()
    {
        if (($this->session->userdata('logged') == TRUE)) {
            switch ($this->session->userdata('permission_name')) {
                case LABEL_CLIENTE:
                    redirect('cliente/home', 'refresh');
                    break;
                case LABEL_CORRETOR:
                    redirect('corretor/home', 'refresh');
                    break;
                case LABEL_ROOT:
                    redirect('root/home', 'refresh');
                    break;
            }
        }
        if ($this->option->get_option('setup_executado') != 1) {
            redirect('instalar', 'refresh');
        } else {

            $this->form_validation->set_rules('cpf', 'Usuário', 'trim|required|min_length[4]');
            $this->form_validation->set_rules('permission_name', 'Categoria de Usuário', 'trim|required');
            $this->form_validation->set_rules('password', 'Senha', 'trim|required|min_length[8]');
            // verifica validação
            if ($this->form_validation->run() == false) {
                if (validation_errors()) {
                    set_msg(getMsgError(validation_errors()));
                }
            } else {
                $dados_form = $this->input->post();
                $user = NULL;
                //if find by cpf or email

                if ($user = $this->user->getUserByCPFAndPermissionName($dados_form['cpf'], $dados_form['permission_name'])) {
                    if ($user->cpf == $dados_form['cpf']) {

                        if (password_verify($dados_form['password'], $user->password)) {
                            $this->session->set_userdata('logged', true);
                            $this->session->set_userdata('cpf', $user->cpf);
                            $this->session->set_userdata('permission_name', $user->permission_name);
                            $this->session->set_userdata('permission_value', $user->permission_value);
                            //TODO: fazer difect para
                            switch ($dados_form['permission_name']) {
                                case LABEL_CLIENTE:
                                    redirect('cliente/home', 'refresh');
                                    break;
                                case LABEL_CORRETOR:
                                    redirect('corretor/home', 'refresh');
                                    break;
                                case LABEL_ROOT:
                                    redirect('root/home', 'refresh');
                                    break;

                                default:
                                    set_msg(getMsgError("Erro desconhecido no login"));
                                    // redirect('login', 'refresh');
                                    break;
                            }
                        } else {
                            set_msg(getMsgError('CPF e/ou Senha estão errados! :('));
                        }
                    }
                } else {
                    set_msg(getMsgError('Usurário não existe! :('));
                }
            }
            $dados['title'] = 'Acesso ao sistema';
            $dados['subtitle'] = 'Acessar o painel';



            $this->load->view('admin/includes/head');
            $this->load->view('login/login', $dados);
            $this->load->view('admin/includes/scripts');
        }
    }
}
