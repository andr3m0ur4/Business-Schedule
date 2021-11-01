window.onload = () => {
    const gridEmployees = document.getElementById('grid-employees')

    const gridMonday = document.getElementById('grid-monday')
    const gridTuesday = document.getElementById('grid-tuesday')
    const gridWednesday = document.getElementById('grid-wednesday')
    const gridThirsday = document.getElementById('grid-thirsday')
    const gridFriday = document.getElementById('grid-friday')
    const gridSaturday = document.getElementById('grid-saturday')
    const gridSunday = document.getElementById('grid-sunday')

    const objSortable = {
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

    new Sortable(gridEmployees, objSortable)

    new Sortable(gridMonday, objSortableDays)

    new Sortable(gridTuesday, objSortableDays)

    new Sortable(gridWednesday, objSortableDays)

    new Sortable(gridThirsday, objSortableDays)

    new Sortable(gridFriday, objSortableDays)

    new Sortable(gridSaturday, objSortableDays)

    new Sortable(gridSunday, objSortableDays)

    modal()

    document.querySelectorAll('.card').forEach(card => {
        if (card.dataset.cardEmployee) {
            card.onclick = () => {
                loadEmployee(card.dataset.cardEmployee)
                openModalEmployee()
            }
        } else {
            card.onclick = () => {
                loadEmployeeTime(card.dataset.cardTime)
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

const loadEmployeeTime = id => {
    fetch(`/ajax/employee/${id}`)
        .then(response => {
            response.json()
                .then(obj => {
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
    document.getElementById('time-name').innerHTML = employee.name
    document.getElementById('time-job').innerHTML = employee.job
}
