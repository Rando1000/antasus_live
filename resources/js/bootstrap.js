import axios from 'axios';


window.axios = axios;
window.axios.defaults.withCredentials = true
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
window.axios.get('/sanctum/csrf-cookie');
// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';




