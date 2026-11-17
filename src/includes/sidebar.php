<?php
$user = $_SESSION['usuario_id'];

$sql = "select id_servidor from servidores_usuario where id_usuario = :user";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ":user" => $user
]);

$servidores_liberados = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sidebar</title>
    </head>
    <body>
        <ol>
            <li>
                <button type="button">
                    <img src="../assets/img/icones/discord.png" alt="Pagina Inicial">
                </button>
            </li>
                       
            <?php
            foreach($servidores_liberados as $servidores_liberados):
                $sql2 = "select * from servidores where id = :id";
                $stmt= $pdo->prepare($sql2);
                $stmt->execute([
                    ":id"=> $servidores_liberados['id_servidor']
                ]);
                $servidores = $stmt->fetch(PDO::FETCH_ASSOC); 
            ?>
            <li>
                <button type="button">
                    <img src="<?= htmlspecialchars($servidores['icone']) ?>" alt="Pagina Inicial">
                </button>
            </li>
            <?php endforeach; ?>
            <li>
                <button type="button">
                    <img src="../assets/img/icones/plus.png" alt="">
                </button>
            </li>
        </ol>
    </body>
</html>