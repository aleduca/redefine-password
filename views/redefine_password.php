<?php $this->layout('master'); ?>

<h2>Redefina sua senha</h2>

<form action="/password/update/<?php echo $token ?>" method="post">
<input type="password" name="password" placeholder="Redefina sua senha">
<button type="submit">Redefinir</button>
</form>