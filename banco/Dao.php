<?php
class Dao {
    private $dsn = "mysql:host=localhost;dbname=nome_do_banco";
    private $username = "root";
    private $password = "";
    private $pdo;

    public function __construct() 
    {
        $this->pdo = new PDO($this->dsn, $this->username, $this->password);
    }

    public function exibirUsuario($id) 
    {
        $stmt = $this->pdo->query("SELECT * FROM login WHERE id = " . $id);
        return $stmt;
    }

    public function verificaLogin($usuario, $senha) 
    {
        $stmt = $this->pdo->query("SELECT * FROM login WHERE usuario='$usuario' AND senha='$senha'");
        if ($stmt->fetch()) {
            header("Location: home_page.php");
        } else {
            header("Location: index.php?erro=1");
        }
    }

    public function insertLogin($usuario, $senha, $telefone, $email, $endereco) 
    {
        try {
            $stmt = $this->pdo->query("INSERT INTO login (usuario, senha, telefone, email, endereco) VALUES ('$usuario', '$senha', '$telefone', '$email', '$endereco')");
        } catch (PDOException $erroCadastro) {
            header("Location: cadastro.php?error=1");
        }
    }

    public function resetarEnumerador()
    { 
        $stmt = $this->pdo->query("update academia set num_pessoas = 0
        where num_pessoas != 0 and horario = '24'");
    }
}
?>
