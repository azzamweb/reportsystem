import axios from 'axios';
window.axios = axios;

import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
