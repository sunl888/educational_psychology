<template>
  <div class="home">
    <Menu mode="horizontal" theme="light" class="header"></Menu>
    <Menu width="220px" class="menu" theme="light" active-name="1-2" :open-names="['1', '2', '3']" @on-select="onSelect">
      <Menu-item class="top_menu_item" name="1-1"><Icon type="home"></Icon>首页</Menu-item>
      <Submenu name="1">
        <template slot="title">
          <Icon type="ios-paper"></Icon>
          内容管理
        </template>
        <Menu-item name="1-1">文章管理</Menu-item>
        <Menu-item name="1-2">评论管理</Menu-item>
        <Menu-item name="1-3">举报管理</Menu-item>
      </Submenu>
      <Submenu name="2">
        <template slot="title">
          <Icon type="ios-people"></Icon>
          用户管理
        </template>
        <Menu-item name="userList">用户列表</Menu-item>
        <Menu-item name="2-2">活跃用户</Menu-item>
      </Submenu>
      <Submenu name="3">
        <template slot="title">
          <Icon type="stats-bars"></Icon>
          统计分析
        </template>
        <Menu-group title="使用">
          <Menu-item name="3-1">新增和启动</Menu-item>
          <Menu-item name="3-2">活跃分析</Menu-item>
          <Menu-item name="3-3">时段分析</Menu-item>
        </Menu-group>
        <Menu-group title="留存">
          <Menu-item name="3-4">用户留存</Menu-item>
          <Menu-item name="3-5">流失用户</Menu-item>
        </Menu-group>
      </Submenu>
    </Menu>
    <div class="content-wrapper height-100p">
      <div class="content">
        <router-view class="router_view"></router-view>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  methods: {
    onSelect (name) {
      this.$nextTick(() => {
        this.$router.push({name});
      });
    },
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
      height: 50px;
      background-color: #fff;
      box-shadow: rgba(0, 0, 0, 0.1) 0 1px 2px;
      z-index: 10;
      right: 0;
    }
    .menu{
      bottom: 0;
      padding-top: 60px;
    }
    .top_menu_item > i{
      margin-right: 12px;
    }
    .content-wrapper{
      padding-top: 50px;
      padding-left: 220px;
      >.content{
        width: 1000px;
        margin: 0 auto;
        >.router_view{
          min-height: 100%;
          width: 940px;
          margin: 0 auto;
          padding-top: 30px;
        }
      }
    }
  }
</style>
