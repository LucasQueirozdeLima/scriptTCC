<?php
class Dao {
    private $dsn = "mysql:host=localhost;dbname=fitrealtime";
    private $username = "root";
    private $password = "";
    private $pdo;

    //Metodo contrutor

    public function __construct() 
    {
        $this->pdo = new PDO($this->dsn, $this->username, $this->password);
    }

    //Verificar se o login é possivel

    public function verificarLoginUsuario($verificador, $senha) 
    {
        $stmt = $this->pdo->query("SELECT * FROM usuario WHERE usuario='$verificador' OR email='$verificador' AND senha='$senha'");
        if ($stmt->fetch()) {
            header("Location: home_page.php");
        } else {
            header("Location: index.php?erro=1");
        }
    }

    public function verificarLoginUsuarioAdmin($verificador, $senha) 
    {
        $stmt = $this->pdo->query("SELECT * FROM usuario_admin WHERE usuario='$verificador' OR email='$verificador' AND senha='$senha'");
        if ($stmt->fetch()) {
            header("Location: home_page.php");
        } else {
            header("Location: index.php?erro=1");
        }
    }

    //inserção de dados

    public function inserirUsuario($usuario, $senha, $telefone, $email, $endereco) 
    {
        try {
            $stmt = $this->pdo->query("INSERT INTO login (usuario, senha, telefone, email, endereco) VALUES ('$usuario', '$senha', '$telefone', '$email', '$endereco')");
        } catch (PDOException $erroCadastro) {
            header("Location: cadastro.php?error=1");
        }
    }

    public function inserirUsuarioAdmin($usuario, $senha, $telefone, $email, $endereco) 
    {
        try {
            $stmt = $this->pdo->query("INSERT INTO usuario_admin (usuario, senha, telefone, email, endereco) VALUES ('$usuario', '$senha', '$telefone', '$email', '$endereco')");
        } catch (PDOException $erroCadastro) {
            header("Location: cadastro.php?error=1");
        }
    }

    public function inserirAcademia()
    {
        try {
            $stmt = $this->pdo->query("INSERT INTO endereco (usuario, senha, telefone, email, endereco) VALUES ('$usuario', '$senha', '$telefone', '$email', '$endereco')");
        } catch (PDOException $erroCadastro) {
            header("Location: cadastro.php?error=1");
        }

        try {
            $stmt = $this->pdo->query("INSERT INTO academia (usuario, senha, telefone, email, endereco) VALUES ('$usuario', '$senha', '$telefone', '$email', '$endereco')");
        } catch (PDOException $erroCadastro) {
            header("Location: cadastro.php?error=1");
        }
    }

    //Buscar dados para exibição

    /*rascunho


    public function exibirAdmins($id) 
    {
        $stmt = $this->pdo->query("SELECT * FROM usuario_admin WHERE id = " . $id);
        return $stmt;
    }

    public function exibirAcademias($id) 
    {
        $stmt = $this->pdo->query("SELECT * FROM academia WHERE id = " . $id);
        return $stmt;
    }

    public function resetarEnumerador()
    { 
        $stmt = $this->pdo->query("update academia set num_pessoas = 0
        where num_pessoas != 0 and horario = '24'");
    }

*/
}  
?>
