import Vue from 'vue';
import Router from 'vue-router';
// 获取baseUrl
let base = window.location.pathname.split('backend')[0] + 'backend';
Vue.use(Router);
const router = new Router({
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
      component: require('./views/Login.vue'),
      beforeEnter: (to, from, next) => {
        if (localStorage.getItem('login_ok')) {
          let redirect = to.query.redirect;
          if (redirect) {
            next({path: redirect});
          } else {
            next({name: 'home'});
          }
        } else {
          next();
        }
      }
    },
    {
      path: '/',
      component: require('./views/Home.vue'),
      meta: { requiresAuth: true },
      children: [
        {
          path: '',
          name: 'home',
          component: require('./views/Overview.vue')
        },
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
          path: 'article/list/:id?',
          name: 'articleList',
          component: require('./views/article/ArticleList.vue')
        },
        {
          path: 'article/:id/edit',
          name: 'editArticle',
          component: require('./views/article/Article.vue')
        },
        {
          path: 'article/add',
          name: 'addArticle',
          component: require('./views/article/Article.vue')
        },
        {
          path: 'column/list',
          name: 'columnList',
          component: require('./views/column/ColumnList.vue')
        },
        {
          path: 'column/:id/page',
          name: 'page',
          component: require('./views/column/Page.vue')
        },
        {
          path: 'column/:id/edit',
          name: 'editColumn',
          component: require('./views/column/Column.vue')
        },
        {
          path: 'column/add',
          name: 'addColumn',
          component: require('./views/column/Column.vue')
        },
        {
          path: 'banner/list/:id?',
          name: 'bannerList',
          component: require('./views/banner/BannerList.vue')
        },
        {
          path: 'banner/add',
          name: 'addBanner',
          component: require('./views/banner/Banner.vue')
        },
        {
          path: 'banner/:id/edit',
          name: 'editBanner',
          component: require('./views/banner/Banner.vue')
        },
        {
          path: 'role/list',
          name: 'roleList',
          component: require('./views/role/RoleList.vue')
        },
        {
          path: 'role/add',
          name: 'addRole',
          component: require('./views/role/Role.vue')
        },
        {
          path: 'role/:id/edit',
          name: 'editRole',
          component: require('./views/role/Role.vue')
        },
        {
          path: 'link/list/:id?',
          name: 'linkList',
          component: require('./views/link/LinkList.vue')
        },
        {
          path: 'link/add',
          name: 'addLink',
          component: require('./views/link/Link.vue')
        },
        {
          path: 'link/:id/edit',
          name: 'editLink',
          component: require('./views/link/Link.vue')
        }
      ]
    }
  ]
});
router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!localStorage.getItem('login_ok')) {
      next({
        name: 'login',
        query: { redirect: to.fullPath }
      });
    } else {
      next();
    }
  } else {
    next();
  }
});
export default router;
