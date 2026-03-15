
<form action="" method="POST" class="formulario">
        <input type="hidden" name="id" value="<?php echo $id ?? ''; ?>"><!--estudar-->

    <label>Nome</label>
        <input type="text" name="nome" value="<?php echo $nome; ?>" required>

    <label>Email</label>
         <input type="email" name="email" value="<?php echo $email; ?>" required>

    <label>Naturalidade</label>
        <input type="text" name="naturalidade" value="<?php echo $naturalidade; ?>" required>

    <label>RG</label>
        <input type="text" name="rg" value="<?php echo $rg;?>" required>

    <label>Profissão</label>
        <input type="text" name="profissao" value="<?php echo $profissao; ?>" required>

<button type="submit" class="botao-cadastrar">
Cadastrar
</button>

</form>
