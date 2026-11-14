<form method="POST" action="">
    <h1>Bem-vindo de volta!</h1>
    <h3>Estamos felizes em te ver novamente.</h3>
    <?php if ($erro !== ''): ?>
        <p class="erro">
            <?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?>
        </p>
    <?php endif; ?>
    <label for="email">E-MAIL OU NÚMERO DE TELEFONE *</label>
    <input type="text" name="email" id="email" required>
    <label for="senha">SENHA *</label>
    <input type="password" name="senha" id="senha" required>
    <button type="submit">Entrar</button>
    <p>Não possui uma conta?<a href="cadastro.php">Registrar</a></p>
</form>