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
                // openModalEmployee()
            }
        } else {
            card.onclick = () => {
                openModal()
            }
        }
    })
}

const modal = () => {
    fetch('/assets/resources/modal.html')
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
}

const openModal = () => {
    document.getElementById('btnModal').click()
}

const openModalEmployee = () => {
    document.getElementById('btnModalEmployee').click()
}

const loadEmployee = id => {
    fetch(`/ajax/employee/${id}`)
        .then(response => {
            response.json()
                .then(data => {
                    console.log(data);
                })
        })
}
