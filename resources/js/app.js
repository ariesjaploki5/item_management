/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

   
import 'babel-polyfill'
import Vue from 'vue'
import VueRouter from 'vue-router'
import numeral from 'numeral';
import numFormat from 'vue-filter-number-format';
import axios from 'axios'
import master from './components/layouts/master.vue'
import {routes} from './routes.js'

import {store} from './store/store.js'

Vue.use(VueRouter)

window.eventBus = new Vue();
Vue.config.productionTip = false;

let router = new VueRouter({
    routes,
    mode: 'history',
});
Vue.filter('numFormat', numFormat(numeral));
Vue.filter('round_off', function(val){return parseFloat((val).toFixed(4));});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!store.getters.loggedIn) {
            next({
                name: 'main',
            })
        } else {
            next()
        }
    } else if (to.matched.some(record => record.meta.requiresVisitor)) {
    if (store.getters.loggedIn) {
        next({
            name: 'home',
        })
    } else {
        next()
    }
    } else {
        next()
    }
})

axios.defaults.baseURL = 'http://192.168.7.84/api';

Vue.prototype.$http = axios;

const token = localStorage.getItem('access_token');

if (token) {

    Vue.prototype.$http.defaults.headers.common = {
        'X-CSRF-TOKEN': token.content,
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + token,
    };
}

const app = new Vue({
    el: '#app',
    router,
    store,
    components: { master },
    methods:{
        printme() {
            window.print();
        }
    }
});
