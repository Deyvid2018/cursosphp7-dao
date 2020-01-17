<?php

class Usuario{
    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;


    public function getIdusuario(){
        return $this->idusuario;
    }
    public function setIdusuario($value){
        $this->idusuario = $value;

    }

    public function getDeslogin(){
        return $this->deslogin;
    }
    public function setDeslogin($value){
        $this->deslogin = $value;
    }

    public function getDessenha(){
        return $this->dessenha;
    }
    public function setDessenha($value){
        $this->dessenha = $value;
    }

    public function getDtcadastro(){
        return $this->dtcadastro;
    }
    public function setDtcadastro($value){
        $this->dtcadastro = $value;
    }

    

    //Método para carregar o através do id com comando SELECT
    public function carregarId($id){

        $sql = new Sql();

        //result é a variável que segura a função SELECT do BD
        $result = $sql->select("SELECT * FROM tb_usuario WHERE idUsuario = :ID", array(
            ":ID"=>$id
        ));
        
        // isset($result[0]) = para verificar se tem pelomenos 1 indice(dado) no banco e diminuir a change de erro
        //OU
        // (count($result) > 0 ) é a mesma coisa!! só de DICA!
        if(isset($result[0])){

            $row = $result[0];

            //Se a variável estiver certa "result" já passo os dados por aqui mesmo!
            $this->setIdusuario($row['idUsuario']);
            $this->setDeslogin($row['desLogin']);
            $this->setDessenha($row['desSenha']);
            $this->setDtcadastro(new DateTime($row['dtCadastro'])); //Para ficar em um formado melhor usando a função hora

        }
    }

    public function __toString(){
        return json_encode(
            array(

                "idUsuario"=>$this->getIdusuario(),
                "desLogin"=>$this->getDeslogin(),
                "dessenha"=>$this->getDessenha(),
                "Dtcadastro"=>$this->getDtcadastro()->format("d/m/Y h:i:s")
        ));
    }

}




?>