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
        redirect('cliente/vistoria/list', 'refresh');
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

                $dados_form = $this->input->post();
                //verificar a validação 

                $SemErroIMGs = FALSE;
                $msgErro = "";
                
                $this->load->library('upload', config_upload_img());
                $dados_insert = [];
                if ($this->upload->do_upload('img1')) {
                    $dados_upload = $this->upload->data();
                    $dados_insert["img1"] = $dados_upload['file_name'];
                } else {
                    $SemErroIMGs = TRUE;
                    $msgErro .= 'São permitidos arquivos JPG, JPEG ou PNG de até 10MB <BR/>>';
                }

                if ($this->upload->do_upload('img2')) {
                    $dados_upload = $this->upload->data();
                    $dados_insert["img2"] = $dados_upload['file_name'];
                } else {
                    $SemErroIMGs = TRUE;
                    $msgErro .= 'São permitidos arquivos JPG, JPEG ou PNG de até 10MB <BR/>';
                }

                if ($this->upload->do_upload('img3')) {
                    $dados_upload = $this->upload->data();
                    $dados_insert["img3"] = $dados_upload['file_name'];
                } else {
                    $SemErroIMGs = TRUE;
                    $msgErro .= 'São permitidos arquivos JPG, JPEG ou PNG de até 10MB <BR/>';
                }

                if ($this->upload->do_upload('img4')) {
                    $dados_upload = $this->upload->data();
                    $dados_insert["img4"] = $dados_upload['file_name'];
                } else {
                    $SemErroIMGs = TRUE;
                    $msgErro .= 'São permitidos arquivos JPG, JPEG ou PNG de até 10MB <BR/>';
                }

                $dados_insert['ID'] = $idVistoria;
                $dados_insert['status_vistoria_value'] = VALUE_ENVIADO;
                $dados_insert['status_vistoria_name'] = LABEL_ENVIADO;

                printInfoDump($dados_insert);
                // salvar no banco
                if ($this->vistoria->save($dados_insert)) {
                    set_msg(getMsgOk('Album cadastrado'));
                } else  if ($msgErro) {
                    set_msg(getMsgError($msgErro));
                } else {
                    set_msg(getMsgInfo('Problemas em atualizar a Vistoria'));
                    // }
                }
                set_msg(getMsgInfo('AAAAAAAA'));
            } else {
                set_msg(getMsgError('Erro! ID da Vistoria inexistente!'));
                redirect('admin/vistorias/listar', 'refresh');
            }
        } else {
            set_msg(getMsgError('Erro! Vistoria não encontrado!'));
            redirect('admin/vistorias/listar', 'refresh');
        }

        $dados['form_input'] = $dados_form;
        $dados['title']     = 'Editar Album';
        $dados['menuActive'] = 'cliente/vistoria/list';
        // carrega view
        $this->load->view('admin/includes/head');
        $this->load->view('admin/includes/header', $dados);
        $this->load->view('cliente/vistoria/edit', $dados);
        $this->load->view('admin/includes/footer');
    }

    public function list()
    {
        // Verificar login da sessão
        verificaLogin();
        $dados['vistorias'] = NULL;
        if (isset($this->session->userdata['cpf'])) $dados['vistorias'] = $this->vistoria->getAllByCpfCliente($this->session->userdata['cpf']);
        // printInfoDump($vistoria);
        $dados['menuActive'] = 'cliente/vistoria/list';
        // carrega view
        $this->load->view('admin/includes/head');
        $this->load->view('admin/includes/header', $dados);
        $this->load->view('cliente/vistoria/list', $dados);
        $this->load->view('admin/includes/footer');
    }
}
