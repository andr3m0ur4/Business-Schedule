import { createStore } from 'vuex'

const store = createStore({
    state: {
        user: {
            data: {
                name: 'Rick O\'shea'
            },
            token: 123
        }
    },
    getters: {},
    actions: {},
    mutations: {
        logout(state) {
            state.user.data = {}
            state.user.token = null
            localStorage.removeItem('token')
        }
    },
    modules: {}
})

export default store