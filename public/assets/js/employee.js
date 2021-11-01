$(() => {
    clearPostJS()
    modal()

    if (document.querySelector('[name=new]')) {
        document.querySelector('[name=new]').onclick = () => {
            location.href = '/funcionario/novo'
        }
    }

    if (document.querySelector('[name=clear]')) {
        document.querySelector('[name=clear]').onclick = () => {
            clear();
        }
    }

    if (document.querySelector('[name=save]')) {
        document.querySelector('[name=save]').onclick = () => {
            lista = ['id', 'phone'];
            //temporario
            if (verify('[name=form_employee]', lista, '[id=section]', 'save')) {
                save();
            }
        }
    }

    if (document.querySelector('[name=search]')) {
        document.querySelector('[name=search]').onclick = () => {
            search();
        }
    }

    if (document.querySelector('[name=fechar]')) {
        document.querySelector('[name=fechar]').onclick = () => {
            $('#passwordModal').modal('hide');
        }
    }

    if (document.querySelectorAll('[data-id]')) {
        const btnList = document.querySelectorAll('[data-id]')
        btnList.forEach(el => {
            el.onclick = () => {
                remove(el.dataset.id)
            }
        })
    }

})

const modal = () => {
    fetch('/assets/resources/modal-password.html')
        .then(response => {
            response.text()
                .then(data => {
                    const div = document.createElement('div')
                    div.innerHTML = data
                    document.getElementById('myModal').appendChild(div)
                    document.getElementById('form_changePassword').onsubmit = submitForm
                    document.getElementById('changePassword').onclick = savePassword
                })
        })

}

const savePassword = event => {
    const btn = event.target
    const form = document.getElementById('form_changePassword')
    const submitEvent = new SubmitEvent('submit', {
        submitter: btn
    })

    form.dispatchEvent(submitEvent)
}

const submitForm = event => {

    let fatherElement = '[id=passwordSection]';
    
    event.preventDefault()

    form = new FormData(document.getElementById('form_changePassword'));

    if (verify('[name=form_changePassword]', [] , '[id=passwordSection]')) {
        fetch(`/ajax/employee/save/${id.value}`,{
            method: 'POST',
            body: form
        }).then(response => {
            response.json()
                .then(data => {
                    messageFixed = data.error;

                    messagePassword(messageFixed, fatherElement);
                })
        })
    }

    
}

const verify = (formFixed, lista = [], elementFather, idMessage) => {
    console.log(formFixed)
    let form = document.querySelector(formFixed);
    let messageFixed = "";
    let messageConfiguration = "";
    let fatherElement = elementFather;
    let inputs = form.querySelectorAll("input");

    for (let i = 0; i < inputs.length; i++) {

        let resp = lista.includes(inputs[i].id)

        if(!resp){
            if(inputs[i].value == ""){
                console.log(inputs[i])
                let label = document.querySelector('[for=' + inputs[i].id + ']');
                messageFixed = "Campo " + label.innerHTML + " precisa ser preenchido";
                messageConfiguration = "alert alert-danger";
                inputs[i].focus();
                //temporario
                if(idMessage == 'save' ){
                    messageText(messageFixed, messageConfiguration, fatherElement, 'message');
                    return false;
                }
                console.log("AA")
                messageText(messageFixed, messageConfiguration, fatherElement, 'passwordMessage');
                return false;
            }
        }
    }
    
    return true;
}

const messageText = (messageFixed, messageConfiguration, fatherElement, messageId) => {
    if (document.querySelector('[id='+ messageId +']')) {
        let messageComponent = document.querySelector('[id='+ messageId +']');
        messageComponent.innerHTML = `${messageFixed}`;
        messageComponent.className = messageConfiguration;

    } else {
        let messageComponent = document.createElement("div");
        messageComponent.className = messageConfiguration;
        messageComponent.id = messageId;
        messageComponent.innerHTML = `${messageFixed}`;
        elementFather = document.querySelector(fatherElement);
        elementFather.insertBefore(messageComponent, elementFather.firstElementChild);
    }
}

const clear = () => {
    document.form_employee.reset()
}

const save = () => {
    document.form_employee.submit()
}

const search = () => {
    document.form_employee.submit()
}

const remove = id => {
    const element = document.getElementById('question')
    element.classList.remove('d-none')
    element.lastElementChild.setAttribute('href', `/funcionario/${id}/excluir`)
}

const passwordVerify = (message, fatherElement) => {
    let form = document.querySelector('[name=form_changePassword]');
    let messageFixed = "";
    let messageConfiguration = "";
    let inputs = form.querySelectorAll("input");

    for (let i = 0; i < inputs.length; i++) {
        if (!inputs[i].value) {
            let label = document.querySelector('[for=' + inputs[i].id + ']');
            messageFixed = "Campo " + label.innerHTML + " precisa ser preenchido";
            messageConfiguration = "alert alert-danger";
            inputs[i].focus();
            return messageText(messageFixed, messageConfiguration, fatherElement);
        }
    }
    
    return messagePassword(message, fatherElement);
}

const messagePassword = (messageFixed, fatherElement) => {

    let messageConfiguration = '';
    let messageId = 'passwordMessage'

    if (messageFixed != 'Dados salvos com sucesso') {
        messageConfiguration = "alert alert-danger";
        messageText(messageFixed, messageConfiguration, fatherElement, messageId)
    }else{
        messageConfiguration = "alert alert-info";
        messageText(messageFixed, messageConfiguration, '[id=section]', 'message')
        $('#passwordModal').modal('hide')
    }

}

