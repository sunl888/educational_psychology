import Vue from 'vue';
import thttp from './utils/thttp';
import router from './router';
import App from './App.vue';
import iView from 'iview';
import 'iview/dist/styles/iview.css';
Vue.use(iView);
Vue.use(thttp, {
  baseURL: '/api/backend'
});
new Vue({
  el: '#app',
  ...App,
  router
});
