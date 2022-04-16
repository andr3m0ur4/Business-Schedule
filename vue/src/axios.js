import axiosClient from 'axios'
import store from './store'

const axios = axiosClient.create({
    baseURL: 'http://localhost:8000/api/'
})

axios.interceptors.request.use(config => {
    config.headers = {
        Authorization: `Bearer ${store.state.user.token}`,
        Accept: 'application/json'
    }

    return config
})

export default axios