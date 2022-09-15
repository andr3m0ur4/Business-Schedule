import axios, { type AxiosInstance } from 'axios';

const clientHttp : AxiosInstance = axios.create({
    baseURL: 'http://localhost:8000/api/'
    // baseURL: 'https://api.business-schedule.tech/api/'
});

clientHttp.interceptors.request.use(config => {
    config.headers = {
        Accept: 'application/json'
    }

    return config;
})

export default clientHttp
