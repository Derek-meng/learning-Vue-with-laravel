require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'
import router from './routes'
import store from './store/index'
import jwtToken from './helpers/jwt'
import App from './components/App'
import zh_TW from './locale/zh_TW';
import VeeValidate, {Validator} from 'vee-validate';

Validator.localize('zh_TW', zh_TW);


axios.interceptors.request.use(function (config) {
    if (jwtToken.getToken()) {
        config.headers['Authorization'] = 'Bearer ' + jwtToken.getToken();
    }
    return config;
}, function (error) {
    // Do something with request error
    return Promise.reject(error);
});
Vue.use(VueRouter)
Vue.use(VeeValidate, {
    locale: 'zh_TW'
});
Vue.component('app', App)
new Vue({
    el: '#app',
    router,
    store
})


