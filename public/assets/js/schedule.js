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

    gridEmployees.forEach(function(employee) {
        new Sortable(employee, objSortable)
    })

    gridDays.forEach(function(day) {
        new Sortable(day, objSortableDays)
    })

    // new Sortable(gridTuesday, objSortableDays)

    // new Sortable(gridWednesday, objSortableDays)

    // new Sortable(gridThirsday, objSortableDays)

    // new Sortable(gridFriday, objSortableDays)

    // new Sortable(gridSaturday, objSortableDays)

    // new Sortable(gridSunday, objSortableDays)

    modal()

    document.querySelectorAll('.card').forEach(card => {
        if (card.dataset.cardEmployee) {
            card.onclick = () => {
                loadEmployee(card.dataset.cardEmployee)
                openModalEmployee()
            }
        } else {
            card.onclick = e => {
                const idEmployeeTime = parseInt(card.dataset.cardTime)
                const idEmployee = parseInt(card.closest('.row').dataset.rowId)
                loadEmployeeTime(idEmployeeTime, idEmployee)
                openModal()
            }
        }
    })
}

const modal = () => {
    fetch('/assets/resources/modal-time.html')
        .then(response => {
            response.text()
                .then(data => {
                    const div = document.createElement('div')
                    div.innerHTML = data
                    document.getElementById('myModal').appendChild(div)
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

const fillModalEmployee = employee => {
    document.getElementById('employee-name').innerHTML = employee.name
    document.getElementById('employee-job').innerHTML = employee.job
    document.getElementById('employee-email').innerHTML = employee.email
    document.getElementById('employee-phone').innerHTML = employee.phone
}

const fillModalEmployeeTime = employee => {
    document.getElementById('modalEmployeeTime').dataset.id = employee.idEmployeeTime
    document.getElementById('time-name').innerHTML = employee.name
    document.getElementById('time-job').innerHTML = employee.job
    document.getElementById('saveTime').onclick = saveTime
}

const saveTime = () => {
    employeeTime = {
        id: parseInt(document.getElementById('modalEmployeeTime').dataset.id),
        startTime: document.getElementById('startTime').value,
        finalTime: document.getElementById('finalTime').value,
        date: document.getElementById('date').value
    }
    
    db = new Database()
    db.save(employeeTime)
}
