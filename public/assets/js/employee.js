$(() => {
    clearPostJS()
    modal()

    if (document.querySelector('[name=save]')) {
        document.getElementById('save').onclick = save 
        document.getElementById('form_employee').onsubmit = submitForm
    }

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
                    document.getElementById('form_changePassword').onsubmit = submitPasswordForm
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

const submitPasswordForm = event => {

    let fatherElement = '[id=passwordSection]';
    
    event.preventDefault()

    const formPassword = event.target
    if (!formPassword.reportValidity()) {
        return false;
    }

    let form = new FormData(document.getElementById('form_changePassword'));

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
    
}


const messageText = (messageFixed, messageConfiguration, fatherElement, messageId) => {

    let messageComponent;

    if (document.querySelector('[id='+ messageId +']')) {
        messageComponent = document.querySelector('[id='+ messageId +']');
        messageComponent.innerHTML = `${messageFixed}`;
        messageComponent.className = messageConfiguration;
    

    } else {
        messageComponent = document.createElement("div");
        messageComponent.innerHTML = `${messageFixed}`;
        messageComponent.className = messageConfiguration;
        messageComponent.id = messageId;

        const elementFather = document.querySelector(fatherElement);
        elementFather.insertBefore(messageComponent, elementFather.firstElementChild);

    }

    const button = document.createElement('button')
    button.setAttribute('type', 'button')
    button.setAttribute('aria-label', 'Close')
    button.className = 'close'
    button.dataset.dismiss = 'alert'

    const span = document.createElement('span')
    span.setAttribute('aria-hidden', 'true')
    span.innerHTML = '&times;'

    button.appendChild(span)
    messageComponent.appendChild(button)

}

const clear = () => {
    document.form_employee.reset()
}

const save = event => {

    const btn = event.target
    const form = document.getElementById('form_employee')
    const submitEvent = new SubmitEvent('submit', {
        submitter: btn
    })

    form.dispatchEvent(submitEvent)
}

const submitForm = e => {
    
    e.preventDefault()
    
    const form = e.target
    if (!form.reportValidity()) {
        return false;
    }

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
