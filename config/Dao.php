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
        // Consulta para o usuário normal
        $usuario = $this->pdo->query("SELECT * FROM usuario WHERE (nome_usuario='$verificador' OR email='$verificador') AND senha='$senha'");
    
        if ($usuario->fetch()) {
            $dadosUsuario = $usuario->fetch(PDO::FETCH_ASSOC);
            // Salvar dados na sessão
            $_SESSION['verificador'] = $verificador;
            $_SESSION['id_usuario'] = $dadosUsuario['id_usuario'];
            $_SESSION['nome_usuario'] = $dadosUsuario['nome_usuario'];
    
            // Redirecionar para a página do usuário
            header("Location: ../pages/auth/user/home_user.php");
        } else {
            // Consulta para administrador
            $admin = $this->pdo->query("SELECT * FROM usuario_admin WHERE (nome_usuario='$verificador' OR email='$verificador') AND senha='$senha'");
    
            if ($dadosAdmin = $admin->fetch(PDO::FETCH_ASSOC)) {
                // Salvar dados na sessão
                $_SESSION['verificador'] = $verificador;
                $_SESSION['id_admin'] = $dadosAdmin['id_admin'];
                $_SESSION['nome_usuario'] = $dadosAdmin['nome'];
    
                // Redirecionar para a página do administrador
                header("Location: ../pages/auth/admin/home_admin.php");
                exit;
            } else {
                // Redirecionar para a página de login com erro
                header("Location: ../pages/login.php?erro=1");
                exit;
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
        session_unset();
        session_destroy();
        header("Location: ../../index.php");
        exit();
    }


    
    // Inserir favorito academia
    public function favoritarAcademia($idAcademia)
    {
        session_start(); // Inicia a sessão ou retoma uma existente

        // Verifica se o usuário está logado
        if (!isset($_SESSION['id_usuario'])) {
            // Redireciona para a página de login se não estiver logado
            header("Location: ../../login.php?erro=login_required");
            exit;
        }

        try {
            // Prepara e executa o comando para inserir nos favoritos
            $favoritar = $this->pdo->prepare("INSERT INTO favoritos (id_usuario, id_academia) VALUES (:idUsuario, :idAcademia)");
            $favoritar->execute([
                ':idUsuario' => $_SESSION['id_usuario'],
                ':idAcademia' => $idAcademia
            ]);
            echo "<script>console.log('Academia favoritada com sucesso!');</script>";
        } catch (PDOException $erroFavoritos) {
            // Log do erro no console
            echo "<script>console.log('" . $erroFavoritos->getMessage() . "');</script>";
        }
    }
    
    public function desfavoritarAcademia($idUsuario, $idAcademia) {
        try {
            // Prepara a consulta para remover a academia dos favoritos
            $sql = "DELETE FROM favoritos WHERE id_usuario = :id_usuario AND id_academia = :id_academia";
            $stmt = $this->pdo->prepare($sql);
    
            // Vincula os parâmetros
            $stmt->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
            $stmt->bindParam(':id_academia', $idAcademia, PDO::PARAM_INT);
    
            // Executa a consulta
            $stmt->execute();
    
            echo "<script>console.log('Academia removida dos favoritos com sucesso.');</script>";
    
        } catch (PDOException $e) {
            echo "<script>console.log('Erro: " . $e->getMessage() . "');</script>";
        }
    }
    
    public function inserirAcademia($razao_social, $cnpj, $status_academia, $descricao, $capacidade) {
        try {
            // Preparando a consulta SQL de inserção
            $sql = "INSERT INTO academia (razao_social, cnpj, status_academia, descricao,endereco_id, capacidade_max)
                    VALUES (:razao_social, :cnpj, :status_academia, :descricao, 1, :capacidade)";
            $stmt = $this->pdo->prepare($sql);

            // Bind dos parâmetros para evitar SQL Injection
            $stmt->bindParam(':razao_social', $razao_social);
            $stmt->bindParam(':cnpj', $cnpj);
            $stmt->bindParam(':status_academia', $status_academia);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':capacidade', $capacidade, PDO::PARAM_INT);

            // Executando a consulta
            $stmt->execute();

            // Retorna o ID da academia inserida
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            // Em caso de erro, lança uma exceção
            throw new Exception("Erro ao inserir academia: " . $e->getMessage());
        }
    }

public function getFavoritos($idUsuario) {
    try {
        // Preparar a consulta SQL com parâmetro
        $sql = "SELECT f.id_academia, a.razao_social, a.capacidade_max, a.endereco_id 
                FROM favoritos f
                INNER JOIN academia a ON f.id_academia = a.id_academia
                WHERE f.id_usuario = :id_usuario"; // Usando parâmetro para evitar SQL Injection

        // Preparar a consulta
        $favoritos = $this->pdo->prepare($sql);

        // Bind de parâmetro para o ID do usuário
        $favoritos->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);

        // Executar a consulta
        $favoritos->execute();

        // Verificar se a consulta retornou algum resultado
        $resultados = $favoritos->fetchAll(PDO::FETCH_ASSOC);

        // Log da consulta SQL (para verificar a consulta executada)
        echo "<script>console.log('Consulta SQL executada: " . addslashes($sql) . "');</script>";

        // Log dos resultados obtidos
        echo "<script>console.log('Favoritos encontrados: " . addslashes(json_encode($resultados)) . "');</script>";

        // Retornar os resultados ou um array vazio se nenhum favorito foi encontrado
        return $resultados ?: [];
    } catch (PDOException $error) {
        // Registra o erro
        echo "<script>console.log('Erro na consulta: " . addslashes($error->getMessage()) . "');</script>";
        return []; // Retorna um array vazio em caso de erro
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
