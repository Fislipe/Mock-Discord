<?php
require_once __DIR__ . '/../includes/conexao.php';
require_once __DIR__ . '/../includes/autenticacao.php';

$aba = $_GET['aba'] ?? 'inicio';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>discord - 2.0</title>
    <link rel="stylesheet" href="../assets/css/inicio.css">
</head>
<body>
    <aside>
        <?php
            include __DIR__ . '/../includes/sidebar.php';
        ?>
    </aside>
    <div>
        <?php
            if($aba === 'inicio'){
                include __DIR__ . '/inicio.php';
            }else if(is_int($aba)){
                include __DIR__ . '/servidor.php';
            }else if($aba === 'add'){
                include __DIR__ . '/novo.php';
            }
        ?>
    </div>
</body>
</html>