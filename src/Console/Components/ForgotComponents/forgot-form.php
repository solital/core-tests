<h1>Forgot password</h1>
<form action="<?= url('forgot.post'); ?>" method="POST">
    <?= csrf_token() ?>
    <input type="email" name="email" placeholder="Your e-mail"><br>
    <button type="submit">Submit</button>
</form>