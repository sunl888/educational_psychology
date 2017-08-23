import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);
export default new Router({
  mode: 'history',
  base: __dirname,
  routes: [{
    path: '/admin',
    name: 'home',
    component: require('./views/Home.vue'),
    children: [
      {
        path: 'user/list',
        name: 'userList',
        component: require('./views/user/UserList.vue'),
      }
    ]
  }]
});
