/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue'
import App from './App'
import * as fromVueSetup from './vue/setup'
import 'font-awesome/css/font-awesome.min.css'
require('./bootstrap');

fromVueSetup.setupPlugins(Vue)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const app = new Vue({
    render: h => h(App),
    el: '#app',
    ...fromVueSetup.makeOptions(Vue)
})
