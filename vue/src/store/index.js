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
        login({ commit }, user) {
            return axios.post('login', user)
                .then(response => {
                    commit('setUser', response.data)
                    return response.data
                })
        }
    },
    mutations: {
        logout(state) {
            state.user.data = {}
            state.user.token = null
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