<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bank Loan 1.0 | Log in</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/app/views/templates/adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/app/views/templates/adminlte/dist/css/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/css/admin.css" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?php echo BASE_URL ?>"><b>Bank Loan</b> 1.0</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Painel Administrativo</p>

                <form method="post" id="signin-form">
                    <div class="input-group mb-3">
                        <input type="text" name="login-email" id="signin-cpf" class="form-control" placeholder="cpf"
                            required="">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="signin-pass" class="form-control"
                            placeholder="Password" required="">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <p class="mb-1">
                                <a href="#" class="recovery-pass-text">Esqueci a senha</a>
                            </p>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block admin-auth-btn" onclick="signin();">Entrar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <script type="text/javascript" src="<?= BASE_URL; ?>/public/assets/js/jquery.min.js"></script>
    <script src="<?php echo BASE_URL ?>app/views/template/adminlte/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo BASE_URL ?>app/views/template/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo BASE_URL ?>app/views/template/adminlte/dist/js/adminlte.min.js"></script>

    <?php $this->loadView("alerts/", "auth_alert"); ?>
    <script src="<?php echo BASE_URL ?>/public/assets/js/admin.js"></script>
    
</body>

</html>