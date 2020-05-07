<form id="signupfull-form">
<div class="form-group">
        <label for="signupfull-name">Nome</label>
        <input type="text" class="form-control" id="signupfull-name" required="required" placeholder="Insira nome">
    </div>

    <div class="form-group">
        <label for="signupfull-surname">Sobrenome</label>
        <input type="text" class="form-control" id="signupfull-surname" name="surname" required="required" placeholder="Insira sobrenome">
    </div>

    <div class="form-group">
        <label for="signupfull-cpf">CPF</label>
        <input type="text" class="form-control" id="signupfull-cpf" name="cpf" required="required" placeholder="Insira CPF">
    </div>

    <div class="form-group">
        <label for="signupfull-email">E-mail</label>
        <input type="email" class="form-control" id="signupfull-email" name="email" required="required" placeholder="Insira e-mail">
    </div>

    <div class="form-group">
        <label for="signupfull-ordenado">Renda</label>
        <input type="text" class="form-control" id="signupfull-ordenado" name="ordenado" required="required" placeholder="Insira renda">
    </div>

    <button type="submit" class="btn submit-account" onclick="signupFullClient()">Cadastrar</button>
</form>
