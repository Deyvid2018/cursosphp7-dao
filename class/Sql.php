<?php

//Ela tem a herançe da classe NATIVA PDO(bidParam, prepare, params, exetuce()...)
class SQL extends PDO{
    
    private $coon;
    
    public function __construct(){

        $this->conn = new PDO("mysql:host=localhost;dbname=login", "root","");

    }

    private function setParams($statment, $parameters = array()){
        foreach ($parameters as $key => $value) {

            $statment->setParam($key, $value) . "<bR>";

        }

    }

    private function setParam($statment, $key, $value){

        $statment->bindParam($key, $value);

    }


    //Serve para substituir o prepare, bindParam..
    //$rowQuery = é o que vai tratar os comandos no Banco de Dados
    //$params = array() = É aonde vai receber os dados
    public function query($rawQuery, $params = array()){

        $stmt = $this->conn->prepare($rawQuery);
        $this->setParams($stmt, $params);

        $stmt->execute(); //Execução da entrada dos comandos(dados) no BANCO DE DADOS
        
        return $stmt;
    }


    //Função ou método para o SELECT do banco, mas com interface no PHP!
    public function select($rawQuery, $params = array()):array//Só para controlar como array. Função php7
    {

        $stmt = $this->query($rawQuery, $params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);


    }
     
}
?>