window.Vue = require('vue');

import VueRouter from 'vue-router';
import Helpers from './core/Helpers';
var SocialSharing = require('vue-social-sharing');

Vue.use(VueRouter);
Vue.use(SocialSharing);


let helper = new Helpers();

/**
 * Global filter
 */
Vue.filter('readTime', function(value){
    return helper.readTime(value);
});

/**
 * Vue Directives
 */
Vue.directive('desktoponly', {
    inserted: function(el){
        if(window.screen.width <= 500){
            el.style.display = "none";
        }
    }
})

Vue.directive('mobileonly', {
    inserted: function(el){
        if(window.screen.width > 500){
            el.style.display = "none";
        }
    }
})

window.axios = require('axios');

import Form from './core/Form';
import Errors from './core/Errors';

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

window.Form = Form;
window.Errors = Errors;
window.Helpers = Helpers;