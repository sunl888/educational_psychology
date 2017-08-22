import Vue from 'vue';
import axios from 'axios';
import router from './router';
import App from './App.vue';
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
  axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
Vue.prototype.$http = axios.create({
  baseURL: '/api/admin/',
  timeout: 5000,
  responseType: 'json',
  headers: {
    'X-Requested-With': 'XMLHttpRequest'
  }
});
new Vue({
  el: '#app',
  ...App,
  router
});
