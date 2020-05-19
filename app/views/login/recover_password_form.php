
<div class="d-flex flex-column" id="recover-form">
    <h2>Recuperar Senha</h2>
    <form id='recoverpass'>
        <div class="form-group">
            <label for="recover-cpf">CPF</label>
            <input type="text" class="form-control" id="recover-cpf" required="required" placeholder="Insira CPF">
        </div>
        <div class="form-group">
            <label for="recover-pass">NOME</label>
            <input type="text" class="form-control" id="recover-name" required="required" placeholder="Insira Nome">
        </div>
        <div class="form-group">
            <label for="recover-pass">E-MAIL</label>
            <input type="emial" class="form-control" id="recover-email" required="required" placeholder="Insira email">
        </div>

        <button class="btn submit-account" onclick="recover()">Recuperar</button>
        <br>
    </form>
</div>