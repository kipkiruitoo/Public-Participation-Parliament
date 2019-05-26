/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('./manage');

window.Vue = require('vue');
window.Slug = require('slug');
Slug.defaults.mode = 'rfc3986';

import Buefy from '../../node_modules/buefy/src/index';

Vue.use(Buefy);

Vue.component('slugWidget', require('./components/slugWidget.vue').default);

var app = new Vue({
    el: '#app',

    data: {
        auto_password: true,
        password_options: 'keep',
        permissionsSelected: [],
        rolesSelected: [],
        resource: '',
        title: '',
        slug: '',

        crudSelected: ['create', 'read', 'update', 'delete']
    },
    methods: {
        updateSlug: {
            updateSlug: function (val) {
                this.slug = val;
            }
        },
        crudName: function (item) {
            return item.substr(0, 1).toUpperCase() + item.substr(1) + " " + app.resource.substr(0, 1).toUpperCase() + app.resource.substr(1);
        },
        crudSlug: function (item) {
            return item.toLowerCase() + "-" + app.resource.toLowerCase();
        },
        crudDescription: function (item) {
            return "Allow a User to " + item.toUpperCase() + " a " + app.resource.substr(0, 1).toUpperCase() + app.resource.substr(1);
        }
    }
});
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });

// open the nav dropdown
