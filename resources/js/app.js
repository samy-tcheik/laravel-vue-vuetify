/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'
import Vuetify from 'vuetify'
import Vuelidate from 'vuelidate'
import 'vuetify/dist/vuetify.min.css'
import '@mdi/font/css/materialdesignicons.css'
import VueSweetalert2 from 'vue-sweetalert2'

import VueRouter from 'vue-router'




Vue.use(VueRouter)

Vue.use(Vuetify)

Vue.use(Vuelidate)

Vue.use(VueSweetalert2)
const opts = {
    icons: {
        iconfont: 'mdiSvg', // 'mdi' || 'mdiSvg' || 'md' || 'fa' || 'fa4' || 'faSvg'
      },
}

export default new Vuetify(opts)

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('main-component',require('./components/MainComponent.vue').default);
import UsersComponent from './components/users/UsersComponent.vue'
import EmplComponent from './components/employees/EmplComponent.vue'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

    const routes = [
        { path: '/users', component: UsersComponent},
        { path: '/employees', component: EmplComponent}
    ]

    const router = new VueRouter({
        routes
    })


const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    router,
});
