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

    lastId() {
        let id = 1
        while (true) {
            if (!localStorage.getItem(`${this.keyName}-${id}`)) {
                return id
            }

            id++
        }

    }

    hasInfo(label, idEmployee) {
        let id = 1
        while (true) {
            const  item = JSON.parse(localStorage.getItem(`${this.keyName}-${id}`))
                        
            if (!item) {
                return null
            }

            if (item[label] && item[label] == idEmployee) {
                return item
            }

            id++
        }

    }

}
