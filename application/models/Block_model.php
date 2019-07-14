<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Block_model extends CI_Model
{   private $previousHash;
    private $blockHash;
    private $date;
    function __construct($previousHash){
        $this->previousHash = $previousHash;
        $this->date = setDate();
        $contents = $previousHash.$this->date;
        $this->blockHash = md5($contents);
    }
    public function getPreviousHash(){
        return $this->previousHash;
    }
    public function getBlockHash(){
        return $this->blockHash;
    }
    public function setDate(){
        $date = new DateTime();
        //só para recife no começo
        $date->setTimezone(new DateTimeZone('America/Recife')); 
        return $date->format('Y-m-d H:i:s');
    }
}

