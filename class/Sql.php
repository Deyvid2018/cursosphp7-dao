<?php

declare(strict_types=1);

//Ela tem a herançe da classe NATIVA PDO(bidParam, prepare, params, exetuce()...)
class SQL extends PDO
{
    private $conn;

    public function __construct()
    {
        $this->conn = new PDO('mysql:host=localhost;dbname=login', 'root', '');
    }

    //Serve para substituir o prepare, bindParam..
    //$rowQuery = é o que vai tratar os comandos no Banco de Dados
    //$params = array() = É aonde vai receber os dados
    public function query($rawQuery, $params = [])
    {
        $stmt = $this->conn->prepare($rawQuery);
        $this->setParams($stmt, $params);

        $stmt->execute(); //Execução da entrada dos comandos(dados) no BANCO DE DADOS

        return $stmt;
    }

    //Função ou método para o SELECT do banco, mas com interface no PHP!
    public function select($rawQuery, $params = []): array//Só para controlar como array. Função php7
    {
        $stmt = $this->query($rawQuery, $params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function setParams($statment, $parameters = [])
    {
        foreach ($parameters as $key => $value) {
            $this->setParam($statment, $key, $value);
        }
    }

    private function setParam($statment, $key, $value)
    {
        $statment->bindParam($key, $value);
    }
}