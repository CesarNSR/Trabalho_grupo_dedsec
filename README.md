<h1>Como Usar</h1>
<p>pra funcionar precisa deixar a pasta do projeto dentro da pasta "htdocs" do xampp e abrir usando o seguinte url "http://localhost/Tela-de-Login/"</p>

<h2>Em seguida</h2>

Pra fazer funcionar, tem que recriar o banco de dados no xampp/localhost, é só usar o comando no terminar la 
<p>-- Cria o banco</p>
<p>CREATE DATABASE IF NOT EXISTS sistema; </p>

<p>-- Usa o banco </p>
<p>USE sistema;</p>

<p>-- Cria a tabela de usuários</p>
<p>CREATE TABLE IF NOT EXISTS usuarios (</p>
   <p> id INT AUTO_INCREMENT PRIMARY KEY,</p>
    <p> usuario VARCHAR(100) NOT NULL UNIQUE,</p>
    <p> senha VARCHAR(255) NOT NULL</p>
<p>);</p>
