const dbEmployeeTime = new Database('employeeTime')
const dbTvShowTime = new Database('tvShowTime')

window.onload = () => {
    // const gridEmployees = document.getElementById('grid-employees')
    const gridEmployees = document.querySelectorAll('[grid-employees]')
    const gridDays = document.querySelectorAll('[grid-days]')

    // const gridMonday = document.getElementById('grid-monday')
    // const gridTuesday = document.getElementById('grid-tuesday')
    // const gridWednesday = document.getElementById('grid-wednesday')
    // const gridThirsday = document.getElementById('grid-thirsday')
    // const gridFriday = document.getElementById('grid-friday')
    // const gridSaturday = document.getElementById('grid-saturday')
    // const gridSunday = document.getElementById('grid-sunday')

    const objSortable = {
        group: 'employees',
        swap: true,
        swapClass: "highlighted",
        animation: 150,
        ghostClass: 'blue-background-class'
    }

    const objSortableDays = {
        group: 'shared',
        swap: true,
        swapClass: "highlighted",
        animation: 150,
        ghostClass: 'blue-background-class'
    }

    gridEmployees.forEach(function (employee) {
        new Sortable(employee, objSortable)
    })

    gridDays.forEach(function (day) {
        new Sortable(day, objSortableDays)
    })

    // new Sortable(gridTuesday, objSortableDays)

    // new Sortable(gridWednesday, objSortableDays)

    // new Sortable(gridThirsday, objSortableDays)

    // new Sortable(gridFriday, objSortableDays)

    // new Sortable(gridSaturday, objSortableDays)

    // new Sortable(gridSunday, objSortableDays)

    modal()

    document.querySelectorAll('.card').forEach(initCards)

    if (document.querySelector('[id=btnModalTvShowSchedule]')) {
        document.querySelector('[id=btnModalTvShowSchedule]').onclick = () => {
            openModalTvShow()
        }
    }
}

const initCards = card => {
    if (card.dataset.cardEmployee) {
        card.onclick = () => {
            loadEmployee(card.dataset.cardEmployee)
            openModalEmployee()
        }
    } else {
        const idEmployeeTime = parseInt(card.dataset.cardTime)

        if (dbEmployeeTime.has(idEmployeeTime)) {
            const employeeTime = dbEmployeeTime.get(idEmployeeTime)

            const startTime = document.createElement('span')
            startTime.innerHTML = employeeTime.startTime
            const finalTime = document.createElement('span')
            finalTime.innerHTML = employeeTime.finalTime

            card.querySelector('.card-header').innerHTML = ''
            card.querySelector('.card-header').appendChild(startTime)
            card.querySelector('.card-header').appendChild(finalTime)
        }

        card.onclick = e => {
            const idEmployee = parseInt(card.closest('.row').dataset.rowId)
            loadEmployeeTime(idEmployeeTime, idEmployee)
            openModal()
        }
    }
}

const modal = () => {
    fetch('/assets/resources/modal-time.html')
        .then(response => {
            response.text()
                .then(data => {
                    const div = document.createElement('div')
                    div.innerHTML = data
                    const form = div.querySelector('[name=formEmployeeTime]')
                    document.getElementById('myModal').appendChild(div)
                    form.onsubmit = validateInputs

                    $('#modalEmployeeTime').on('hidden.bs.modal', e => {
                        form.reset()
                    })

                    $(".select2").select2();
                })
        })

    fetch('/assets/resources/modal-employee.html')
        .then(response => {
            response.text()
                .then(data => {
                    const div = document.createElement('div')
                    div.innerHTML = data
                    document.getElementById('myModal').appendChild(div)
                })
        })

    fetch('/assets/resources/modal-schedule.html')
        .then(response => {
            response.text()
                .then(data => {
                    const div = document.createElement('div')
                    div.innerHTML = data
                    document.getElementById('myModal').appendChild(div)
                })
        })

    fetch('/assets/resources/modal-tvShowHour.html')
        .then(response => {
            response.text()
                .then(data => {
                    const div = document.createElement('div')
                    div.innerHTML = data
                    document.getElementById('myModal').appendChild(div)
                    document.getElementById('form_TvShowHour').onsubmit = saveTvShowHour
                    document.getElementById('saveTvShow').onclick = submitTvShowHour
                    loadItems(`/ajax/tvshow/list`, 'tvShow')
                    loadItems(`/ajax/switcher/list`, 'tvSwitcher')
                    loadItems(`/ajax/studio/list`, 'tvStudio')
                })
        })
}

