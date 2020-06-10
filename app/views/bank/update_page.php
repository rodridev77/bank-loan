<div class="col-12" id="container-content">
    <div id="page-title">
        <h2 id="top-title">Informações do banco</h2>
    </div>

    <form id="bank-form">
        <div class="form-row">
            <div class="form-group col-sm-6 col-12">
                <label for="bank-name">Nome</label>
                <input type="text" class="form-control" id="bank-name" name="name" value="<?= $bank->getName(); ?>"
                    required="required" placeholder="Insira nome do banco">
            </div>

            <div class="form-group col-sm-6 col-12">
                <label for="bank-cnpj">CNPJ</label>
                <input type="text" class="form-control" id="bank-cnpj" name="cnpj" value="<?= $bank->getCnpj(); ?>"
                    required="required" placeholder="Insira CNPJ">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-sm-6 col-12">
                <label for="bank-phone">Telefone</label>
                <input type="text" class="form-control" id="bank-phone" name="phone" value="<?= $bank->getPhone(); ?>"
                    required="required" placeholder="Insira telefone">
            </div>

            <div class="form-group col-sm-6 col-12">
                <label for="bank-email">E-mail</label>
                <input type="email" class="form-control" id="bank-email" name="email" value="<?= $bank->getEmail(); ?>"
                    required="required" placeholder="Insira e-mail">
            </div>
        </div>

        <div id="page-title">
            <h2>Informações de Endereço do Banco</h2>
        </div>

        <div class="form-row">
            <div class="form-group col-sm-6 col-12">
                <label for="bank-zipcode">CEP</label>
                <input type="text" class="form-control" id="bank-zipcode"
                    value="<?= $bank->getAddress()->getZipcode(); ?>" required="required" placeholder="Insira CEP">
            </div>

            <div class="form-group col-sm-6 col-12">
                <label for="bank-address">Endereço</label>
                <input type="text" class="form-control" id="bank-address"
                    value="<?= $bank->getAddress()->getStreet(); ?>" required="required" placeholder="Insira endereço">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-sm-6 col-12">
                <label for="bank-number">Número</label>
                <input type="text" class="form-control" id="bank-number"
                    value="<?= $bank->getAddress()->getNumber(); ?>" required="required" placeholder="Insira número">
            </div>

            <div class="form-group col-sm-6 col-12">
                <label for="signupfull-optional">Complemento</label>
                <input type="text" class="form-control" id="bank-optional"
                    value="<?= $bank->getAddress()->getOptional(); ?>" placeholder="Insira complemento">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-sm-12 col-12">
                <label for="bank-district">Bairro</label>
                <input type="text" class="form-control" id="bank-district"
                    value="<?= $bank->getAddress()->getDistrict(); ?>" required="required" placeholder="Insira bairro">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-sm-6 col-12">
                <label for="bank-city">Cidade</label>
                <input type="text" class="form-control" id="bank-city" value="<?= $bank->getAddress()->getCity(); ?>"
                    required="required" placeholder="Insira cidade">
            </div>

            <div class="form-group col-sm-6 col-12">
                <label for="bank-state">Estado</label>
                <input type="text" class="form-control" id="bank-state" value="<?= $bank->getAddress()->getState(); ?>"
                    required="required" placeholder="Insira Estado">
            </div>
        </div>
        <input type="hidden" id="bank-id" value="<?= $bank->getId(); ?>">

        <button type="submit" class="btn btn-success btn-lg submit-account" onclick="updateBank()">Salvar</button>
    </form>
</div>

<?php $this->loadView("alerts/", "bank_alert"); ?>