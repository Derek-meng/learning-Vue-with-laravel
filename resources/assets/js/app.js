require('./bootstrap');

window.Vue = require('vue');

import VueRouter from "vue-router";
import router from "./routes";
import App from "./components/App";
// import VeeValidate from 'vee-validate';
import zh_TW from './locale/zh_TW';
import VeeValidate, {Validator} from 'vee-validate';
Validator.localize('zh_TW', zh_TW);


Vue.use(VueRouter)
Vue.use(VeeValidate, {
    locale: 'zh_TW'
});
Vue.component('app', App)
const app = new Vue({
    el: '#app',
    router
})


