import axios from 'axios'
import store from '../store'
window.toastr = require('toastr')

let api_url = process.env.MIX_APP_URL;
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
axios.defaults.baseURL = `${api_url}/api`;

axios.interceptors.request.use(request => {
    const loading = store.getters['response/loading'];
    // console.log('loading request', loading)
    // console.log('response', response);
    store.dispatch('response/setLoading', true);

    // console.log('loading', store.getters['response/loading'])
    if (store.getters['auth/authToken']) {
        request.headers.common['Authorization'] = `Bearer ${store.getters['auth/authToken']}`
    }
    else{
    store.dispatch('response/setLoading', false);

    }
    return request
})
// axios.interceptors.response.use(response => {

// });
// Response interceptor
axios.interceptors.response.use(function (response) {
    store.dispatch('response/setLoading', false);
    //   console.log('loading response', loading);
    return response;
}, function (error) {
    // Any status codes that falls outside the range of 2xx cause this function to trigger
    // Do something with response error
    return Promise.reject(error);
}, function (error) {
    const { status, data } = error.response
    if (status >= 500) {
        console.log('errosadasdasdasdasdasdasdsar', 'loading');
        toastr.options.closeButton = true;
        toastr.error('ERROR 500', 'Error!');
    }
    if (status >= 200) {

        console.log('listoasdasdasdasdasd', 'loading');
        const loading = store.getters['response/loading'];

        store.dispatch('response/setLoading', false);
    }

    if (status === 401 && store.getters['auth/isLoggedIn'] !== true) {
        store.commit('auth/LOGOUT')
        // window.location.reload('/login');
    }
    if (status === 422) {
        data.errors.forEach(async function (rating) {
            toastr.warning(rating, 'Error!');
        })
    }

    return Promise.reject(error)
});



export default axios
