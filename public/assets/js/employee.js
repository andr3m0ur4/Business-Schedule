$(() => {
    if (document.querySelector('[name=new]')) {
        document.querySelector('[name=new]').onclick = () => {
            location.href = '/funcionario/novo'
        }
    }

    if (document.querySelector('[name=clear]')) {
        document.querySelector('[name=clear]').onclick = () => {
            clear()
        }
    }

    if (document.querySelector('[name=save]')) {
        document.querySelector('[name=save]').onclick = () => {
            save()
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