<h1>Change password</h1>

<form action="<?= url('change.post', ['hash' => $hash]); ?>" method="POST">
    <?= csrf_token() ?>
    <input type="hidden" name="inputEmail" value="<?= $email; ?>">
    <input type="hidden" name="hash" value="<?= $hash; ?>">
    <input type="password" name="inputPass" placeholder="New password"><br><br>
    <input type="password" name="inputConfPass" placeholder="repeat new password"><br><br>
    <button type="submit">Change</button>
</form>