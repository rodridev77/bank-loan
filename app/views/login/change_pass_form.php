<?php
if (!($_SESSION['change_Pass']['token'] == $token)) {
	header("Location:".BASE_URL);
}
 ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Loan Bank</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= BASE_URL; ?>/public/assets/css/style.css" type="text/css" >
    <link rel="stylesheet" href="<?= BASE_URL; ?>/public/assets/css/template.css" type="text/css" >
</head>
<body>

<div class="container-fluid">
    <div class="row justify-content-center mt-5" id="signin-box">
        <div class="col-md-3 justify-content-center" id="center-column">

            <form id="change-pass-form">
                <div class="form-group">
                    <label for="change-pass1">Nova Senha</label>
                    <input type="password" class="form-control" id="change-pass1" required="required" placeholder="Nova senha" onkeyup="matchPasswd()">
                </div>

                <div class="form-group">
                    <label for="change-pass2">Repita Novamente</label>
                    <input type="password" class="form-control" id="change-pass2" required="required" placeholder="Repita novamente" onkeyup="matchPasswd()">
                </div>

                <button type="submit" disabled id="submit_change_pass_form" class="btn submit-account" onclick="changePass()">Mudar Senha</button>
            </form>

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