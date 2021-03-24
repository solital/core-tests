<form action="<?= url('verifyLogin'); ?>" method="POST">
    <input type="text" name="email" placeholder="E-mail"><br>
    <input type="password" name="pass" placeholder="Password"><br>
    <button type="submit">Login</button>
    <a href="<?= url("forgot"); ?>">Forgot password</a>
</form>"