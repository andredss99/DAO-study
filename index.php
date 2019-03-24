<?php

    require_once("config.php");

    #Carrega um usuário por vez
    /*
     * $root = new Usuario();    
     * $root->loadById(3);
     */

    #Carrega uma lista de usuários
    /*
     * $lista = Usuario::getList();
     * echo json_encode($lista); 
     */

    #Carrega uma lista de usuários buscando pelo login
    /*
     * $search = Usuario::search("jo");
     * echo json_encode($search);
     */
    
    #Carrega um usuário usando o login e a senha
    /*
     * $usuario = new Usuario();
     * $usuario->login("root", "!@#$");
     * echo $usuario;
     */
    
    $aluno = new Usuario("aluno2", "@lun02");
    
    $aluno->insert();

    echo $aluno;

?>