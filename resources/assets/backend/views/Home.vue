<template>
  <div class="home">
    <Menu mode="horizontal" theme="light" class="header">
      <Logo size="small" class="logo"></Logo>
      <div class="content">
        <div class="user">
          <UserInfo @log_out="logOut" :info="me"></UserInfo>
        </div>
        <Menu-item @click.native="gotoFrontend" class="menu_item" name="frontend"><Icon type="home"></Icon>网站首页</Menu-item>
      </div>
    </Menu>
    <Menu width="220px" class="menu" theme="light" :active-name="currentActiveKey" :open-names="['content', 'user']" @on-select="onSelect">
      <Menu-item class="top_menu_item" name="home"><Icon type="home"></Icon>首页</Menu-item>
      <Submenu name="content">
        <template slot="title">
          <Icon type="ios-paper"></Icon>
          内容管理
        </template>
        <Menu-item name="articleList">文章管理</Menu-item>
        <Menu-item name="columnList">栏目管理</Menu-item>
        <Menu-item name="bannerList">Banner 管理</Menu-item>
        <Menu-item name="linkList">链接管理</Menu-item>
        <Menu-item name="tagList">标签管理</Menu-item>
      </Submenu>
      <Submenu name="user">
        <template slot="title">
          <Icon type="ios-people"></Icon>
          用户管理
        </template>
        <Menu-item name="userList">用户列表</Menu-item>
        <Menu-item name="roleList">角色列表</Menu-item>
      </Submenu>
      <Menu-item name="settingList"><Icon type="gear-a"></Icon>站点设置</Menu-item>
    </Menu>
    <div class="content-wrapper height-100p">
      <div class="content">
        <transition appear name="slide-fade-reversal">
          <router-view class="router_view"></router-view>
        </transition>
      </div>
    </div>
  </div>
</template>
<script>
import Logo from '../components/Logo.vue';
import UserInfo from '../components/UserInfo.vue';
import { getFrontendUrl } from '../utils/utils';
export default {
  components: { Logo, UserInfo },
  data () {
    return {
      currentActiveKey: this.$route.name,
      me: {},
      horizontalActiveName: ''
    };
  },
  watch: {
    '$route' () {
      this.currentActiveKey = this.$route.name;
    }
  },
  methods: {
    gotoFrontend () {
      window.open(getFrontendUrl());
    },
    onSelect (name) {
      this.$nextTick(() => {
        this.$router.push({name});
      });
    },
    onHorizontalSelect (aa) {
      console.log(aa);
    },
    logOut () {
      this.$http.post('auth/logout').then(res => {
        this.$Message.success('退出登陆');
        localStorage.removeItem('login_ok');
        this.$router.push({name: 'login'});
      });
    }
  },
  mounted () {
    this.frontendUrl = getFrontendUrl();
    this.$http.get('me').then(res => {
      this.me = res.data.data;
    });
  }
};
</script>

<style scoped lang="less">
  .home{
    .header, .menu{
      position: fixed;
      top: 0;
      left: 0;
    }
    .header{
      background-color: #fff;
      box-shadow: rgba(0, 0, 0, 0.1) 0 1px 2px;
      z-index: 10;
      right: 0;
      .content{
        margin: 0 auto;
        width: 1000px;
        padding-left: 220px;
        box-sizing: content-box;
        position: relative;
      }
      .logo{
        position: absolute;
        left: -65px;
        top: 16px;
      }
      .user{
        position: absolute;
        right: 120px;
      }
      .menu_item{
        float: right;
      }
    }
    .menu{
      bottom: 0;
      padding-top: 70px;
      z-index: 9;
    }
    .top_menu_item > i{
      margin-right: 12px;
    }
    .content-wrapper{
      padding-top: 50px;
      padding-left: 220px;
      >.content{
        margin: 0 auto;
        width: 1000px;
        >.router_view{
          min-height: 100%;
          width: 980px;
          margin: 0 auto;
          padding-top: 40px;
          padding-bottom: 50px;
        }
      }
    }
  }
  .slide-fade-reversal-enter-active {
    transition: all .7s ease;
  }
  .slide-fade-reversal-enter, .slide-fade-reversal-leave-to{
    transform: translateY(20px);
    opacity: 0;
  }
  .slide-fade-enter-active {
    transition: all .7s ease;
  }
  .slide-fade-enter, .slide-fade-leave-to{
    transform: translateY(-20px);
    opacity: 0;
  }
</style>
