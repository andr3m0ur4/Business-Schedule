class Database {
    constructor() {

    }

    save(obj) {
        const id = obj.id
        localStorage.setItem(`employeeTime-${id}`, JSON.stringify(obj))
    }
}
