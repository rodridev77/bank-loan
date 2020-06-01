<div class="d-flex flex-column">
    <div class="col-12" id="container-content">
        <div id="page-title">
            <h2 id="top-title">Alteração de Senha</h2>
        </div>
        <button id="getCode" onclick="getCode()" class="btn submit-account">Gerar Código</button><br>
        Uma mensagem contendo codigo gerado será enviado ao email vinculado a conta.
    <form id="changeOldPassForm">
        <div class="form-group">
            <label for="change-pass1">Insira o codigo</label>
            <input type="text" class="form-control" id="change-code" required="required" placeholder="Código">
        </div>
        <div class="form-group">
            <label for="change-pass1">Senha antiga</label>
            <input type="password" class="form-control" id="change-oldPass" required="required" placeholder="Senha antiga" onkeyup="matchPasswd()">
        </div>
        <div class="form-group">
            <label for="change-pass1">Nova Senha</label>
            <input type="password" class="form-control" id="change-pass1" required="required" placeholder="Nova senha" onkeyup="matchPasswd()">
        </div>
        <div class="form-group">
            <label for="change-pass2">Repita Novamente</label>
            <input type="password" class="form-control" id="change-pass2" required="required" placeholder="Repita novamente" onkeyup="matchPasswd()">
        </div>

        <button type="submit" disabled id="submit_change_pass_form" class="btn submit-account" onclick="changeOldPass()">Mudar Senha</button>
    </form>
    </div>
</div>
