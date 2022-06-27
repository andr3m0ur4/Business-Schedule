import axiosClient from 'axios'
import store from './store'

const axios = axiosClient.create({
    baseURL: 'http://localhost:8000/api/'
    // baseURL: 'https://api.business-schedule.tech/api/'
});

axios.interceptors.request.use(config => {
    config.headers = {
        Authorization: `Bearer ${store.state.user.token}`,
        Accept: 'application/json'
    }

    return config
});

export default axios;
