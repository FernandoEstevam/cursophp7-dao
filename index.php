<?php
    //Chamando o autoload
    require_once("config.php");

    // $sql = new Sql();
    // $usuarios = $sql->select("SELECT * FROM tb_usuarios");
    // echo json_encode($usuarios);

    //Carrega somente um dado pelo ID
    //$root = new Usuario();
    //$root->loadById(1);
    // echo $root;

    
    //Carrega uma lista de dados da tabela
    //Por ser um metodo static não há necessidade de instanciar a class Usuario
    //Pode chmar direto
    // $lista = Usuario::getList();
    // echo json_encode($lista);

    //Carrega a procura no banco de dados pelo login
    // $search = Usuario::search('o');
    // echo json_encode($search);

    //Carrega o usuario usando login e a senha faz a validação
    // $login = new Usuario();
    // $login->login("Fernando","709244");

    // echo $login;

    //Inserindo usuario no banco de dados
    //Instanciando a clas Usuario()
    //$aluno = new Usuario();

    //Passando as informações pelo método set
    //$aluno->setDeslogin("aluno");
    //$aluno->setDessenha("779988");

    //Chamando o método insert para executar a inserção no banco de dados
    //$aluno->insert();
    //echo $aluno;

    //Inserido dados no banco de dados atraves do método construct
    // $aluno = new Usuario("William","127529");
    // $aluno->insert();
    // echo $aluno;

    //Fazendo o update da tabela de usuarios
    $usuario = new Usuario();
    //Carrega o registro
    $usuario->loadById(11);
    echo $usuario;
    //Atualiza o usuario o banco de dados
    $usuario->update("Creusa", "1111");
    echo $usuario;
?>