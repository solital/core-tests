<h1>Change password</h1>

<form action="<?= url('changePost', ['hash' => $hash]); ?>" method="POST">
    <input type="hidden" name="email" value="<?= $email; ?>">
    <input type="hidden" name="hash" value="<?= $hash; ?>">
    <input type="password" name="pass" placeholder="New password"><br><br>
    <input type="password" name="confPass" placeholder="repeat new password"><br><br>
    <button type="submit">Change</button>
</form>"