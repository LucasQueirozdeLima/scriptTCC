<?php
class Dao
{
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
        session_start();

        // Consulta para usuários comuns
        $usuario = $this->pdo->prepare("SELECT * FROM usuario WHERE (nome_usuario=:verificador OR email=:verificador) AND senha=:senha");
        $usuario->execute([
            ':verificador' => $verificador,
            ':senha' => $senha
        ]);

        if ($dadosUsuario = $usuario->fetch(PDO::FETCH_ASSOC)) {
            // Salva os dados corretos na sessão
            $_SESSION['verificador'] = $verificador;
            $_SESSION['id_usuario'] = $dadosUsuario['id_usuario']; // Certifique-se de que o campo 'id_usuario' existe no banco
            $_SESSION['nome_usuario'] = $dadosUsuario['nome_usuario'];

            header("Location: ../pages/auth/user/home_user.php");
            exit;
        }

        // Consulta para administradores
        $admin = $this->pdo->prepare("SELECT * FROM usuario_admin WHERE (nome_usuario=:verificador OR email=:verificador) AND senha=:senha");
        $admin->execute([
            ':verificador' => $verificador,
            ':senha' => $senha
        ]);

        if ($dadosAdmin = $admin->fetch(PDO::FETCH_ASSOC)) {
            $_SESSION['verificador'] = $verificador;
            $_SESSION['id_admin'] = $dadosAdmin['id_admin'];
            $_SESSION['nome_usuario'] = $dadosAdmin['nome'];

            header("Location: ../pages/auth/admin/home_admin.php");
            exit;
        }

        // Se nenhum usuário foi encontrado
        header("Location: ../pages/login.php?erro=1");
        exit;
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


    //RECUPERAR DADOS

    public function recuperarDadosUsuario($verificador)
    {
        $usuario = $this->pdo->query("SELECT * FROM usuario WHERE nome_usuario='$verificador' OR email='$verificador'");
        return $usuario;
    }

    public function recuperarDadosAdmin($verificador)
    {
        $admin = $this->pdo->query("SELECT * FROM usuario_admin WHERE nome_usuario='$verificador' OR email='$verificador'");
        return $admin;
    }

    //UPDATES

    public function atualizarSenha($email, $novaSenha)
    {
        $hashedSenha = password_hash($novaSenha, PASSWORD_DEFAULT);
        $query = "UPDATE usuario SET senha='$hashedSenha' WHERE email='$email'";

        $stmt = $this->pdo->query($query);

        // Verifica se a senha foi alterada com sucesso
        return $stmt->rowCount() > 0;
    }

    //LOGOUT

    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: ../../index.php");
        exit();
    }


   public function removerAcademia($idAcademia)
{
    try {
        $query = $this->pdo->prepare("DELETE FROM academia WHERE id_academia = :idAcademia");
        $query->bindParam(':idAcademia', $idAcademia, PDO::PARAM_INT);

        if ($query->execute()) {
            return ['success' => true, 'message' => 'Academia removida com sucesso'];
        } else {
            return ['success' => false, 'message' => 'Falha ao remover a academia'];
        }
    } catch (PDOException $e) {
        error_log("Erro ao remover academia: " . $e->getMessage());
        return ['success' => false, 'message' => 'Erro ao remover a academia'];
    }
}

    



    public function favoritarAcademia($idAcademia)
    {
        session_start();

        if (!isset($_SESSION['id_usuario'])) {
            echo "Erro: ID do usuário não está definido na sessão.";
            print_r($_SESSION); 
            exit;
        }


        try {

            $favoritar = $this->pdo->prepare("INSERT INTO favoritos (id_usuario, id_academia) VALUES (:idUsuario, :idAcademia)");
            $favoritar->execute([
                ':idUsuario' => $_SESSION['id_usuario'],
                ':idAcademia' => $idAcademia
            ]);
            echo "<script>console.log('Academia favoritada com sucesso!');</script>";
        } catch (PDOException $erroFavoritos) {

            echo "<script>console.log('" . $erroFavoritos->getMessage() . "');</script>";
        }
    }

    public function desfavoritarAcademia($idUsuario, $idAcademia)
    {
        try {

            $sql = "DELETE FROM favoritos WHERE id_usuario = :id_usuario AND id_academia = :id_academia";
            $stmt = $this->pdo->prepare($sql);


            $stmt->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
            $stmt->bindParam(':id_academia', $idAcademia, PDO::PARAM_INT);


            $stmt->execute();

            echo "<script>console.log('Academia removida dos favoritos com sucesso.');</script>";
        } catch (PDOException $e) {
            echo "<script>console.log('Erro: " . $e->getMessage() . "');</script>";
        }
    }

    public function inserirAcademia($razao_social, $cnpj, $status_academia, $descricao, $capacidade, $rua, $numero, $bairro, $cidade, $cep)
    {
        try {

            $sqlEndereco = "INSERT INTO endereco (rua, numero, bairro, cidade, cep) VALUES (:rua, :numero, :bairro, :cidade, :cep)";
            $stmtEndereco = $this->pdo->prepare($sqlEndereco);

            $stmtEndereco->bindParam(':rua', $rua);
            $stmtEndereco->bindParam(':numero', $numero);
            $stmtEndereco->bindParam(':bairro', $bairro);
            $stmtEndereco->bindParam(':cidade', $cidade);
            $stmtEndereco->bindParam(':cep', $cep);

            $stmtEndereco->execute();

            $idEndereco = $this->pdo->lastInsertId();

            $sql = "INSERT INTO academia (razao_social, cnpj, status_academia, descricao,endereco_id, capacidade_max)
                    VALUES (:razao_social, :cnpj, :status_academia, :descricao, :endereco, :capacidade)";
            $stmt = $this->pdo->prepare($sql);


            $stmt->bindParam(':razao_social', $razao_social);
            $stmt->bindParam(':cnpj', $cnpj);
            $stmt->bindParam(':status_academia', $status_academia);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':capacidade', $capacidade, PDO::PARAM_INT);
            $stmt->bindParam(':endereco', $idEndereco);


            $stmt->execute();


            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {

            throw new Exception("Erro ao inserir academia: " . $e->getMessage());
        }
    }

    public function getFavoritos($idUsuario)
    {
        try {
            $sql = "
                SELECT 
                    f.id_academia, 
                    a.razao_social, 
                    a.capacidade_max, 
                    e.rua, 
                    e.numero, 
                    e.bairro, 
                    e.cidade, 
                    e.complemento, 
                    e.cep
                FROM favoritos f
                INNER JOIN academia a ON f.id_academia = a.id_academia
                INNER JOIN endereco e ON a.endereco_id = e.id_endereco
                WHERE f.id_usuario = :id_usuario
            ";
    
            $favoritos = $this->pdo->prepare($sql);
            $favoritos->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
            $favoritos->execute();
    
            return $favoritos->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            error_log($error->getMessage(), 3, 'errors.log');
            return [];
        }
    }
    


    public function recuperarDicas($objetivo)
    {
        // Prevenção de SQL Injection usando prepared statements
        $query = "SELECT dica FROM DicasAlimentacao WHERE objetivo = :objetivo";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':objetivo', $objetivo, PDO::PARAM_STR);
        $stmt->execute();

        // Recupera todas as dicas que correspondem ao objetivo
        $dicas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Verifica se há dicas e retorna uma aleatória
        if (count($dicas) > 0) {
            // Escolhe uma dica aleatória
            $index = array_rand($dicas);
            return $dicas[$index]['dica'];
        } else {
            return null; // Retorna null caso não encontre dicas
        }
    }
}



/*
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
