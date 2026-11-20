<?php
$user = $_SESSION['usuario_id'];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $arquivo = $_FILES['imagemServidor'] ?? '../assets/img/icones/discordExemple.png';
    $pasta = '../assets/imagem/';

    if($arquivo['error'] !== UPLOAD_ERR_OK){
        die('Erro ao enviar o arquivo. ');
    }

    $tamanhoMaximo = 5 * 1024 * 1024;
    if ($arquivo['size'] > $tamanhoMaximo) {
        die('O arquivo excede o limite de 5 MB.');
    }

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $tipoMime = $finfo->file($arquivo['tmp_name']);
    $tiposPermitidos = [
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
        'image/webp' => 'webp'
    ]

    if (!array_key_exists($tipoMime, $tiposPermitidos)) {
        die('Formato inválido. Envie apenas JPG, PNG ou WEBP.');
    }

    $extensao = $tiposPermitidos[$tipoMime];
    $nomeUnico = uniqid('img_', true) . '.' . $extensao;
    $caminhoCompleto = $diretorioDestino . $nomeUnico;

    if (move_uploaded_file($arquivo['tmp_name'], $caminhoCompleto)){
        echo "Imagem enviada com sucesso! Salva em: ". htmlspecialchars($caminhoCompleto);
    }else{
        echo "Falha ao salvar a imagem no servidor.";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <label for="nomeServidor">Nome do servidor: </label>
        <input type="text" name="nomeServidor" id="nomeServidor">
        <label for="descrição">Descrição</label>
        <input type="text" name="descricaoServidor" id="descricaoServidor">
        <label for="cor">Cor</label>
        <select name="corServidor" id="corServidor">
            <option value="red">Vermelho</option>
            <option value="blue">Azul</option>
            <option value="green">Verde</option>
            <option value="purple">Roxo</option>
            <option value="black">Preto</option>
        </select>
        <input type="file" name="imagemServidor" id="imagemServidor" accept="image/png, image/jpeg, image/webp"">
        <button type="submit">Criar Servidor</button>
    </form>
</body>
</html>