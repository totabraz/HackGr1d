<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blockchain_model extends CI_Model
{
    private $pictureHash;
    private $hash;
    private $picturesName;

    function __construct($id,$picture){
        $this->picturesName = $picture;
        //cpf ou id 
        $this->hash = $this->seedBlock($id);
    }
    function encode($hash){
        //usa hash seed
        $obj = new Block($hash);
        return $this->hash;
    }
    function decode($hash){
        $obj = new Block($hash);
        if($hash == $this->hash){
            return $this->picturesName;
        }
        else{
            return "erro";
        }
          
    }
    function geraHash(){
        $obj = new Block($this->hash);
        return $obj->getBlockHash();
    }
    function seedBlock($id){
        $obj = new Block($id);
        return $obj->getBlockHash();
    }
    function returnApi(){
        return $this->hash."----".$this->geraHash($this->hash);
    }
}
