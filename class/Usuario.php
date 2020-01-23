<?php

declare(strict_types=1);

class Usuario
{
    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    public function __construct($login = '', $password = '')
    {
        $this->setDeslogin($login);
        $this->setDessenha($password);
    }

    //Chamando tudo em formado de STRING
    //IMPORTANTE= Se não formadar para string vai da ERRO pq o idUsuario não pode ser convertido para string, só com a função toString
    public function __toString()
    {
        return json_encode(
            [
                'idUsuario' => $this->getIdusuario(),
                'desLogin' => $this->getDeslogin(),
                'dessenha' => $this->getDessenha(),
                'dtcadastro' => $this->getDtcadastro()->format('d/m/Y H:i:s'),
        ]);
    }

    public function getIdusuario()
    {
        return $this->idusuario;
    }

    public function setIdusuario($value)
    {
        $this->idusuario = $value;
    }

    public function getDeslogin()
    {
        return $this->deslogin;
    }

    public function setDeslogin($value)
    {
        $this->deslogin = $value;
    }

    public function getDessenha()
    {
        return $this->dessenha;
    }

    public function setDessenha($value)
    {
        $this->dessenha = $value;
    }

    public function getdtcadastro()
    {
        return $this->dtcadastro;
    }

    public function setdtcadastro($value)
    {
        $this->dtcadastro = $value;
    }

    //Método para carregar o através do ID com comando SELECT, ou seja, vai trazer UM USUARIO SÓ
    public function carregarId($id)
    {
        $sql = new Sql();

        //result é a variável que segura a função SELECT do BD
        $result = $sql->select('SELECT * FROM tb_usuario WHERE idUsuario = :ID', [
            ':ID' => $id,
        ]);

        // isset($result[0]) = para verificar se tem pelomenos 1 indice(dado) no banco e diminuir a change de erro
        //OU
        // (count($result) > 0 ) é a mesma coisa!! só de DICA!
        if (isset($result[0])) {
            $this->setDados($result[0]);
        }
    }

    //Para pegar os dados em forma de lista
    public static function getList()
    {
        $sql = new Sql();

        return $sql->select('SELECT * FROM tb_usuario ORDER BY desLogin;');
    }

    //Para pesquisar do Banco
    public static function pesquisar($login)
    {
        $sql = new Sql();

        return $sql->select('SELECT * FROM tb_usuario WHERE desLogin LIKE :PESQUISAR ORDER BY desLogin',
        [
            ':PESQUISAR' => '%'.$login.'%', // %...% Isso é para pesquisar com eficiência, Sem ser importar com nome todo EX: no BD tem João, José. Você pesquisando só por Jo ele vai PEGAR OS DOIS
        ]);
    }

    public function login($login, $password)
    {
        $sql = new Sql();

        //:LOGIN, :PASSWORD = isso é como se fosse um ID(identificação) de um atributo do banco
        $result = $sql->select('SELECT * FROM tb_usuarios WHERE desLogin = :LOGIN AND desSenha = :PASSWORD', [
            ':LOGIN' => $login,
            ':PASSWORD' => $password,
        ]);

        // isset($result[0]) = para verificar se tem pelomenos 1 indice(dado) no banco e diminuir a change de erro
        //OU
        // (count($result) > 0 ) é a mesma coisa!! só de DICA.
        //Ele fica executando até acabar os INDICE começando pelo 0 porque é um array
        if (isset($result[0])) {
            $this->setDados($result[0]);
        } else {
            throw new Exception('Login Errado!'); //Tratamento de Erro;
        }
    }

    //Aonde os Dados estão sendo setadas ou colocadas
    //setIdusuario set.....É aonde os Dados estão sendo setadas ou colocadas  é aonde os
    public function setDados($dados)
    {
        //Se a variável estiver certa "result" já passo os dados por aqui mesmo!
<<<<<<< HEAD
          $this->setIdusuario($dados['idUsuario']);
          $this->setDeslogin($dados['desLogin']);
          $this->setDessenha($dados['desSenha']);
          $this->setDtcadastro(new DateTime($dados['dtCadastro'])); //Para ficar em um formado melhor usando a função hora
    
        }
=======
        $this->setIdusuario($dados['idusuario']);
        $this->setDeslogin($dados['deslogin']);
        $this->setDessenha($dados['dessenha']);
        $this->setDtcadastro(new DateTime($dados['dtcadastro'])); //Para ficar em um formado melhor usando a função hora
    }
>>>>>>> 65c5d2b87b6cf6819d55cc1ade6d113060fa62db

    //Método para INSERIR USUÁRIO NOVO, através de procedure
    public function insert()
    {
        $sql = new Sql();

        //Procedure CALL ;
        //A procedure vai mostrar no Com a função o último id gerado na tabela
        //DICA: Se fosse no SQL SERVER no lugar do CALL seria EXECUTE;
<<<<<<< HEAD
        $result = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
            ':LOGIN'=> $this->getDeslogin(),
            ':PASSWORD'=>$this->getDessenha()
        ));

        if (isset($result[0])){
=======
        $result = $sql->select('CALL sp_usuarios_insert(:LOGIN, :PASSWORD)', [
            ':LOGIN' => $this->getDeslogin(),
            ':PASSWORD' => $this->getDessenha(),
        ]);
>>>>>>> 65c5d2b87b6cf6819d55cc1ade6d113060fa62db

        if (count($result) > 0) {
            $this->setDados($result[0]);
        }
<<<<<<< HEAD
    } 

    public function __construct($login = "", $password = ""){
    $this->setDeslogin($login);
    $this->setDessenha($password);

    }

    //Método de Uptade(Atualização)
    public function update($login, $password){

        $this->setDeslogin($login);
        $this->setDessenha($password);
        
        $sql = new Sql();

        $sql->query("UPDATE tb_usuario SET desLogin = :LOGIN, desSenha = :PASSWORD WHERE idUsuario = :ID", array(
            ':LOGIN'=>$this->getDeslogin(),
            ':PASSWORD'=>$this->getDessenha(),
            ':ID'=>$this->getIdusuario()

        ));
    }


    //Chamando tudo em formado de STRING
    //IMPORTANTE= Se não formatar para string vai da ERRO pq o idUsuario não pode ser convertido para string, só com a função toString
    public function __toString(){
        return json_encode(array(
                "idUsuario"=>$this->getIdusuario(),
                "desLogin"=>$this->getDeslogin(),
                "dessenha"=>$this->getDessenha(),
                "Dtcadastro"=>$this->getDtcadastro()->format("d/m/Y h:i:s")
        ));
=======
>>>>>>> 65c5d2b87b6cf6819d55cc1ade6d113060fa62db
    }
}