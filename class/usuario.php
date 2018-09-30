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

                $row = $results[0];

                $this->setIdusuario($row['idusuario']);
                $this->setDeslogin($row['deslogin']);
                $this->setDessenha($row['dessenha']);
                $this->setDtcadastro(new DateTime($row['dtcadastro']));

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
   
                   $row = $results[0];
   
                   $this->setIdusuario($row['idusuario']);
                   $this->setDeslogin($row['deslogin']);
                   $this->setDessenha($row['dessenha']);
                   $this->setDtcadastro(new DateTime($row['dtcadastro']));
   
               } else {

                throw new Exception("Login e/ou senha inválidos!");
                
               }

        }

    }

?>