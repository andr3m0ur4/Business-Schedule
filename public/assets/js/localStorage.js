class Database {
    constructor(key) {
        this.keyName = key
    }

    save(obj) {
        const id = obj.id
        localStorage.setItem(`${this.keyName}-${id}`, JSON.stringify(obj))
    }

    get(id) {
        return JSON.parse(localStorage.getItem(`${this.keyName}-${id}`))
    }

    has(id) {
        return localStorage.getItem(`${this.keyName}-${id}`) != null
    }
}
