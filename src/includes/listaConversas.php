<?php
$user = $_SESSION['usuario_id'];

$sql = "select * from conversas where id_usuario_1 = :user or id_usuario_2 = :user";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ":user" => $user
]);

$conversas = $stmt -> fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>