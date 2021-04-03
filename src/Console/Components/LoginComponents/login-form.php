<h1>Login</h1>

<form action="<?= url('auth.post'); ?>" method="POST">
    <?= csrf_token() ?>
    
    <?php if ($msg) : ?>
        <?= $msg ?>
        <br>
    <?php endif; ?>

    <input type="text" name="inputEmail" placeholder="E-mail"><br>
    <input type="password" name="inputPassword" placeholder="Password"><br>
    <button type="submit">Login</button>
    <a href="<?= url("forgot"); ?>">Forgot password</a>
</form>