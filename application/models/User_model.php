<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    var $table = 'users';
    function __construct()
    {
        parent::__construct();
    }

    public function salvar($dados)
    {
        $dados =  (array) $dados;
        if (isset($dados['ID']) && $dados['ID'] > 0) {
            // User já existe. Devo editar
            $this->db->where('ID', $dados['ID']);
            unset($dados['ID']);
            $this->db->update($this->table, $dados);
            return $this->db->affected_rows();
        } else {
            // User não existe. Devo editar
            $this->db->insert($this->table, $dados);
            return $this->db->insert_id();
        }
    }

    public function getAll($sort = 'ID', $limit = NULL, $offset = NULL, $order = 'asc')
    {
        $this->db->order_by($sort, $order);
        if ($limit)
            $this->db->limit($limit, $offset);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            $result = $query->result();
            for ($i = 0; $i < sizeof($result); $i++) {
                $result[$i]->password = '';
            }
            return $result;
        } else {
            return NULL;
        }
    }


    public function countAllFiltred($titulo = NULL, $autor = NULL, $orientador = NULL, $data_defesa = NULL, $tipo_doc = NULL, $idioma = NULL, $offset = NULL, $limit = NULL)
    {
        if ($limit) $this->db->limit($limit, $offset);
        if ($autor) $this->db->like('autor', $autor);
        if ($orientador) $this->db->like('orientador', $orientador);
        if ($titulo) $this->db->like('titulo', $titulo);
        if ($data_defesa) $this->db->where('data_defesa', $data_defesa);
        if ($tipo_doc) $this->db->where('tipo_doc', $tipo_doc);
        if ($idioma) $this->db->where('idioma', $idioma);
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    public function countAll($titulo = NULL, $data_defesa = NULL, $tipo_doc = NULL, $idioma = NULL)
    {
        if ($titulo) $this->db->like('titulo', $titulo);
        if ($data_defesa) $this->db->where('data_defesa', $data_defesa);
        if ($tipo_doc) $this->db->where('tipo_doc', $tipo_doc);
        if ($idioma) $this->db->where('idioma', $idioma);
        return $this->db->count_all($this->table);
    }


    public function excluirUser($id = 0)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }


    public function getMyUserInfo()
    {
        $ci = &get_instance();
        $ci->load->library('session');
        if (isset($this->session->userdata['cpf'])) $cpf = $this->session->userdata['cpf'];
        if (isset($cpf)) {
            $this->db->where('cpf', $cpf);
            $query = $this->db->get($this->table, 1);
            if ($query->num_rows() == 1) {
                $row = $query->row();
                return $row;
            } else {
                return NULL;
            }
        }
    }

    public function getUserByCPFAndPermissionName($cpf = NULL, $permission_name = NULL, $id = 0)
    {
        $return = NULL;
        if (isset($cpf) && isset($permission_name)) {
            $cpf = safeInput($cpf);
            $permission_name = safeInput($permission_name);
            $this->db->where('cpf', $cpf);
            $this->db->where('permission_name', $permission_name);
            $query = $this->db->get($this->table, 1);
            if ($query->num_rows() == 1) {
                $row = $query->row();
                $return = $row;
            }
        }

        if ($id > 0 && is_null($return)) {
            $this->db->where('ID', $id);
            $query = $this->db->get($this->table, 1);
            if ($query->num_rows() == 1) {
                $row = $query->row();
                $return = $row;
            }
        }
        // printInfoDump($return);
        return $return;
    }
    public function getUserByCPF($cpf = NULL)
    {
        return $this->getUser($cpf);
    }
    public function getUserById($id = 0)
    {
        return $this->getUser(NULL, $id);
    }
    private function getUser($cpf = NULL,  $id = 0)
    {
        $return = NULL;
        if (isset($cpf)) {
            $cpf = safeInput($cpf);
            $this->db->where('cpf', $cpf);
            $query = $this->db->get($this->table, 1);
            if ($query->num_rows() == 1) {
                $row = $query->row();
                $return = $row;
            }
        }


        if ($id > 0 && is_null($return)) {
            $this->db->where('ID', $id);
            $query = $this->db->get($this->table, 1);
            if ($query->num_rows() == 1) {
                $row = $query->row();
                $return = $row;
            }
        }
        // printInfoDump($return);
        return $return;
    }



    /**
     * =================================
     *        REMOVE SE NÃO USAR
     * =================================
     */
}
