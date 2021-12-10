$(() => {
    clearPostJS()
    
    if (document.querySelector('[name=save]')) {
        document.querySelector('[name=save]').onclick = save 
        document.form_tvShowTime.onsubmit = submitForm
    }

    if (document.querySelector('[name=new]')) {
        document.querySelector('[name=new]').onclick = () => {
            location.href = '/horario-programa/novo'
        }
    }

    if (document.querySelector('[name=clear]')) {
        document.querySelector('[name=clear]').onclick = () => {
            clear()
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

const clear = () => {
    document.form_tvShowTime.reset()
}

const save = event => {
    const btn = event.target
    const form = document.form_tvShowTime
    const submitEvent = new SubmitEvent('submit', {
        submitter: btn
    })

    form.dispatchEvent(submitEvent)
}

const submitForm = e => {
    e.preventDefault()
    const formTvShowTime = e.target

    if (!formTvShowTime.reportValidity()) {
        return false;
    }

    document.form_tvShowTime.submit()
}

const search = () => {
    document.form_tvShowTime.submit()
}

const remove = id => {
    const element = document.getElementById('question')
    element.classList.remove('d-none')
    element.lastElementChild.setAttribute('href', `/horario-programa/${id}/excluir`)
}
