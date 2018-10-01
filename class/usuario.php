<?php

    //Declarando a classe Usuario
    class Usuario {

        //Declarando os atributos
        private $idusuario;
        private $deslogin;
        private $dessenha;
        private $dtcadastro;


        //Declarando os métodos get e set
        //get envia os valores
        //set recebe os valores
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

        //Método consulta pelo ID
        public function loadById($id){
            //Instancia a class Sql
            $sql = new Sql();
            //Chama o método select
            $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(

                ":ID"=>$id
            ));            

            if(count($results) > 0){

                $this->setData($results[0]);

            }
        }

        //Converte o objeto em uma string e retorna em json
        public function __toString(){

            return json_encode(array(
                "idusuario"=>$this->getIdusuario(),
                "deslogin"=>$this->getDeslogin(),
                "dessenha"=>$this->getDessenha(),
                "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
            ));

        }

        //Método traz a lista de todos dados da tabela id_usuarios
        //Não precisa instanciar o objeto Usuario()
        public static function getList(){

            //Instanciando a class Sql
            $sql = new Sql();

            return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");

        }

        //Métodos busca de dados no banco de dados
        public static function search($login){

            $sql = new Sql();

            return  $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
                ':SEARCH'=>"%".$login."%"
            ));

        }

        //Método lista do banco de dados obtem os dados do usuarios autenticados
        public function login($login, $password){

               //Instancia a class Sql
               $sql = new Sql();
               //Chama o método select
               $results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
                   ":LOGIN"=>$login,
                   ":PASSWORD"=>$password
               ));            
   
               if(count($results) > 0){
   
                    $this->setData($results[0]);
   
               } else {

                throw new Exception("Login e/ou senha inválidos!");
                
               }

        }

        //Método recebe os dados do metodo set
        public function setData($data){

            $this->setIdusuario($data['idusuario']);
            $this->setDeslogin($data['deslogin']);
            $this->setDessenha($data['dessenha']);
            $this->setDtcadastro(new DateTime($data['dtcadastro']));

        }

        //Método insere dados no banco de dados
        public function insert(){

            $sql = new Sql();   
                                    //Procedure banco de dados mysql
            $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(

                ':LOGIN'=>$this->getDeslogin(),
                ':PASSWORD'=>$this->getDessenha()

            ));

            if(count($results) > 0){
                $this->setData($results[0]);
            }
        }

        //Método construct recebe ja os valores de login e password
        //Os paramentros com = "" esta atribuindo os valores as variáveis
        //Caso não seja passado o valor fica padrão
        public function __construct($login = "", $password = ""){

            $this->setDeslogin($login);
            $this->setDessenha($password);

        }

        //Método para atulizar o banco de dados 
        public function update($login, $password){

            $this->setDeslogin($login);
            $this->setDessenha($password);

            $sql = new Sql();

            $sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(

                ':LOGIN'=>$this->getDeslogin(),
                ':PASSWORD'=>$this->getDessenha(),
                ':ID'=>$this->getIdusuario()

            ));

        }

    }

?>