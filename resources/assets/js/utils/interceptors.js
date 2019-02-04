import axios from 'axios';
import {store} from '../store';
import NProgress from 'nprogress';
import * as MutationTypes from "../store/auth/MutationTypes";

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

axios.interceptors.request.use(
    config => {
        store.dispatch(MutationTypes.OFF_MESSAGE);
        if (store.getters.authToken) {
            config.headers.common['Authorization'] = `Bearer ${store.getters.authToken}`
            config.headers.common['Content-Type']=`application/json`;
            config.headers.common['Accept']=`application/json`;
        }else{
        NProgress.start();
        }
        return config
    },
    error => Promise.reject(error)
);




const calculatePercentage = (loaded, total) => (Math.floor(loaded * 1.0) / total);


axios.defaults.onDownloadProgress = e => {
    const percentage = calculatePercentage(e.loaded, e.total);
    NProgress.set(percentage)
};

axios.interceptors.response.use(response => {
    NProgress.done(true);
    return response
});
