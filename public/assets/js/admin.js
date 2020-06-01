const BASE_URL = "http://localhost/bank-loan/";

function recoverPassForm (){
    $("#right-column").load(BASE_URL+"app/views/login/recover_password_form.php");
}

function signin() {
    document.querySelector('#signin-form').addEventListener('submit', event => {
        event.preventDefault();
    });

    let cpf = document.querySelector("#signin-cpf").value;
    let pass = document.querySelector("#signin-pass").value;

    if ((cpf.length && pass.length) !== 0) {
        let data = {
            cpf: cpf,
            pass: pass
        };

        let options = {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json'
            }
        };

        const URL = BASE_URL + 'adminAuth/signin';
        fetch(URL, options).then(response => response.json())
        .then(data => {
            if (data.success === true) {
                window.location = BASE_URL + 'adminHome';
            } else {

                let message = "authentication failed";
                let modalAlert = '#auth-alert';
                let classAlert = 'alert-warning'

                messageAlert(message, modalAlert, classAlert);
            }
        })
        .catch(error => {
            console.log(error);
        });
    }
}

function messageAlert(message, modalAlert, classAlert) {
    let modal = document.querySelector(modalAlert);

    modal.querySelector('#alert-class').classList.add(classAlert);
    modal.querySelector('#alert-class').textContent = message;

    $(modalAlert).fadeIn(700, function(){
        window.setTimeout(function(){
            $(modalAlert).fadeOut();
        }, 2000);
    });
}

function recover(){

    document.querySelector('#recover-form').addEventListener('submit',event => {
        event.preventDefault()
    })    
    let cpf = document.querySelector("#recover-cpf").value
    let name = document.querySelector("#recover-name").value
    let email = document.querySelector("#recover-email").value

    if ((cpf.length && name.length && email.length) !== 0){
        let data = {
            cpf:cpf,
            name:name,
            email:email
        }
        //console.log(data)
        let options = {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json'
            }

        }
        const URL = BASE_URL+"auth/recoverPass";
        fetch(URL,options)
        .then(response => response.json())
            .then(data => {
                console.log(data)
                let message = "Dados incorretos";
                let modalAlert = '#signup-alert';
                let classAlert = 'alert-warning'
                if (data.success === true) {
                    message = "Uma mensagem contendo sua senha será enviado ao email fornecido";
                    classAlert = 'alert-success';

                    messageAlert(data.success, modalAlert, classAlert);


                } else {
                    
                    messageAlert(data.success, modalAlert, classAlert);
                }
            }).catch(error => console.log(error))
    }
}

