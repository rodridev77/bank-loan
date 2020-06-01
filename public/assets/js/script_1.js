const BASE_URL = "http://localhost/bank-loan/";

function signinForm() {
    $("#right-column").load(BASE_URL+"app/views/login/signin_form.php");
}
function recoverPassForm (){
    $("#right-column").load(BASE_URL+"app/views/login/forgot_password_form_email.php");
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

        const URL = BASE_URL + 'auth/signin';
        fetch(URL, options).then(response => response.json())
        .then(data => {
            if (data.success === true) {
                window.location = BASE_URL + 'home';
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

function signupClient() {

    document.querySelector('#signup-form').addEventListener('submit', event => {
        event.preventDefault();
    });

    let cpf = document.querySelector("#signup-cpf").value;
    let email = document.querySelector("#signup-email").value;
    let pass = document.querySelector("#signup-pass").value;

    if ((cpf.length && email.length && pass.length) !== 0) {
        let data = {
            cpf: cpf,
            email: email,
            pass: pass

        };
        

        const options = {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(data)
        };
            
       const URL = BASE_URL + 'auth/signup';
            
        fetch(URL, options)
        .then(response => response.json())
        .then(data => {
            let message = "registration failed";
            let modalAlert = '#signup-alert';
            let classAlert = 'alert-warning';
            
            if (data.success === true) {

                message = "registration successful, sign in with cpf and password";
                classAlert = 'alert-success';

                messageAlert(message, modalAlert, classAlert);
            } else {
                messageAlert(message, modalAlert, classAlert);
           }
        })
        .catch(error => {
            console.log(error);
        })
        
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

function fullSignupForm() {
    $("#container-content").load(BASE_URL+"app/views/home/signup_form.php");
}

function signupFullClient() {
    
    document.querySelector('#signupfull-form').addEventListener('submit', event => {
        event.preventDefault();
    });
    let name = document.querySelector("#signupfull-name").value;
    let surname = document.querySelector("#signupfull-surname").value;
    let cpf = document.querySelector("#signupfull-cpf").value;
    let email = document.querySelector("#signupfull-email").value;
    let ordenado = document.querySelector("#signupfull-ordenado").value;

    if ((name.length && surname.length && cpf.length && email.length && ordenado.length) !== 0) {
        let data = {
            name: name,
            surname: surname,
            cpf: cpf,
            email: email,
            ordenado: ordenado
        };

        let options = {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json'
            }
        };

        const URL = BASE_URL + 'auth/signupFull';
        fetch(URL, options).then(response => response.json())
        .then(data => {
            let message = "full registration failed";
            let modalAlert = '#signup-alert';
            let classAlert = 'alert-warning'
            
            if (data.success === true) {
                message = "full registration successful, sign in with cpf and password";
                classAlert = 'alert-success';

                messageAlert(message, modalAlert, classAlert);
    
                window.setTimeout(function() {
                    window.location.href = window.location.href;
                }, 5000);
               
            } else {
                messageAlert(message, modalAlert, classAlert);
           }
        })
        .catch(error => {
            console.log(error);
        });
    }
}



