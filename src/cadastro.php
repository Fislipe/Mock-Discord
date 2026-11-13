<?php
require_once __DIR__ . '/includes/conexao.php';
require_once __DIR__ . '/includes/autenticacao.php';

$erro = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $apelido = trim($_POST['apelido'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $num_telefone = trim($_POST['num_telefone'] ?? '');
    $senha = $_POST['senha'];

    if($apelido === '' | $email === '' | $senha === ''){
        $erro = 'Preencha todos os campos.';
    }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $erro = 'Digite um email valido.';
    }else if(strlen($senha) < 6){
        $erro = 'A senha precisa ter ao menos 6 caracteres.';
    }else{
        $senhaCript = password_hash($senha, PASSWORD_DEFAULT);
        try{
            $sql = 'insert into usuarios (apelido, email, senha) values (:apelido, :email, :email)';
            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':apelido' => $apelido,
                ':email' => $email,
                ':senha' => $senhaCript
            ]);
            header('Location: /login.php');
            exit;
        }catch (PDOException $e){
            if ($e->getCode() === '23000') {
                $erro = 'Este e-mail já está cadastrado.';
            } else {
                $erro = 'Não foi possível realizar o cadastro.';
            }
        }
    }
}
?>

<!DOCTYPE html>
    </head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Discord - 2.0</title>
        <link rel="stylesheet" href="assets/css/cadastro.css">
    </head>
    <body>
        <form method="POST">
            <h1>Registre-se no Discord</h1>
            <label for="apelido">NOME DE USUÁRIO *</label>
            <input type="text" name="apelido" id="apelido" require>
            <label for="email">EMAIL *</label>
            <input type="text" name="email" id="email" require>
            <label for="num_telefone">NÚMERO DE TELEFONE *</label>
            <input type="text" name="num_telefone" id="num_telefone" require>
            <label for="senha">SENHA *</label>
            <input type="text" name="senha" id="senha">
            <p>Já possui uma conta? <a href="index.php">Entrar</a></p>
            <button id="registro">CRIAR CONTA</button>
        </form>
    </body>
</html>