$(() => {
    clearPostJS()
    
    if (document.querySelector('[name=new]')) {
        document.querySelector('[name=new]').onclick = () => {
            location.href = '/estudio/novo'
        }
    }

    if (document.querySelector('[name=clear]')) {
        document.querySelector('[name=clear]').onclick = () => {
            clear()
        }
    }

    if (document.querySelector('[name=save]')) {
        document.querySelector('[name=save]').onclick = () => {
            verify()
        }
    }

    if (document.querySelector('[name=search]')) {
        document.querySelector('[name=search]').onclick = () => {
            search()
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

const verify = () => {
    let form = document.querySelector('[name=form_studio]');
    let messageText = "";
    let messageConfiguration = "";
    let inputs = form.querySelectorAll("input");

    for (let i = 1; i < inputs.length; i++) {
        if (!inputs[i].value) {
            let label = document.querySelector('[for=' + inputs[i].id + ']');
            messageText = "Campo " + label.innerHTML + " precisa ser preenchido";
            messageConfiguration = "alert alert-danger";
            inputs[i].focus();
            return message(messageText, messageConfiguration);
        }
    }
    
    save();
    return message(messageText, messageConfiguration);
}

const message = (messageText, messageConfiguration) => {
    if (document.querySelector('[id=message]')) {
        let messageComponent = document.querySelector('[id=message]');
        messageComponent.innerHTML = `${messageText}`;
        messageComponent.className = messageConfiguration;

    } else {
        let messageComponent = document.createElement("div");
        messageComponent.className = messageConfiguration;
        messageComponent.id = "message";
        messageComponent.innerHTML = `${messageText}`;
        elementFather = document.querySelector('[id=section]');
        elementFather.insertBefore(messageComponent, elementFather.firstElementChild);
    }
}

const clear = () => {
    document.form_studio.reset()
}

const save = () => {
    document.form_studio.submit()
}

const search = () => {
    document.form_studio.submit()
}

const remove = id => {
    const element = document.getElementById('question')
    element.classList.remove('d-none')
    element.lastElementChild.setAttribute('href', `/estudio/${id}/excluir`)
}