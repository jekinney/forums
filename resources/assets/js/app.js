
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.auth = document.head.querySelector('meta[name="auth"]').content;

window.user = JSON.parse(document.head.querySelector('meta[name="user"]').content);

window.Vue.prototype.authorize = function(handler) {
	return handler(window.user);
}

window.events = new Vue();

window.flash = function (message) {
	window.events.$emit('flash', message)
}

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('flash', require('./components/Flash.vue'));
Vue.component('thread-view', require('./pages/Thread.vue'));
Vue.component('paginator', require('./components/Paginator.vue'));

const app = new Vue({
    el: '#app'
});
