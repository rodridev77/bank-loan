const BASE_URL = "http://localhost/bank-loan/";

function recoverPassForm (){
    $("#right-column").load(BASE_URL+"app/views/login/recover_password_form.php");
}

// ****** SIGIN MANAGER ********/
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
                let classAlert = 'alert-warning';

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
    });    
    let cpf = document.querySelector("#recover-cpf").value;
    let name = document.querySelector("#recover-name").value;
    let email = document.querySelector("#recover-email").value;

    if ((cpf.length && name.length && email.length) !== 0) {
        let data = {
            cpf:cpf,
            name:name,
            email:email
        };
        
        let options = {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json'
            }
        };

        const URL = BASE_URL+"auth/recoverPass";
        fetch(URL,options)
        .then(response => response.json())
            .then(data => {
                let message = "Dados incorretos";
                let modalAlert = '#signup-alert';
                let classAlert = 'alert-warning';

                if (data.success === true) {
                    message = "Uma mensagem contendo sua senha será enviado ao email fornecido";
                    classAlert = 'alert-success';

                    messageAlert(data.success, modalAlert, classAlert);
                } else { 
                    messageAlert(data.success, modalAlert, classAlert);
                }
            }).catch(error => console.log(error));
    }
}

// ****** CRUD BANK ********/
function insertBank() {
    
    document.querySelector('#bank-form').addEventListener('submit', event => {
        event.preventDefault();
    });
    let name = document.querySelector("#bank-name").value;
    let cnpj = document.querySelector("#bank-cnpj").value;
    let phone = document.querySelector("#bank-phone").value;
    let email = document.querySelector("#bank-email").value;

    let zipcode = document.querySelector("#bank-zipcode").value;
    let address = document.querySelector("#bank-address").value;
    let number = document.querySelector("#bank-number").value;
    let optional = document.querySelector("#bank-optional").value;
    let district = document.querySelector("#bank-district").value;
    let city = document.querySelector("#bank-city").value;
    let state = document.querySelector("#bank-state").value;

    if ((name.length && cnpj.length && phone.length && email.length && zipcode && address && district && state && city) !== 0) {
        let data = {
            name: name,
            cnpj: cnpj,
            phone: phone,
            email: email,
            zipcode: zipcode,
            address: address,
            number: number,
            optional: optional,
            district: district,
            city: city,
            state: state,
        };

        let options = {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json'
            }
        };

        const URL = BASE_URL + 'bank/insertbank';
        fetch(URL, options).then(response => response.json())
        .then(data => {
            let message = "Error: Do not was possible to register the bank";
            let modalAlert = '#bank-alert';
            let classAlert = 'alert-warning'
            
            if (data.success === true) {
                message = "Success: The bank has registered";
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

function removeBank(id) {

    if (id) {
        let data = {id: id};

        let options = {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json'
            }
        };

        const URL = BASE_URL + 'bank/remove';
        fetch(URL, options).then(response => response.json())
            .then(data => {
                
                let message = "Error: Do not was possible to remove the bank";
                let modalAlert = '#bank-alert';
                let classAlert = 'alert-warning';

                if (data.success === true) {
                    message = "Sucess: The bank has removed";
                    classAlert = 'alert-success';

                    messageAlert(message, modalAlert, classAlert);
                } else { 
                    messageAlert(message, modalAlert, classAlert);
                }
            })
            .catch(error => {
                console.log(error);
            });
    }

}

