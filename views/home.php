<?php $this->layout('master'); ?>

<h2>Redefina sua senha</h2>

<form action="/email/verify" method="post">
    <input type="text" name="email" value="xandecar@hotmail.com">
    <button type="submit">Verificar email</button>
</form>