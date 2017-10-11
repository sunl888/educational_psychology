import Vue from 'vue';
import tHttp from './utils/tHttp';
import router from './router';
import App from './App.vue';
import iView from 'iview';
import 'iview/dist/styles/iview.css';
router.beforeEach((to, from, next) => {
  iView.LoadingBar.start();
  next();
});
router.afterEach((to, from, next) => {
  iView.LoadingBar.finish();
});

Vue.use(iView);
Vue.use(tHttp, {
  baseURL: '/api/backend/',
  router
});
new Vue({
  el: '#app',
  ...App,
  router
});
