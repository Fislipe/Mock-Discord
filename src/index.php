<?php
require_once __DIR__ . '/includes/conexao.php';
require_once __DIR__ . '/includes/autenticacao.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    if ($email === '' || $senha === '') {
        $erro = 'Preencha todos os campos.';
    } else {
        $sql = "SELECT * FROM usuarios
                WHERE email = :email OR numero = :numero";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':email' => $email,
            ':numero' => $email
        ]);
        $usuario = $stmt->fetch();
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            session_regenerate_id(true);
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_apelido'] = $usuario['apelido'];
            $_SESSION['usuario_email'] = $usuario['email'];
            header("Location: /app/index.php");
            exit;
        } else {
            $erro = 'E-mail, telefone ou senha incorretos.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discord - 2.0</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <?php include __DIR__ . '/login.php'; ?>
</body>
</html>