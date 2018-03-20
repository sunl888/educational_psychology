<template>
  <div class="user-info">
    <div :title="info.nick_name" class="nav-user-title">
      <img :src="info.avatar_url"/>
      <span>{{info.nick_name}}</span>
      <Icon class="chevron-down" type="chevron-down"></Icon>
    </div>
    <div class="detail">
      <span @click="exit" title="安全退出" class="exit">退出</span>
      <Icon class="icon-arrow" type="arrow-up-b"></Icon>
      <div class="content">
        <a href="javascript:;" @click="$router.push({name: 'editUser', params: {id: info.id}})" class="face" :title="info.nick_name"><img :src="info.avatar_url" :title="info.nick_name"/></a>
        <p class="uname">{{info.user_name}} ({{info.nick_name}})</p>
        <div class="member-menu">
          <ul>
            <li><a @click="$router.push({name: 'editUser', params: {id: info.id}})"  href="javascript:;">修改信息</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  export default{
    name: 'userInfo',
    props: {
      info: Object
    },
    data () {
      return {
      };
    },
    methods: {
      exit () {
        this.$emit('log_out');
      }
    }
  };
</script>

<style scoped lang="less">
  @keyframes scale-in-ease{
    0% {
      opacity: 0;
      transform: scale(0);
    }
    50% {
      transform: scale(1.1);
    }
    100% {
      opacity: 1;
      transform: scale(1) perspective(1200px)
    }
  }
  .user-info{
    position: relative;
    &:hover{
      color: #1497DB;
    }
    &:hover>.nav-user-title>.chevron-down{
      transform: rotate(180deg);
    }
    &:hover>.detail{
      display: block;
      animation: scale-in-ease cubic-bezier(.22,.58,.12,.98) .5s;
    }
  }
  .nav-user-title{
    cursor: pointer;
    img{
      width: 30px;
      height: 30px;
      border-radius: 50%;
      position: relative;
      top: 10px;
      margin-right: 3px;
    }
    .chevron-down{
      transition: transform .3s;
      margin-left: 3px;
      font-size: 14px;
    }
  }
  .detail{
    display: none;
    position: absolute;
    z-index: 1200;
    top: 50px;
    background-color: #fff;
    border-top: 2px solid #1296DB;
    box-shadow: 0 3px 8px 2px rgba(1,1,1,.25);
    right: 0;
    min-width: 270px;
    padding: 15px;
    .exit{
      cursor: pointer;
      position: absolute;
      right: 10px;
      top: 10px;
      line-height: 1;
      color: #999;
      &:hover{
        color: #1296DB;
      }
    }
    >.icon-arrow{
      position: absolute;
      top: -11px;
      color: #1296DB;
      right: 30px;
    }
    .content{
      line-height: 1;
      .face{
        display: block;
        text-align: center;
        img{
          width: 80px;
          height: 80px;
          border-radius: 50%;
          margin: 0 auto;
        }
      }
      .uname{
        text-align: center;
        margin-top: 15px;
        color: #666;
      }
      .member-menu{
        margin: 20px 20px 0px 10px;
        border-top: 1px solid #e5e9ef;
        overflow: hidden;
        >ul{
          padding: 0;
          overflow: hidden;
          margin: 10px 0;
          >li{
            float: left;
            list-style: none;
            width: 50%;
            >a{
              white-space: nowrap;
              color: #222;
              line-height: 28px;
              text-align: center;
              margin: 0 auto;
              display: block;
              text-decoration: none;
              font-size: 12px;
              &:hover{
                color: #00a1d6;
              }
            }
          }
        }
      }
    }
  }
</style>
