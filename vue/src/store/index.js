import axios from '@/axios'
import { createStore } from 'vuex'

const store = createStore({
    state: {
        user: {
            data: {},
            token: sessionStorage.getItem('token')
        }
    },
    getters: {},
    actions: {
        login(store, user) {
            return axios.post('login', user)
                .then(response => {
                    store.commit('setUser', response.data)
                    return response.data
                })
        },
        logout(state) {
            return axios.post('v1/logout')
                .then(response => {
                    state.commit('logout')
                    return response
                })
        }
    },
    mutations: {
        logout(state) {
            state.user.data = {}
            state.user.token = null
            sessionStorage.removeItem('token')
        },
        setUser: (state, userData) => {
            state.user.token = userData.token.access_token
            state.user.data = userData.user
            sessionStorage.setItem('token', userData.token.access_token)
        }
    },
    modules: {}
})

export default store