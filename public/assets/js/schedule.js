const dbEmployeeTime = new Database('employeeTime')
const dbTvShowTime = new Database('tvShowTime')
const dbSchedule = new Database('schedule')
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

    document.querySelectorAll('#schedule .card').forEach(initCards)

    if (document.getElementById('btnAddModalTvShow')) {
        document.getElementById('btnAddModalTvShow').onclick = () => {
            openModalTvShow()
        }
    }

    if (document.getElementById('btnMenuTvShow')) {
        document.getElementById('btnMenuTvShow').onclick = () => {
            openModalMenuTvShow()
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
            fillCardEmployeeTime(card, employeeTime)
        }

        card.onclick = e => {
            const idScheduleCard = validateIdSchedule(card.dataset.idSchedule)
            const idEmployee = parseInt(card.closest('.row').dataset.rowId)
            loadEmployeeTime(idEmployeeTime, idEmployee, idScheduleCard)
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

                    loadItems(`/ajax/tvShowTime/list`, 'selectTvShowTime', addTvShowsTimes)
                    
                    $('.select2').on('select2:select', function (e) {
                        console.log(e);
                    });
                    
                    document.getElementById('addTvShow').onclick = openAddTvShowHour
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

    fetch('/assets/resources/modal-tvShowTime.html')
        .then(response => {
            response.text()
                .then(data => {
                    const div = document.createElement('div')
                    div.innerHTML = data
                    document.getElementById('myModal').appendChild(div)

                    document.getElementById('saveTvShow').onclick = saveTvShowTime 
                    document.form_TvShowTime.onsubmit = submitTvShowTime
                    loadItems(`/ajax/tvshow/list`, 'tvShow', addItems)
                    loadItems(`/ajax/switcher/list`, 'switcher', addItems)
                    loadItems(`/ajax/studio/list`, 'studio', addItems)

                    $('#modalTvShowAdd').on('hidden.bs.modal', e => {
                        closeModalTvShowHour()
                    })
                })
        })

    fetch('/assets/resources/modal-menuTvShowHour.html')
        .then(response => {
            response.text()
                .then(data => {
                    const div = document.createElement('div')
                    div.innerHTML = data
                    document.getElementById('myModal').appendChild(div)
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

const openModalMenuTvShow = () => {
    document.getElementById('btnModalMenuTvShow').click()
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

const loadEmployeeTime = (idEmployeeTime, idEmployee, idScheduleCard) => {
    fetch(`/ajax/employee/${idEmployee}`)
        .then(response => {
            response.json()
                .then(obj => {
                    obj.idEmployeeTime = idEmployeeTime
                    fillModalEmployeeTime(obj,idScheduleCard)
                    document.getElementById('employee-info').dataset.idEmployee = idEmployee
                    document.getElementById('modalEmployeeTime').dataset.idSchedule = idScheduleCard
                })
        })
}

const loadItems = (url, selectId, callback) => {
    fetch(url)
        .then(response => {
            response.json()
                .then(obj => {
                    callback(obj, selectId)
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
    document.getElementById('modalEmployeeTime').dataset.idEmployee = employee.id
    document.getElementById('time-name').innerHTML = employee.name
    document.getElementById('time-job').innerHTML = employee.job

    if (dbEmployeeTime.has(employee.idEmployeeTime)) {
        const employeeTime = dbEmployeeTime.get(employee.idEmployeeTime)
        document.getElementById('startTime').value = employeeTime.startTime
        document.getElementById('finalTime').value = employeeTime.finalTime
        document.getElementById('date').value = employeeTime.date
    }
    
    document.getElementById('saveTime').onclick = saveEmployeeTime
}

const fillCardEmployeeTime = (card, employeeTime) => {
    const startTime = document.createElement('span')
    startTime.innerHTML = employeeTime.startTime
    const finalTime = document.createElement('span')
    finalTime.innerHTML = employeeTime.finalTime
    
    card.querySelector('.card-header').innerHTML = ''
    card.querySelector('.card-header').appendChild(startTime)
    card.querySelector('.card-header').appendChild(finalTime)
}

const saveEmployeeTime = e => {
    const btn = e.target
    const form = document.formEmployeeTime
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
    
    const tvShowsTimes = $('#idSelect2').select2('data').map(item => {
        return item.tvShowTime
    })

    const idEmployeeTime = parseInt(document.getElementById('modalEmployeeTime').dataset.id)
    const idEmployee = parseInt(document.getElementById('modalEmployeeTime').dataset.idEmployee)
    const idScheduleCard = parseInt(document.getElementById('modalEmployeeTime').dataset.idSchedule)

    const employeeTime = {
        id: idEmployeeTime,
        startTime: form.startTime.value,
        finalTime: form.finalTime.value,
        date: form.date.value,
        idEmployee,
        tvShowsTimes
    }

    const tvShows = $('#idSelect2').select2('data')
    let tvShowsId = []
    tvShows.forEach(tvShow => {

        tvShowsId.push(tvShow.id);

    });

    let schedule = dbSchedule.hasInfo('idEmployee', idEmployee)

    if (!schedule) {

        schedule = {
            id: idScheduleCard,
            idEmployee: idEmployee,
            idTvShowTime: tvShowsId
        }
    
        dbSchedule.save(schedule)

    } else {

        schedule.idTvShowTime = tvShowsId

        dbSchedule.save(schedule)
    }


    dbEmployeeTime.save(employeeTime)
    updateCard(idEmployeeTime, idScheduleCard, tvShows)
    $('#modalEmployeeTime').modal('hide')
}


const updateCard = (idEmployeeTime, idScheduleCard, tvShows) => {
    const employeeTime = dbEmployeeTime.get(idEmployeeTime)
    const card = document.querySelector(`.card[data-card-time="${idEmployeeTime}"]`)
    card.dataset.idSchedule = idScheduleCard
    fillCardEmployeeTime(card, employeeTime)
}

const submitTvShowTime = e => {
    e.preventDefault()

    const formTvShowTime = e.target
    if (!formTvShowTime.reportValidity()) {
        return false
    }

    const form = new FormData(formTvShowTime)
    const parentElement = '[id=tvShowHour]';

    fetch('/ajax/tvShowTime/save', {
        method: 'POST',
        body: form
    }).then(response => {
        response.json()
            .then(data => {
                const messageObject = data
                messageTvShow(messageObject, parentElement)

                if (data.type != 1) {
                    formTvShowTime.reset()
                }
            })
    })
}

const saveTvShowTime = event => {
    const btn = event.target
    const form = document.form_TvShowTime
    const submitEvent = new SubmitEvent('submit', {
        submitter: btn
    })

    form.dispatchEvent(submitEvent)
}

const addItems = (items, selectId) => {
    items.forEach(item => {
        const option = document.createElement('option')
        option.value = item.id
        option.innerHTML = item.name
        document.getElementById(selectId).appendChild(option)
    })
}

const addTvShowsTimes = (items, selectId) => {

    const children = items.map(item => {
        return {
            id: item.id,
            text: item.tvShow.name,
            title: `${formatTime(item.start_time)} - ${formatTime(item.final_time)}`,
            tvShowTime: item
        }
    })

    const data = [{
        text: 'Programas',
        children
    }]

    $(".select2").html('').select2({ data })
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

const messageTvShow = (messageObject, fatherElement) => {
    let messageConfiguration = '';
    const messageId = 'tvShowHourMessage'

    if (messageObject.type == 1) {

        messageConfiguration = "alert alert-danger";
    } else { 

        messageConfiguration = "alert alert-info";

    }

    messageText(messageObject.message, messageConfiguration, fatherElement, messageId)
      
}

const openAddTvShowHour = () => {
    document.getElementById('modalEmployeeTime').classList.add("d-none")
    openModalTvShow()
}

const closeModalTvShowHour = () => {

    if (document.getElementById('tvShowHourMessage')) {
        const messageFixed = document.getElementById('tvShowHourMessage')
        messageFixed.parentNode.removeChild(messageFixed);
    } 

    document.getElementById('modalEmployeeTime').classList.remove("d-none")
    document.form_TvShowTime.reset()
}

const validateIdSchedule = idScheduleCard => {

    if (idScheduleCard == "") {
        
        return dbSchedule.lastId()

    }

    return parseInt(idScheduleCard)
}
