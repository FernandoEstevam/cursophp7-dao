<?php

    //Declarando a class extendida da classe PDO
    class Sql extends PDO {

        //Declarando o atributo da class
        private $conn;

        //Construindo um novo objeto conn para conexão com o banco de dados
        //Método 1
        public function __construct(){
            $this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root", "");
        }

        //Declarando os métodos recebe o comando e os dados
        //Métodos 2
        private function setParams($statement, $parameters = array()){

            //Loop dos parametros, das chaves e dos valores da consulta
            foreach ($parameters as $key => $value) {
                       //Método 4 - Passando os paramentros para os values do stmt 
                $this->setParam($statement, $key, $value);

            }

        }

        //Declarando o método para passar os valores para o
        //Método 4
        private function setParam($statement, $key, $value){
                //Função criada para passar paramentros para os values do stmt
            $statement->bindParam($key, $value);

        }

        //Declarando um método query(consulta) com dois paramentros prepara a consulta       
        //Método 3
        public function query($rawQuery, $params = array()){
            
            //Prepara o comando para ser executado
                          //Método 1 - conexao
            $stmt = $this->conn->prepare($rawQuery);
            
            //Seta os valores do loop
                   //Métodos 2 - seta os comandos e os dados
            $this->setParams($stmt, $params);

            //Executa o comando
            $stmt->execute();

            //Retorna o valor da consulta em array
            return $stmt;
        
        }

        //Método consulta 
        public function select($rawQuery, $params = array()):array{
            
            //Coleta o comando e o paramentro da consulta do metodo query()
                           //Método 3 - faz a consulta na tabela de dados
            $stmt = $this->query($rawQuery, $params);

            //Retorna em array a consulta
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        }
    }

?>