<div class="d-flex flex-column" id="signin-form">
    <h2>Entrar</h2>
    <form>
        <div class="form-group">
            <label for="signin-cpf">CPF</label>
            <input type="text" class="form-control" id="signin-cpf" required="required" placeholder="Insira CPF">
        </div>

        <div class="form-group">
            <label for="signin-pass">Senha</label>
            <input type="password" class="form-control" id="signin-pass" required="required" placeholder="Insira Senha">
        </div>

        <button type="submit" class="btn submit-account" onclick="signin()">Entrar</button>
    </form>
        <button class="btn submit-account" onclick="recoverPassForm()">Recuperar Senha</button>
</div>