import { createStore } from 'vuex'

const store = createStore({
    state: {
        user: {
            data: {
                name: 'Rick O\'shea'
            },
            token: sessionStorage.getItem('token')
        }
    },
    getters: {},
    actions: {},
    mutations: {
        logout(state) {
            state.user.data = {}
            state.user.token = null
            sessionStorage.removeItem('token')
        }
    },
    modules: {}
})

export default store