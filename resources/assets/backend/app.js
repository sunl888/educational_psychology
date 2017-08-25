import Vue from 'vue';
import axios from 'axios';
import router from './router';
import App from './App.vue';
import iView from 'iview';
import 'iview/dist/styles/iview.css';
let token = document.head.querySelector('meta[name="csrf-token"]');
Vue.use(iView);
if (token) {
  axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
Vue.prototype.$http = axios.create({
  baseURL: '/api/backend/',
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
