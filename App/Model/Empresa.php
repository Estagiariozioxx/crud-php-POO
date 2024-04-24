<?php

class Empresa{

    private $id;
    private $razao_social;
    private $nome_fantasia;
    private $cnpj;


    public function getId(){
        return $this->id;
    }


    public function setId($id){
        $this->id = $id;
    }


    public function getRazaoSocial(){
        return $this->razao_social;
    }


    public function setRazaoSocial($razao_social){
        $this->razao_social = $razao_social;
    }

 
    public function getNomeFantasia(){
        return $this->nome_fantasia;
    }


    public function setNomeFantasia($nome_fantasia){
        $this->nome_fantasia = $nome_fantasia;
    }

 
    public function getCnpj(){
        return $this->cnpj;
    }

    
    public function setCnpj($cnpj){
        $this->cnpj = $cnpj;
    }

}
?>
