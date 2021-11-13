$(() => {
    clearPostJS()
    
    if (document.querySelector('[name=new]')) {
        document.querySelector('[name=new]').onclick = () => {
            location.href = '/programa/novo'
        }
    }

    if (document.querySelector('[name=clear]')) {
        document.querySelector('[name=clear]').onclick = () => {
            clear()
        }
    }

    if (document.querySelector('[name=save]')) {
        document.querySelector('[name=save]').onclick = () => {
            verify(document.querySelector('[name=form_tvShow]'))
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

const verify = (form) => {
    const inputs = form.querySelectorAll("input")
    let error = false

    inputs.forEach(input => {
        if (input.id != 'id' && input.value == '') {
            const label = input.labels[0]
            const messageText = `Campo ${label.innerHTML} precisa ser preenchido`
            const messageConfiguration = "alert alert-danger"
            input.focus()
            message(messageText, messageConfiguration)
            error = true
        }
    })
    
    if (!error) {
        save()
    }
}

const message = (messageText, messageConfiguration) => {
    if (document.getElementById('message')) {
        const messageComponent = document.getElementById('message')
        messageComponent.innerHTML = messageText
        messageComponent.className = messageConfiguration
    } else {
        const messageComponent = document.createElement("div")
        messageComponent.className = messageConfiguration
        messageComponent.id = "message"
        messageComponent.innerHTML = messageText

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

        const parentElement = document.getElementById('section')
        parentElement.insertBefore(messageComponent, parentElement.firstElementChild);
    }
}

const clear = () => {
    document.form_tvShow.reset()
}

const save = () => {
    document.form_tvShow.submit()
}

const search = () => {
    document.form_tvShow.submit()
}

const remove = id => {
    const element = document.getElementById('question')
    element.classList.remove('d-none')
    element.lastElementChild.setAttribute('href', `/programa/${id}/excluir`)
}