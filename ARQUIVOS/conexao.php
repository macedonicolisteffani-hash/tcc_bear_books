<?php

/*Abaixo é informado o acesso ao banco de dados, caminho do servidor, 
usuario do banco (root), senha (vazia), nome do banco criado */

$servername = "localhost";
$username = "root";
$password = "";
$database = "bear_books";

/*Linha de Consexão usando a biblioteca mysqli é uma biblioteca é 
responsável por conectar ao banco de dados*/
$conn = new mysqli($servername,$username,$password,$database); 


/*Este trecho é utilizado para caso ocorra erro devolver
ao usuário uma mensagem de erro para ele resolver*/
if ($conn->connect_error){
    die("Conexão falhou".$conn->connect_error);
}
?>