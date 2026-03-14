import axios from 'axios';
import { AUTH_TOKEN } from '@/utils/localstorageKeys';

var axiosFile = axios.create({
    baseURL: window.config.base_url + '/api'
});

// Axios default headers
axiosFile.defaults.headers['Accept'] = 'application/json';
axiosFile.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

axiosFile.interceptors.request.use((config) => {
    const authToken = window.localStorage.getItem(AUTH_TOKEN);
    if (authToken) {
        config.headers['Authorization'] = `Bearer ${authToken}`;
    }

    return config;
});

// Axios error listener
axiosFile.interceptors.response.use(function (response) {
    return response;
}, function (error) {
    const errorCode = error.response.status;
    if (errorCode === 401) {
        window.localStorage.clear();

        // If error 401 redirect to login
        window.location.href = window.config.base_url;
    } else {
        return Promise.reject(error.response);
    }
});

window.axiosFile = axiosFile;
