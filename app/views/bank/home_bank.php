<?php $this->loadView("templates/", "header_page", array("title" => "Lista de Bancos")); ?>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="table-responsive justify-content-center">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">CNPJ</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($banks as $bank => $value): ?>
                    <tr>
                        <td data-name=""><?= $value->name ?></td>
                        <td data-qtty=""><?= $value->cnpj ?></td>
                        <td>
                            <a class="btn btn-outline-warning btn-block" href="<?= BASE_URL ?>/bank/updatepage/<?= $value->id; ?>" >
                                Atualizar
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-outline-danger btn-block" href="javascript:" id="remove-bank" value=""
                                onclick="removeBank(<?= $value->id; ?>);">
                                Remover
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <nav class="navbar">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>/bank/insertpage">Criar Banco</a>
                </li>
            </ul>
        </nav>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<?php $this->loadView("alerts/", "bank_alert"); ?>