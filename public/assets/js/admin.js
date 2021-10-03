$(() => {
    if (document.querySelector('[name=new]')) {
        document.querySelector('[name=new]').onclick = () => {
            location.href = './admin/novo'
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
})

const clear = () => {
    document.form_admin.reset()
}

const save = () => {
    document.form_admin.submit()
}

const search = () => {
    document.form_admin.submit()
}