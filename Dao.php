<?php
Class Dao
{    
    private $dsn = "mysql:host=localhost;dbname=";
    private $username = "root";
    private $password = "";
    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDO($this->dsn, $this->username, $this->password);
    }

    public function exibirUsuario($id){
        $stmt = $this->pdo->query("select * from login where id=".$id);
        return $stmt;
    }    

    public function verificaLogin($usuario,$senha){
        $stmt = $this->pdo->query("Select * from login where usuario='$usuario' and senha='$senha'");
        if($stmt->fetch()){
            header("Location: home_page.php");
        } else { 
            header("Location: index.php?erro=1");
        }
    }

    public function insertLogin($usuario, $senha, $telefone, $email, $endereco){
        try {
            $stmt = $this->pdo->query("insert into login( usuario, senha, telefone, email, endereco) values ('$usuario', '$senha', '$telefone', '$email', '$endereco')");
        } catch(PDOException $erroCadastro){
            header("Location: cadastro.php?error=1");
        }
    }

    public function resetarEnumerador(){ 
        $stmt = $this->pdo->query("update academia set num_pessoas = 0
        where num_pessoas != 0 and horario = '24'");
    }
}
