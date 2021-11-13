$(() => {
    clearPostJS()
    
    if (document.querySelector('[name=save]')) {
        document.getElementById('save').onclick = save 
        document.getElementById('form_tvShow').onsubmit = submitForm
    }

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
    document.form_tvShow.reset()
}

const save = event => {

    const btn = event.target
    const form = document.getElementById('form_tvShow')
    const submitEvent = new SubmitEvent('submit', {
        submitter: btn
    })

    form.dispatchEvent(submitEvent)
}

const submitForm = e => {
    
    e.preventDefault()
    
    const formTvShow = e.target
    if (!formTvShow.reportValidity()) {
        return false;
    }

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