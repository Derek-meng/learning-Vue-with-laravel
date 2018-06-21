/**
 * Created by Derek on 2018/6/8.
 */
import VueRouter from "vue-router";

let routes = [
    {
        path: '/',
        component: require('./components/pages/Home')
    },
    {
        path: '/about',
        component: require('./components/pages/About')
    },
    {
        path: '/posts/:id',
        name: 'posts',
        component: require('./components/posts/Post')
    },
    {
        path: '/register',
        name: 'register',
        component: require('./components/register/register')
    },
    {
        path: '/confirm',
        name: 'confirm',
        component: require('./components/confirm/email')
    },


]
export default new VueRouter({
    mode: 'history',
    routes
})
