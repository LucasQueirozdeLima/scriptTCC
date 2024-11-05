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

   public function verificarLogin($verificador, $senha) 
    {
        $usuario = $this->pdo->query("SELECT * FROM usuario WHERE nome_usuario='$verificador' OR email='$verificador' AND senha='$senha'");

        if ($usuario->fetch()) {
            header("Location: ../pages/auth/user/home_user.php");
        } else {
            $admin = $this->pdo->query("SELECT * FROM usuario_admin WHERE nome_usuario='$verificador' OR email='$verificador' AND senha='$senha'");
            if ($admin->fetch()) {
                header("Location: ../pages/auth/admin/home_admin.php");
            } else {
                header("Location: ../pages/login.php?erro=1");
            }
        }
    }

    //inserção de dados

    public function inserirUsuario($nome, $nome_usuario, $email, $senha) 
    {
        try {
            $inserirUser = $this->pdo->query("INSERT INTO usuario (nome, nome_usuario, email, senha) VALUES ('$nome', '$nome_usuario', '$email', '$senha')"); 
            header("Location: ../pages/login.php");
        } catch (PDOException $erroCadastro) {
            header("Location: ../pages/cadastro_usuario.php?error=1");
        }
    }

    public function inserirUsuarioAdmin($nome, $nome_usuario, $documento, $email, $cargo, $senha) 
    {
        try {
            $inserirAdmin = $this->pdo->query("INSERT INTO usuario_admin (nome, nome_usuario, documento, email, cargo, senha) VALUES ('$nome', '$nome_usuario', '$documento', '$email', '$cargo', '$senha')");
            header("Location: ../pages/login.php");
        } catch (PDOException $erroCadastro) {
            //header("Location: ../pages/cadastro_admin.php?error=1");
            echo $erroCadastro;
        }
    }

    public function inserirAcademia($rua, $numero, $bairro, $cidade, $complemento,$cep, $razao_social, $cnpj, $status_academia,$descricao, $capacidade_max)
    {
        try {
            $endereco = $this->pdo->query("INSERT INTO endereco (rua, numero, bairro, cidade, complemento, cep) VALUES ('$rua', '$numero', '$bairro', '$cidade', '$complemento','$cep')");

            $recuperar_idEndereco = $this->pdo->query("SELECT id_endereco FROM endereco WHERE numero='$numero' AND cep='$cep'"); //correção necessaria
            
            $academia = $this->pdo->query("INSERT INTO academia (razao_social, cnpj, endereco_id, status_academia,descricao, capacidade_max) VALUES ('$razao_social', '$cnpj', '$recuperar_idEndereco', '$status_academia','$descricao', '$capacidade_max')");

        } catch (PDOException $erroCadastro) {
            header("Location: ../pages/auth/admin/cadastro_academia.php?error=1");
        }
    }

    //RECUPERAR DADOS

    public function recuperarDadosUsuario ($verificador) 
    {
        $usuario = $this->pdo->query("SELECT * FROM usuario WHERE nome_usuario='$verificador' OR email='$verificador'");
        return $usuario;
    }

    public function recuperarDadosAdmin ($verificador) 
    {
            $admin = $this->pdo->query("SELECT * FROM usuario_admin WHERE nome_usuario='$verificador' OR email='$verificador'");
            return $admin;   
    }

    //UPDATES

    public function atualizarSenha($email, $novaSenha) {
        $hashedSenha = password_hash($novaSenha, PASSWORD_DEFAULT);
        $query = "UPDATE usuario SET senha='$hashedSenha' WHERE email='$email'";
        
        $stmt = $this->pdo->query($query);
        
        // Verifica se a senha foi alterada com sucesso
        return $stmt->rowCount() > 0;
    }
    



    //LOGOUT

    public function logout() {
        session_unset();  
        session_destroy(); 
        header("Location: ../../index.php"); 
        exit();
    }

    


 
    public function atualizarFrequencia($academia_id, $valor) {
        $this->pdo->query("UPDATE frequencia SET num_atual = num_atual + $valor WHERE academia_id = $academia_id");
    }
    

    public function obterFrequenciaAtual($idAcademia) {
        try {
            $stmt = $this->pdo->prepare("SELECT num_atual, capacidade_max FROM frequencia WHERE id_academia = :id_academia");
            $stmt->bindParam(':id_academia', $idAcademia, PDO::PARAM_INT);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return $result;
            } else {
                return ["num_atual" => 0, "capacidade_max" => 0];
            }
        } catch (PDOException $e) {
            echo "Erro de consulta: " . $e->getMessage();
            return ["num_atual" => 0, "capacidade_max" => 0];
        }
    }
    

public function inserirFrequencia($academiaId, $numAtual) {
    $stmt = $this->pdo->prepare("INSERT INTO frequencia (num_atual, data, academia_id) VALUES (:numAtual, NOW(), :academiaId)");
    $stmt->bindParam(':numAtual', $numAtual);
    $stmt->bindParam(':academiaId', $academiaId);
    return $stmt->execute();
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
