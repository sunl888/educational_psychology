import Vue from 'vue';
import Router from 'vue-router';
// 获取baseUrl
let base = window.location.pathname.split('backend')[0] + 'backend';
Vue.use(Router);
export default new Router({
  mode: 'history',
  base,
  routes: [
    {
      path: '*',
      redirect: {name: 'home'}
    },
    {
      path: '/login',
      name: 'login',
      component: require('./views/Login.vue')
    },
    {
      path: '/',
      name: 'home',
      component: require('./views/Home.vue'),
      children: [
        {
          path: 'user/list',
          name: 'userList',
          component: require('./views/user/UserList.vue')
        },
        {
          path: 'user/add',
          name: 'addUser',
          component: require('./views/user/User.vue')
        },
        {
          path: 'user/:id/edit',
          name: 'editUser',
          component: require('./views/user/User.vue')
        },
        {
          path: 'article/list',
          name: 'articleList',
          component: require('./views/article/ArticleList.vue')
        },
        {
          path: 'article/:id/edit',
          name: 'editArticle',
          component: require('./views/article/Article.vue')
        }
      ]
    }
  ]
});
