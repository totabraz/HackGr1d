<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Apolice_model extends CI_Model
{
    var $table = 'apolices';
    function __construct()
    {
        parent::__construct();
    }

    public function salvar($dados)
    {
        $dados =  (array) $dados;
        if (isset($dados['ID']) && $dados['ID'] > 0) {
            // Apolice já existe. Devo editar
            $this->db->where('ID', $dados['ID']);
            unset($dados['ID']);
            $this->db->update($this->table, $dados);
            return $this->db->affected_rows();
        } else {
            // Apolice não existe. Devo editar
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



    public function excluirApolice($id = 0)
    {
        $this->db->where('ID', $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }


    public function getMyApoliceInfo()
    {
        $ci = &get_instance();
        $ci->load->library('session');
        if (isset($this->session->apolicedata['cpf'])) $cpf = $this->session->apolicedata['cpf'];
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

   
    public function getApoliceByCpfCliente($cpf_cliente = NULL)
    {
        return $this->getApolice($cpf_cliente);
    }
    public function getApoliceByCpfCorretor($cpf_corretor = NULL )
    {
        return $this->getApolice(NULL, $cpf_corretor);
    }
    public function getApoliceById($id = 0)
    {
        return $this->getApolice(NULL, NULL, $id);
    }
    private function getApolice($cpf_cliente = NULL, $cpf_corretor = NULL,  $id = 0)
    {
        $return = NULL;
        if (isset($cpf_cliente) && isset($cpf_corretor)) {
            $cpf_cliente = safeInput($cpf_cliente);
            $cpf_corretor = safeInput($cpf_corretor);
            $this->db->where('cpf_cliente', $cpf_cliente);
            $this->db->where('cpf_corretor', $cpf_corretor);
            $query = $this->db->get($this->table, 1);
            if ($query->num_rows() == 1) {
                $row = $query->row();
                $return = $row;
            }
        } else if (isset($cpf_cliente)) {
            $cpf_cliente = safeInput($cpf_cliente);
            $this->db->where('cpf_cliente', $cpf_cliente);
            $query = $this->db->get($this->table, 1);
            if ($query->num_rows() == 1) {
                $row = $query->row();
                $return = $row;
            }
        } else if (isset($cpf_corretor)) {
            $cpf_corretor = safeInput($cpf_corretor);
            $this->db->where('cpf_corretor', $cpf_corretor);
            $query = $this->db->get($this->table, 1);
            if ($query->num_rows() == 1) {
                $row = $query->row();
                $return = $row;
            }
        } else if ($id > 0 && is_null($return)) {
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
