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
}