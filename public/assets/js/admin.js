$(() => {
    if (document.querySelector('[name=save]')) {
        document.querySelector('[name=save]').onclick = () => {
            location.href = './admin/novo'
        }
    }

    if (document.querySelector('[name=clear]')) {
        document.querySelector('[name=clear]').onclick = () => {
            clear()
        }
    }
})

const clear = () => {
    document.form_admin.reset()
}