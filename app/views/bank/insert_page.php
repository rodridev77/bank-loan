<div class="col-12" id="container-content">
    <div id="page-title">
        <h2 id="top-title">Informações do Banco</h2>
    </div>

    <form id="bank-form">
        <div class="form-row">
            <div class="form-group col-sm-6 col-12">
                <label for="bank-name">Nome</label>
                <input type="text" class="form-control" id="bank-name" name="name" value="" required="required"
                    placeholder="Insira nome">
            </div>

            <div class="form-group col-sm-6 col-12">
                <label for="bank-cnpj">CNPJ</label>
                <input type="text" class="form-control" id="bank-cnpj" name="cpf" value="" required="required">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-sm-6 col-12">
                <label for="bank-phone">Telefone</label>
                <input type="text" class="form-control" id="bank-phone" name="phone" value="" required="required"
                    placeholder="Insira telefone">
            </div>

            <div class="form-group col-sm-6 col-12">
                <label for="bank-email">E-mail</label>
                <input type="email" class="form-control" id="bank-email" name="email" value="" required="required"
                    placeholder="Insira e-mail">
            </div>
        </div>

        <div id="page-title">
            <h2>Informações do Endereço do Banco</h2>
        </div>

        <div class="form-row">
            <div class="form-group col-sm-6 col-12">
                <label for="bank-zipcode">CEP</label>
                <input type="text" class="form-control" id="bank-zipcode" value="" required="required"
                    placeholder="Insira CEP">
            </div>

            <div class="form-group col-sm-6 col-12">
                <label for="bank-address">Endereço</label>
                <input type="text" class="form-control" id="bank-address" value="" required="required"
                    placeholder="Insira endereço">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-sm-6 col-12">
                <label for="bank-number">Número</label>
                <input type="text" class="form-control" id="bank-number" value="" required="required"
                    placeholder="Insira número">
            </div>

            <div class="form-group col-sm-6 col-12">
                <label for="bank-optional">Complemento</label>
                <input type="text" class="form-control" id="bank-optional" value="" placeholder="Insira complemento">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-sm-12 col-12">
                <label for="bank-district">Bairro</label>
                <input type="text" class="form-control" id="bank-district"  value="" required="required"
                    placeholder="Insira bairro">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-sm-6 col-12">
                <label for="bank-city">Cidade</label>
                <input type="text" class="form-control" id="bank-city" value="" required="required"
                    placeholder="Insira cidade">
            </div>

            <div class="form-group col-sm-6 col-12">
                <label for="bank-state">Estado</label>
                <input type="text" class="form-control" id="bank-state" value="" required="required"
                    placeholder="Insira Estado">
            </div>
        </div>

        <button type="submit" class="btn btn-lg submit-account" onclick="insertBank()">Salvar</button>
    </form>
<div>

<?php $this->loadView("alerts/", "bank_alert"); ?>