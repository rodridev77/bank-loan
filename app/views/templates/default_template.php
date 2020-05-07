<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Loan Bank 1.0</title>
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= BASE_URL; ?>/public/assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/css/template.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row top-menu">
            <div class="col-md-6">
                <div class="bank-logo">
                    <h1>Bank Loan 1.0</h1>
                </div>
            </div>

            <div class="col-sm-6 mr-0">
                <div class="row">
                    <div class="col-sm-8 d-flex justify-content-end notifications">
                        <img src="<?= BASE_URL ?>/public/assets/img/media/notification_bell.png">
                    </div>

                    <div class="col-sm-4 pl-auto pr-0 user-config">
                        <div class="dropdown show">
                            <a class="btn btn-secondary dropdown-toggle" id="btn-logged" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?= $viewData['client']->getName() ?? 'Cliente'; ?>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="<?php echo BASE_URL; ?>/client/perfil">Meu Cadastro</a>
                                <a class="dropdown-item" href="#">Alterar Senha</a>
                                <a class="dropdown-item" href="<?php echo BASE_URL; ?>/auth/signout">Sair</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row navbar navbar-expand-lg justify-content-center bottom-menu">
            <div class="col-12-sm navbar-nav">
                <a class="nav-item nav-link" href="<?php echo BASE_URL; ?>">Contrato</a>
                <a class="nav-item nav-link" href="<?php echo BASE_URL; ?>">Emprestimo</a>
            </div>
        </div>
    </div>

    <div class="container-fluid d-flex justify-content-center"> <!-- IMPORTANTE max-width 800px !-->
        <?php $this->loadViewInTemplate($viewPath, $viewName, $viewData); ?>
    </div>

    <footer>
        <div class="container-fluid">

            <div class="copyright">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="d-flex flex-column" id="copyright-text">
                            <p>
                                © <span>Bank Loan</span> Todos os direitos reservados.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script type="text/javascript" src="<?= BASE_URL; ?>/public/assets/js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script type="text/javascript" src="<?= BASE_URL; ?>/public/assets/js/script.js"></script>

    <?php $this->loadView("alerts/", "auth_alert"); ?>
    <?php $this->loadView("alerts/", "signup_alert"); ?>
</body>

</html>