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
            let lista = ['id', 'phone', 'description'];
            let messageFixed = [];

            if (verify('[name=form_employee]', lista).length == 0) {
                save();
            } else {
                messageFixed = verify('[name=form_employee]', lista)[0]
                messageText(messageFixed,  'alert alert-danger', '[id=section]', 'message');
            }
        }
    }

    if (document.querySelector('[name=search]')) {
        document.querySelector('[name=search]').onclick = () => {
            search();
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
                    $('#myModal').on('hidden.bs.modal', function (e) { 
                        closeModal() 
                    })
                    
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

    let form = new FormData(document.getElementById('form_changePassword'));

    if (verify('[name=form_changePassword]', []).length == 0) {
        fetch(`/ajax/employee/save/${id.value}`,{
            method: 'POST',
            body: form
        }).then(response => {
            response.json()
                .then(data => {
                    let messageObject = data
                    messagePassword(messageObject, fatherElement);
                })
        })

    } else {

        let messageFixed = verify('[name=form_changePassword]', [])[0]
        messageText(messageFixed,  'alert alert-danger', fatherElement, 'passwordMessage');
    }

    
}

const verify = (formFixed, lista) => {
    let form = document.querySelector(formFixed);
    let messageFixed = "";
    let inputs = form.querySelectorAll("input");

    for (let i = 0; i < inputs.length; i++) {

        let resp = lista.includes(inputs[i].id)

        if(!resp){
            if(inputs[i].value == ""){
                let label = document.querySelector('[for=' + inputs[i].id + ']');
                messageFixed = "Campo " + label.innerHTML + " precisa ser preenchido";
                inputs[i].focus();
                return [messageFixed];
            }
        }
    }
    
    return [];
}

const messageText = (messageFixed, messageConfiguration, fatherElement, messageId) => {

    if (document.querySelector('[id='+ messageId +']')) {
        let messageComponent = document.querySelector('[id='+ messageId +']');
        messageComponent.innerHTML = `${messageFixed}`;
        messageComponent.className = messageConfiguration;
    

    } else {
        let messageComponent = document.createElement("div");
        messageComponent.innerHTML = `${messageFixed}`;
        messageComponent.className = messageConfiguration;
        messageComponent.id = messageId;
        let elementFather = document.querySelector(fatherElement);
        elementFather.insertBefore(messageComponent, elementFather.firstElementChild);

    }

    createButtonAlert(messageId)
    $('#' + messageId).show()
    closeAlert(messageId)

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

const messagePassword = (messageObject, fatherElement) => {
    let messageConfiguration = '';

    if (messageObject.type == 1) {
        messageConfiguration = "alert alert-danger";
        messageText(messageObject.message, messageConfiguration, fatherElement, 'passwordMessage')
    } else { 
        messageConfiguration = "alert alert-info";
        messageText(messageObject.message, messageConfiguration, '[id=section]', 'message')
        closeModal()
        $('#passwordModal').modal('hide')
      
    }
}

const closeModal = () => {

    if (document.querySelector('[id= passwordMessage]')) {
        let messageFixed = document.querySelector('[id= passwordMessage]')
        messageFixed.parentNode.removeChild(messageFixed);
    } 

    document.getElementById('form_changePassword').reset();
}

const createButtonAlert = (messageId) => {

    let buttonComponent = document.createElement("i");
    buttonComponent.className = "fa fa-times-circle fa-lg";
    buttonComponent.id = "closeAlert" + messageId;
    buttonComponent.type = "button";

    let elementFather = document.querySelector('[id=' + messageId + ']');
    elementFather.insertBefore(buttonComponent, elementFather.firstElementChild);

}

const closeAlert = (messageId) => {

    if (document.querySelector('[id=closeAlert' + messageId + ']')) {
        document.querySelector('[id=closeAlert' + messageId + ']').onclick = () => {
            $('#' + messageId).hide()
        }
    }

}

