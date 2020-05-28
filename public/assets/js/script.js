const BASE_URL = "http://localhost/bank-loan/";

function signinForm() {
    $("#right-column").load(BASE_URL+"app/views/login/signin_form.php");
}
function forgotPassForm (){
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
        console.log(JSON.stringify($('#signup-form').serializeArray()));
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
                console.log(data)
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
    let phone = document.querySelector("#signupfull-phone").value;
    let email = document.querySelector("#signupfull-email").value;
    let cpf = document.querySelector("#signupfull-cpf").value;
    let ordenado = document.querySelector("#signupfull-ordenado").value;

    let zipcode = document.querySelector("#signupfull-zipcode").value;
    let address = document.querySelector("#signupfull-address").value;
    let number = document.querySelector("#signupfull-number").value;
    let optional = document.querySelector("#signupfull-optional").value;
    let district = document.querySelector("#signupfull-district").value;
    let city = document.querySelector("#signupfull-city").value;
    let state = document.querySelector("#signupfull-state").value;
    let address_id = document.querySelector("#signupfull-address_id").value;

    if ((name.length && surname.length && phone.length && email.length && cpf.length && ordenado.length
         && zipcode && address && district && state && city && address_id) !== 0) {
        let data = {
            name: name,
            surname: surname,
            phone: phone,
            email: email,
            cpf: cpf,
            ordenado: ordenado,
            zipcode: zipcode,
            address: address,
            number: number,
            optional: optional,
            district: district,
            city: city,
            state: state,
            address_id: address_id
        };

        let options = {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json'
            }
        };

        const URL = BASE_URL + 'client/signupFull';
        fetch(URL, options).then(response => response.json())
        .then(data => {
            let message = "full registration failed";
            let modalAlert = '#signup-alert';
            let classAlert = 'alert-warning'
            
            if (data.success === true) {
                message = "full registration successful";
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

function forgotPassEmail(){

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
        const URL = BASE_URL+"Passwd/forgotPassEmail";
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
                    messageAlert(message, modalAlert, classAlert);

                } else {
                    messageAlert(message, modalAlert, classAlert);
                }
            }).catch(error => console.log(error))
    }
}

function matchPasswd() {
    let passwd1 = document.querySelector("#change-pass1").value
    let passwd2 = document.querySelector("#change-pass2").value
    let submit = document.querySelector("#submit_change_pass_form")
    if (passwd1!=="" && passwd2!==""){
        if (passwd1===passwd2){
            submit.removeAttribute("disabled")
        }else{
            submit.disabled = true;
        }
    }


}

function changeForgottenPass() {

    document.querySelector('#change-pass-form').addEventListener('submit',event => {
        event.preventDefault()
    })

    let passwd1 = document.querySelector("#change-pass1").value

    let data = {
        passwd : passwd1
    }

    console.log(data)

    let options = {
        method : "POST",
        body : JSON.stringify(data),
        headers : {
            "Content-Type" : "application-json"
        }
    }

    fetch(BASE_URL+"/Passwd/passwordReset",options)
        .then(response => response.json())
        .then(data => {
            //console.log(data.success)
            if (data.success){
                window.location = BASE_URL;
            }else{
                let message = "Ocorreu um problema durante a requisição tente novamente";
                let modalAlert = '#auth-alert';
                let classAlert = 'alert-warning'

                messageAlert(message, modalAlert, classAlert);
            }


        })


}

function getCode() {
    // document.querySelector("#getCode").addEventListener("submit", event => {
    //     event.preventDefault()
    // })

    fetch(BASE_URL+"/Passwd/getCodeEmail",{
        method : "POST"
    }).then(response => response.json())
        .then(data => {
            let message = "Ocorreu um erro durante o processo tente novamente mais tarde";
            let modalAlert = '#signup-alert';
            let classAlert = 'alert-warning'

            if (data.success === true) {
                message = "Uma mensagem foi enviada ao seu email contendo o código gerado";
                classAlert = 'alert-success';

                messageAlert(message, modalAlert, classAlert);

                window.setTimeout(function() {
                    window.location.href = window.location.href;
                }, 5000);

            } else {
                messageAlert(message, modalAlert, classAlert);
            }
        })

}

function changeOldPass(){
    document.querySelector("#changeOldPassForm").addEventListener("submit", event =>{
        event.preventDefault()
    })

    let code =  document.querySelector("#change-code").value
    let newPass =  document.querySelector("#change-pass1").value
    let oldPass =  document.querySelector("#change-oldPass").value
    
    let data = {
        code : code,
        newPass : newPass,
        oldPass : oldPass
    }

    let options = {
        method : "POST",
        body : JSON.stringify(data),
        headers : {
            "Content-Type" : "application-json"
        }
    }

    fetch(BASE_URL+"/Passwd/changeOldPass",options)
    .then(response => response.json())
    .then(data => {
        let message = "Os dados informados estão incorretos, ou o código não foi gerado corretamente";
            let modalAlert = '#signup-alert';
            let classAlert = 'alert-warning'

            if (data.success === true) {
                message = "Sua Senha foi alterada!";
                classAlert = 'alert-success';

                messageAlert(message, modalAlert, classAlert);

                window.setTimeout(function() {
                    window.location.href = window.location.href;
                }, 5000);

            } else {
                messageAlert(message, modalAlert, classAlert);
            }
    }).catch(error => {
        console.log(error)
    })
}
