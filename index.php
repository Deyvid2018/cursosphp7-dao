<?php

require_once("config.php");
/*
//Mostrar a Tabela
    $sql = new Sql();
    $usuarios = $sql->select("SELECT * FROM tb_usuario");
    echo json_encode($usuarios);
*/
/*
//Carregar 1 Usuario apenas

    $root = new Usuario();
    $root->carregarId(2);
    echo $root;
*/
/*
//Carrega uma lista de usuários
    
    $lista = Usuario::getList();
    echo json_encode($lista);
*/

/*
//Para pesquisar o Usuario! pode ser até simplificado por causa do banco e seu comando %%
    $search = Usuario::Pesquisar("de");
    echo json_encode($search)

*/

/* 
//Verificação de Login

$usuarioTeste = new Usuario();
$usuarioTeste->login("Deyvid","12345"); //Passar os parametros(os dados de login);

 echo $usuarioTeste;
*/

/*
//A inclusão de um novo Usuario no BD

$aluno = new Usuario();
$aluno->setDeslogin("aluno");
$aluno->setDessenha("2223");

$aluno->insert();
echo $aluno;
*/

$usuarios = new Usuario();

$usuarios->carregarId(2);

$usuarios->update("PedS","101010");

echo $usuarios;

?>