<div class="col-12" id="container-content">
    <div id="page-title">
        <h2 id="top-title">Informações Pessoais</h2>
    </div>

    <form id="signupfull-form">
        <div class="form-row">
            <div class="form-group col-sm-6 col-12">
                <label for="signupfull-name">Nome</label>
                <input type="text" class="form-control" id="signupfull-name" name="name" value="<?= $client->getName() ?? ""; ?>" required="required"
                    placeholder="Insira nome">
            </div>

            <div class="form-group col-sm-6 col-12">
                <label for="signupfull-surname">Sobrenome</label>
                <input type="text" class="form-control" value="<?= $client->getSurname() ?? ""; ?>" id="signupfull-surname" name="surname" required="required"
                    placeholder="Insira sobrenome">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-sm-6 col-12">
                <label for="signupfull-phone">Telefone celular</label>
                <input type="text" class="form-control" id="signupfull-phone" name="phone" value="<?= $client->getPhone() ?? ""; ?>" required="required"
                    placeholder="Insira CPF">
            </div>

            <div class="form-group col-sm-6 col-12">
                <label for="signupfull-email">E-mail</label>
                <input type="email" class="form-control" id="signupfull-email" name="email" value="<?= $client->getEmail() ?? ""; ?>" required="required"
                    placeholder="Insira e-mail">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-sm-6 col-12">
                <label for="signupfull-cpf">CPF</label>
                <input type="text" class="form-control" id="signupfull-cpf" name="cpf" value="<?= $client->getCpf() ?? ""; ?>" required="required" readonly>
            </div>

            <div class="form-group col-sm-6 col-12">
                <label for="signupfull-ordenado">Renda</label>
                <input type="text" class="form-control" id="signupfull-ordenado" name="ordenado" value="<?= $client->getOrdenado() ?? ""; ?>" required="required"
                    placeholder="Insira renda">
            </div>
        </div>

        <div id="page-title">
            <h2>Informações Residenciais</h2>
        </div>

        <div class="form-row">
            <div class="form-group col-sm-6 col-12">
                <label for="signupfull-zipcode">CEP</label>
                <input type="text" class="form-control" id="signupfull-zipcode" value="<?= $client->getAddress()->getZipcode() ?? ""; ?>" required="required"
                    placeholder="Insira CEP">
            </div>

            <div class="form-group col-sm-6 col-12">
                <label for="signupfull-address">Endereço</label>
                <input type="text" class="form-control" id="signupfull-address" value="<?= $client->getAddress()->getStreet() ?? ""; ?>" required="required"
                    placeholder="Insira endereço">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-sm-6 col-12">
                <label for="signupfull-number">Número</label>
                <input type="text" class="form-control" id="signupfull-number" value="<?= $client->getAddress()->getNumber() ?? ""; ?>" required="required"
                    placeholder="Insira número">
            </div>

            <div class="form-group col-sm-6 col-12">
                <label for="signupfull-optional">Complemento</label>
                <input type="email" class="form-control" id="signupfull-optional" value="<?= $client->getAddress()->getOptional() ?? ""; ?>" placeholder="Insira complemento">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-sm-12 col-12">
                <label for="signupfull-district">Bairro</label>
                <input type="text" class="form-control" id="signupfull-district"  value="<?= $client->getAddress()->getDistrict() ?? ""; ?>" required="required"
                    placeholder="Insira bairro">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-sm-6 col-12">
                <label for="signupfull-city">Cidade</label>
                <input type="text" class="form-control" id="signupfull-city" value="<?= $client->getAddress()->getCity() ?? ""; ?>" required="required"
                    placeholder="Insira cidade">
            </div>

            <div class="form-group col-sm-6 col-12">
                <label for="signupfull-state">Estado</label>
                <input type="text" class="form-control" id="signupfull-state" value="<?= $client->getAddress()->getState() ?? ""; ?>" required="required"
                    placeholder="Insira Estado">
            </div>
        </div>

        <button type="submit" class="btn btn-lg submit-account" onclick="signupFullClient()">Salvar</button>
    </form>
    <div>