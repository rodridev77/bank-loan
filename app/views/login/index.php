<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Loan Bank</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="<?= BASE_URL; ?>/public/assets/css/style.css" type="text/css" >
    </head>
    <body>
    
        <div class="container-fluid">
            <div class="row justify-content-center mt-5" id="signin-box">
                <div class="col-md-3" id="right-column">
                    
                    <div class="d-flex flex-column" id="signin-text">
                        <h2>Bem Vindo!</h2>

                        <p>
                            Mantenha-se conectado conosco<br>
                            Por favor, informe seus dados para entrar
                        </p>

                        <button class="btn signin-btn" onclick="signinForm()">Entrar</button>
                    </div>

                </div>

                <div class="col-md-5" id="left-column">
                    <div id="create-account">
                        <h1>Criar Conta</h1>
                    </div>
                    
                    <form id="signup-form">
                        <div class="form-group">
                            <label for="signup-cpf">CPF</label>
                            <input type="text" class="form-control" id="signup-cpf" name="cpf" required="required" placeholder="Insira CPF">
                        </div>

                        <div class="form-group">
                            <label for="signup-email">E-mail</label>
                            <input type="email" class="form-control" id="signup-email" name="email" required="required" placeholder="Insira e-mail">
                        </div>

                        <div class="form-group">
                            <label for="signup-pass">Senha</label>
                            <input type="text" class="form-control" id="signup-pass" name="pass" required="required" placeholder="Insira uma senha">
                        </div>
                        
                        <button type="submit" class="btn submit-account" onclick="signupClient()">Cadastrar</button>
                    </form>

                </div>
            </div>
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
        <script type="text/javascript" src="<?= BASE_URL; ?>/public/assets/js/script_1.js"></script>
    <script>

    </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <?php $this->loadView("alerts/", "auth_alert"); ?>
        <?php $this->loadView("alerts/", "signup_alert"); ?>
    </body>
</html>