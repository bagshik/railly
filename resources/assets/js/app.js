
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/*
var App = require('./App.vue');
var Home = require('./components/Home.vue');
var About = require('./components/About.vue');
var Stations = require('./components/Stations.vue');
*/

import App from './App.vue';
import Home from './components/Home.vue';
import About from './components/About.vue';
import Stations from './components/Stations.vue';

import VueRouter from 'vue-router';
Vue.use(VueRouter);

const routes = [
  { path: '/home', alias: '/', component: Home },
  { path: '/stations', component: Stations },
  { path: '/about', component: About }
];

// Create the router instance and pass the `routes` option
const router = new VueRouter({
  routes,
  linkActiveClass: 'active'
});

const app = new Vue({
    el: '#app',
    router,
    render: h => h(App)
    // put headers here!
});