const openModal = () => {
    document.getElementById('btnModal').click()
}

const openModalEmployee = () => {
    document.getElementById('btnModalEmployee').click()
}

const openModalSchedule = () => {
    document.getElementById('btnModalSchedule').click()
}

const openModalTvShow = () => {
    document.getElementById('btnModalTvShow').click()
}

const loadSchedule = id => {
    fetch(`/ajax/schedule/${id}`)
        .then(response => {
            response.json()
                .then(obj => {
                    fillModalSchedule(obj)
                })
        })
}

const loadEmployee = id => {
    fetch(`/ajax/employee/${id}`)
        .then(response => {
            response.json()
                .then(obj => {
                    fillModalEmployee(obj)
                })
        })
}

const loadEmployeeTime = (idEmployeeTime, idEmployee) => {
    fetch(`/ajax/employee/${idEmployee}`)
        .then(response => {
            response.json()
                .then(obj => {
                    obj.idEmployeeTime = idEmployeeTime
                    fillModalEmployeeTime(obj)
                })
        })
}

const loadItems = (url, selectId) => {
    fetch(url)
        .then(response => {
            response.json()
                .then(obj => {
                    addItens(obj, selectId)
                })
        })
}

const fillModalEmployee = employee => {
    document.getElementById('employee-name').innerHTML = employee.name
    document.getElementById('employee-job').innerHTML = employee.job
    document.getElementById('employee-email').innerHTML = employee.email
    document.getElementById('employee-phone').innerHTML = employee.phone
    document.getElementById('employee-description').innerHTML = employee.description
}

const fillModalEmployeeTime = employee => {
    document.getElementById('modalEmployeeTime').dataset.id = employee.idEmployeeTime
    document.getElementById('time-name').innerHTML = employee.name
    document.getElementById('time-job').innerHTML = employee.job

    if (dbEmployeeTime.has(employee.idEmployeeTime)) {
        const employeeTime = dbEmployeeTime.get(employee.idEmployeeTime)
        document.getElementById('startTime').value = employeeTime.startTime
        document.getElementById('finalTime').value = employeeTime.finalTime
        document.getElementById('date').value = employeeTime.date
    }
    
    document.getElementById('saveTime').onclick = saveTime
}

const saveTime = e => {
    const btn = e.target;
    const form = document.querySelector('[name=formEmployeeTime]')
    const submitEvent = new SubmitEvent('submit', {
        submitter: btn
    })
    form.dispatchEvent(submitEvent)
}

const validateInputs = e => {
    e.preventDefault()
    const form = e.target
    if (!form.reportValidity()) {
        return false;
    }

    const idEmployeeTime = parseInt(document.getElementById('modalEmployeeTime').dataset.id)
    const employeeTime = {
        id: idEmployeeTime,
        startTime: form.startTime.value,
        finalTime: form.finalTime.value,
        date: form.date.value
    }

    dbEmployeeTime.save(employeeTime)
    updateCard(idEmployeeTime)
    $('#modalEmployeeTime').modal('hide')
}


const updateCard = id => {
    const employeeTime = dbEmployeeTime.get(id)
    
    const startTime = document.createElement('span')
    startTime.innerHTML = employeeTime.startTime
    const finalTime = document.createElement('span')
    finalTime.innerHTML = employeeTime.finalTime
    
    const card = document.querySelector(`.card[data-card-time="${id}"]`)
    card.querySelector('.card-header').innerHTML = ''
    card.querySelector('.card-header').appendChild(startTime)
    card.querySelector('.card-header').appendChild(finalTime)
}

const submitTvShowHour = e => {
    
    e.preventDefault()

    let form = new FormData(document.getElementById('form_TvShowHour'));
    console.log(document.getElementById('form_TvShowHour'))
    console.log(form)

    fetch(`/ajax/tvShowHour/save`,{
        method: 'POST',
        body: form
    }).then(response => {
        response.json()
            .then(data => {
                console.log(data)
            })
    })
    
}

const saveTvShowHour = event => {
    const btn = event.target
    const form = document.getElementById('form_TvShowHour')
    const submitEvent = new SubmitEvent('submit', {
        submitter: btn
    })

    form.dispatchEvent(submitEvent)
}

const addItens = (tvShows, selectId) => {
    tvShows.forEach(tvShow => {
        let option = document.createElement('option')
        option.innerHTML = tvShow.name
        option.id = tvShow.id
        document.getElementById(selectId).appendChild(option)
    });
}
