const clearPostJS = () => {
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href)
    }
}

const formatTime = time => {
    return new Intl.DateTimeFormat('pt-BR', {
        hour: 'numeric',
        minute: 'numeric'
    }).format(new Date(time))
}
