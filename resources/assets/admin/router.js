import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);
export default new Router({
  mode: 'history',
  base: __dirname,
  routes: [{
    path: '/admin',
    component: require('./views/Home.vue'),
  }]
});
