<?php
require_once __DIR__ . '/includes/conexao.php';
require_once __DIR__ . '/includes/autenticacao.php';

$erro = '';

if($_SERVER === ['POST']){
    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if($email === '' | $senha === ''){
        $erro = 'preencha todos os dados';
    }

    $sql = "SELECT * FROM usuarios where email = :email or numero = :email";

    $pdo->prepare($sql);
    $stmt = $pdo->execute([
        ':email' => $email
    ]);

    $usuario = $stmt->fetch();

    if($usuario && password_verify($senha, $usuario['senha'])){
        session_regenerate_id(true);

        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_apelido'] = $usuario['apelido'];
        $_SESSION['usuario_email'] = $usuario['email'];

        header('Location: /app/index.php');
        exit;
    } else {
        $erro = 'E-mail ou senha incorretos.';
    }
}

?>
<html>
    <body>
        <form method="POST">
            <h1>Bem Vindo de Volta!</h1>
            <h3>Estamos felizes em te ver novamente</h3>
            <label for="email">EMAIL OU NÚMERO DE TELEFONE *</label>
            <input type="text" name="email" id="email">
            <label for="senha">SENHA *</label>
            <input type="senha" name="senha" id="senha">
            <button type="button">Entrar</button>
            <p>Não possui uma conta? <a href="cadastro.php">Registrar</a></p>
    </form>    
    </body>
</html>